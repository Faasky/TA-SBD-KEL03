<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Karyawan extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'karyawans'; 
    protected $primaryKey = 'id_karyawan'; 
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

    protected $dates = ['deleted_at'];
    
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_karyawan', 'id_karyawan');
    }
}