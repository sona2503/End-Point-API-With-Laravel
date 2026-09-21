<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\Transaksi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TransaksiController extends Controller
{
    /**
     * Tampilkan semua transaksi milik toko user yang login.
     * Filter opsional: ?toko_id=1&tanggal_dari=2026-09-01&tanggal_sampai=2026-09-30
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'toko_id'        => ['nullable', 'integer'],
            'tanggal_dari'   => ['nullable', 'date'],
            'tanggal_sampai' => ['nullable', 'date', 'after_or_equal:tanggal_dari'],
            'per_page'       => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $transaksis = Transaksi::query()
            ->with('toko:id,nama')
            ->withCount('detailTransaksis')
            ->whereHas('toko', fn ($q) => $q->where('user_id', $request->user()->id))
            ->when($request->toko_id, fn ($q, $v) => $q->where('toko_id', $v))
            ->when($request->tanggal_dari, fn ($q, $v) => $q->whereDate('tanggal_transaksi', '>=', $v))
            ->when($request->tanggal_sampai, fn ($q, $v) => $q->whereDate('tanggal_transaksi', '<=', $v))
            ->latest('tanggal_transaksi')
            ->paginate($request->integer('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Daftar transaksi berhasil diambil',
            'data'    => $transaksis,
        ]);
    }

    /**
     * Tampilkan detail satu transaksi beserta item produknya.
     */
    public function show(Request $request, $id): JsonResponse
    {
        $transaksi = $this->findOwnedTransaksi($request, $id)
            ->load([
                'toko:id,nama,alamat,no_telepon',
                'user:id,name',
                'detailTransaksis.produk:id,kode_produk,nama,jenis',
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Detail transaksi berhasil diambil',
            'data'    => $transaksi,
        ]);
    }

    /**
     * Tambah transaksi baru.
     *
     * Body contoh:
     * {
     *   "toko_id": 1,
     *   "metode_pembayaran": "tunai",
     *   "bayar": 50000,
     *   "catatan": "opsional",
     *   "items": [
     *     {"produk_id": 3, "jumlah": 2},
     *     {"produk_id": 5, "jumlah": 1}
     *   ]
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'toko_id'             => ['required', 'integer', 'exists:tokos,id'],
            'metode_pembayaran'   => ['required', 'in:tunai,transfer,qris'],
            'bayar'               => ['required', 'integer', 'min:0'],
            'catatan'             => ['nullable', 'string'],
            'items'               => ['required', 'array', 'min:1'],
            'items.*.produk_id'   => ['required', 'integer', 'distinct', 'exists:produks,id'],
            'items.*.jumlah'      => ['required', 'integer', 'min:1'],
        ]);

        // Pastikan toko milik user yang login
        $toko = Toko::where('id', $validated['toko_id'])
            ->where('user_id', $request->user()->id)
            ->first();

        if (! $toko) {
            return response()->json([
                'success' => false,
                'message' => 'Toko tidak ditemukan atau bukan milik Anda',
            ], 403);
        }

        $transaksi = DB::transaction(function () use ($validated, $request, $toko) {
            $produkIds = collect($validated['items'])->pluck('produk_id');

            // Kunci baris produk agar stok aman dari transaksi bersamaan
            $produks = Produk::whereIn('id', $produkIds)
                ->where('toko_id', $toko->id)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($produks->count() !== $produkIds->count()) {
                throw ValidationException::withMessages([
                    'items' => ['Ada produk yang bukan milik toko ini'],
                ]);
            }

            $total   = 0;
            $details = [];

            foreach ($validated['items'] as $index => $item) {
                $produk = $produks[$item['produk_id']];

                if ($produk->stok < $item['jumlah']) {
                    throw ValidationException::withMessages([
                        "items.$index.jumlah" => [
                            "Stok {$produk->nama} tidak cukup (tersisa {$produk->stok})",
                        ],
                    ]);
                }

                $subtotal = $produk->harga * $item['jumlah'];
                $total   += $subtotal;

                $details[] = [
                    'produk_id'    => $produk->id,
                    'jumlah'       => $item['jumlah'],
                    'harga_satuan' => $produk->harga, // snapshot harga
                    'subtotal'     => $subtotal,
                ];

                $produk->decrement('stok', $item['jumlah']);
            }

            if ($validated['bayar'] < $total) {
                throw ValidationException::withMessages([
                    'bayar' => ["Pembayaran kurang. Total tagihan: $total"],
                ]);
            }

            $transaksi = Transaksi::create([
                'toko_id'           => $toko->id,
                'user_id'           => $request->user()->id,
                'kode_transaksi'    => 'TRX-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
                'tanggal_transaksi' => now(),
                'total_harga'       => $total,
                'bayar'             => $validated['bayar'],
                'kembalian'         => $validated['bayar'] - $total,
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'status'            => 'selesai',
                'catatan'           => $validated['catatan'] ?? null,
            ]);

            $transaksi->detailTransaksis()->createMany($details);

            return $transaksi;
        });

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'data'    => $transaksi->load('detailTransaksis.produk:id,kode_produk,nama'),
        ], 201);
    }

    /**
     * Hapus transaksi. Stok produk dikembalikan bila transaksi berstatus selesai.
     * Detail transaksi ikut terhapus lewat cascadeOnDelete di migration.
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        $transaksi = $this->findOwnedTransaksi($request, $id);

        DB::transaction(function () use ($transaksi) {
            if ($transaksi->status === 'selesai') {
                $details = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();

                // Kunci produk lalu kembalikan stok
                Produk::whereIn('id', $details->pluck('produk_id'))
                    ->lockForUpdate()
                    ->get();

                foreach ($details as $detail) {
                    Produk::where('id', $detail->produk_id)
                        ->increment('stok', $detail->jumlah);
                }
            }

            $transaksi->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus',
        ]);
    }

    /**
     * Ambil transaksi hanya jika toko-nya milik user yang login, kalau tidak 404.
     */
    private function findOwnedTransaksi(Request $request, $id): Transaksi
    {
        return Transaksi::where('id', $id)
            ->whereHas('toko', fn ($q) => $q->where('user_id', $request->user()->id))
            ->firstOrFail();
    }
}