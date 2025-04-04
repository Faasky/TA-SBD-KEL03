<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamBarangsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjam_barangs', function (Blueprint $table) {
            $table->id('id_pinjam_barang');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_karyawan');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali_rencana');
            $table->enum('status_pinjam', ['dipinjam', 'kembali', 'terlambat'])->default('dipinjam');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_barang')->references('id_barang')->on('barangs');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_barangs');
    }
}
