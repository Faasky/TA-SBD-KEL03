<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\Peminjaman;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total item
        $totalBarang = Barang::where('is_deleted', 0)->count();
        $totalKaryawan = Karyawan::where('is_deleted', 0)->count();
        $totalPeminjaman = Peminjaman::where('is_deleted', 0)->count();
        
        // Barang berdasarkan status
        $barangByStatus = Barang::select('status', DB::raw('count(*) as total'))
            ->where('is_deleted', 0)
            ->groupBy('status')
            ->get();
        
        // Peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with(['karyawan', 'barang'])
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Barang berdasarkan kategori
        $barangByKategori = Kategori::select('kategoris.nama_kategori', DB::raw('count(barangs.id_barang) as total'))
            ->leftJoin('barangs', 'kategoris.id_kategori', '=', 'barangs.kategori_id')
            ->where('barangs.is_deleted', 0)
            ->groupBy('kategoris.id_kategori', 'kategoris.nama_kategori')
            ->get();
        
        return view('dashboard', compact(
            'totalBarang', 
            'totalKaryawan', 
            'totalPeminjaman', 
            'barangByStatus', 
            'peminjamanTerbaru',
            'barangByKategori'
        ));
    }
}