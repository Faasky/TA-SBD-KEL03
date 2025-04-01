<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    
     protected $table = 'peminjamans';
     protected $primaryKey = 'id_peminjaman';
     public $timestamps = true;
    protected $fillable = [
        'id_barang', 
        'id_karyawan', 
        'tanggal_pinjam', 
        'tanggal_kembali_rencana', 
        'tanggal_kembali_aktual', 
        'status_peminjaman', 
        'catatan',
        'is_deleted'
    ];
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
    
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}