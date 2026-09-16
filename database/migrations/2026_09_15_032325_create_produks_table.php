<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toko_id')->constrained('tokos')->onDelete('cascade');
            $table->string('kode_produk', 50)->unique();
            $table->string('nama', 255);
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->enum('jenis', [
                'sembako',
                'elektronik',
                'alat mandi',
                'sayur',
                'buah',
                'snack',
                'minuman',
            ]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};