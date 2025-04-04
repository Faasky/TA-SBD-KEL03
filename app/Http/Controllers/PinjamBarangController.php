<?php

namespace App\Http\Controllers;

use App\Models\PinjamBarang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamBarangController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil hanya data peminjaman milik karyawan yang sedang login
        $peminjaman = PinjamBarang::with(['barang', 'karyawan'])
            ->where('id_karyawan', $user->id_karyawan)
            ->orderBy('tanggal_pinjam', 'desc')
            ->paginate(10); // Pastikan hasilnya berupa LengthAwarePaginator

        return view('pinjam_barang.index', compact('peminjaman'));
    }

    public function create()
    {
        $barangs = Barang::where('status', 'tersedia')->paginate(10);
        return view('pinjam_barang.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tanggal_kembali_rencana' => 'required|date|after:tanggal_pinjam',
        ]);

        PinjamBarang::create([
            'id_barang' => $request->id_barang,
            'id_karyawan' => Auth::user()->id_karyawan, // Ambil ID karyawan dari user login
            'tanggal_pinjam' => now(),
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status_pinjam' => 'dipinjam',
        ]);

        return redirect()->route('pinjam_barang.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $peminjaman = PinjamBarang::with(['barang', 'karyawan'])->findOrFail($id);
        return view('pinjam_barang.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = PinjamBarang::findOrFail($id);
        $barangs = Barang::where('status', 'tersedia')->paginate(10);
        return view('pinjam_barang.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = PinjamBarang::findOrFail($id);

        $request->validate([
            'tanggal_kembali_rencana' => 'required|date|after:tanggal_pinjam',
        ]);

        $peminjaman->update([
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status_pinjam' => $request->status_pinjam,
        ]);

        return redirect()->route('pinjam_barang.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = PinjamBarang::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('pinjam_barang.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
