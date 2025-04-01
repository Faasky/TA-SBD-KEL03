<?php

use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        Karyawan::create([
            'nama_karyawan' => 'Ahmad Fajar',
        ]);

        Karyawan::create([
            'nama_karyawan' => 'Halmar Bintang',
        ]);
        Karyawan::create([
            'nama_karyawan' => 'Reyhan Zidany',
        ]);
    }
}
