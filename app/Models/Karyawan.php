<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Hapus use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    // Hapus HasApiTokens dari sini
    use HasFactory, Notifiable;
    protected $table = 'karyawans'; 
    protected $primaryKey = 'id_karyawan'; // Primary Key yang bena
    protected $fillable = [
        'nama', 
        'departemen', 
        'email', 
        'password', 
        'role', 
        'tanggal_bergabung',
        'is_deleted',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_karyawan', 'id_karyawan');
    }
}