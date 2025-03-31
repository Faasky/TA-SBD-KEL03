<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Komputer',
                'deskripsi' => 'Semua jenis komputer dan perangkat terkait'
            ],
            [
                'nama_kategori' => 'Furnitur',
                'deskripsi' => 'Meja, kursi, dan perabotan kantor'
            ],
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Perangkat elektronik kantor'
            ],
            [
                'nama_kategori' => 'Alat Tulis',
                'deskripsi' => 'Barang-barang untuk menulis dan berkas'
            ],
        ];
        
        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}