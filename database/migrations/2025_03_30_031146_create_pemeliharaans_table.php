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
        Schema::create('pemeliharaans', function (Blueprint $table) {
            $table->id('id_pemeliharaan');
            $table->unsignedBigInteger('id_barang');
            $table->date('tanggal_pemeliharaan');
            $table->text('deskripsi_masalah');
            $table->text('tindakan')->nullable();
            $table->decimal('biaya', 15, 2)->default(0);
            $table->enum('status', ['selesai', 'dalam proses'])->default('dalam proses');
            $table->string('petugas')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            
            $table->foreign('id_barang')->references('id_barang')->on('barangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeliharaans');
    }
};