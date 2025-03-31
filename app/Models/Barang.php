<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang', 
        'kategori_id', 
        'spesifikasi', 
        'tanggal_pembelian', 
        'harga', 
        'status', 
        'lokasi', 
        'kode_aset', 
        'gambar',
        'is_deleted'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }
    
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_barang', 'id_barang');
    }
    
    public function pemeliharaans()
    {
        return $this->hasMany(Pemeliharaan::class, 'id_barang', 'id_barang');
    }
}