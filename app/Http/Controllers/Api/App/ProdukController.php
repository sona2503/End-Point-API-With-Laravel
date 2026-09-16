<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    protected array $jenisValid = [
        'sembako',
        'elektronik',
        'alat mandi',
        'sayur',
        'buah',
        'snack',
        'minuman',
    ];

    protected function generateKodeProduk(): string
    {
        do {
            $kode = 'PRD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Produk::where('kode_produk', $kode)->exists());

        return $kode;
    }

    public function index()
    {
        $produks = Produk::with('toko')->get();

        return response()->json([
            'success' => true,
            'data' => $produks,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'toko_id' => 'required|exists:tokos,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'jenis' => 'required|in:' . implode(',', $this->jenisValid),
        ]);

        $validatedData['kode_produk'] = $this->generateKodeProduk();

        $produk = Produk::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk,
        ], 201);
    }

    public function show(string $id)
    {
        $produk = Produk::with('toko')->find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $produk,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        $validatedData = $request->validate([
            'toko_id' => 'sometimes|required|exists:tokos,id',
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'sometimes|required|integer|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'jenis' => 'sometimes|required|in:' . implode(',', $this->jenisValid),
        ]);

        $produk->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk,
        ]);
    }

    public function destroy(string $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus',
        ]);
    }
}