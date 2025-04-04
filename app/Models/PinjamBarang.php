<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamBarang extends Model
{
    use HasFactory;

    protected $table = 'pinjam_barangs';
    protected $primaryKey = 'id_pinjam_barang';

    protected $fillable = [
        'id_barang',
        'id_karyawan',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'status_pinjam',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}
