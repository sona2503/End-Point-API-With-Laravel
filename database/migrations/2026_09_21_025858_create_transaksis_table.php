<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toko_id')->constrained('tokos')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete(); // pencatat/kasir
            $table->string('kode_transaksi', 50)->unique();
            $table->dateTime('tanggal_transaksi');
            $table->integer('total_harga')->default(0);
            $table->integer('bayar')->default(0);
            $table->integer('kembalian')->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'qris'])->default('tunai');
            $table->enum('status', ['pending', 'selesai', 'batal'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['toko_id', 'tanggal_transaksi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};