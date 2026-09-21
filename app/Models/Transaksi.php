<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = [
        'toko_id',
        'user_id',
        'kode_transaksi',
        'tanggal_transaksi',
        'total_harga',
        'bayar',
        'kembalian',
        'metode_pembayaran',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    public function toko(): BelongsTo
    {
        return $this->belongsTo(Toko::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransaksis(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}