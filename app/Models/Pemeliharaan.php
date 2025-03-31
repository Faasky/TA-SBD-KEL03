<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_pemeliharaan';
    protected $fillable = [
        'id_barang', 
        'tanggal_pemeliharaan', 
        'deskripsi_masalah', 
        'tindakan', 
        'biaya', 
        'status', 
        'petugas',
        'is_deleted'
    ];
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}