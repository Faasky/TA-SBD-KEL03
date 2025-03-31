<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori', 'deskripsi', 'is_deleted'];
    
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id', 'id_kategori');
    }
}