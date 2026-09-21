<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'toko_id',
        'kode_produk',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'jenis',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}