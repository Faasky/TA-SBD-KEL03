<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['barang', 'karyawan'])->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        $karyawans = Karyawan::where('is_deleted', 0)->get();

        if ($karyawans->isEmpty()) {
            dd($barangs, $karyawans);
            return redirect()->route('karyawan.create')
                ->with('error', 'Tidak ada karyawan yang tersedia. Silakan tambahkan karyawan terlebih dahulu.');
        }

        return view('peminjaman.create', compact('barangs', 'karyawans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id_barang',
            'karyawan_id' => 'required|exists:karyawans,id_karyawan',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
            'status_peminjaman' => 'required|string|in:dipinjam,terlambat,dikembalikan',
        ]);
        $validated['id_barang'] = $validated['barang_id'];
        $validated['id_karyawan'] = $validated['karyawan_id'];
        unset($validated['barang_id'], $validated['karyawan_id']);

        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_peminjaman)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id_peminjaman)->firstOrFail();
        $barangs = Barang::all();
        $karyawans = Karyawan::all();

        return view('peminjaman.edit', compact('peminjaman', 'barangs', 'karyawans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id_barang',
            'karyawan_id' => 'required|exists:karyawans,id_karyawan',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
            'status_peminjaman' => 'required|string|in:dipinjam,terlambat,dikembalikan',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_peminjaman)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id_peminjaman)->firstOrFail();
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
