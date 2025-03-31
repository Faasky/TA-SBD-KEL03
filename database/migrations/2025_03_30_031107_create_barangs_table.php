<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang');
            $table->unsignedBigInteger('kategori_id');
            $table->text('spesifikasi')->nullable();
            $table->date('tanggal_pembelian');
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak', 'dihapus'])->default('tersedia');
            $table->string('lokasi')->nullable();
            $table->string('kode_aset')->unique();
            $table->string('gambar')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};