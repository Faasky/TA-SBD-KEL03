<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use App\Models\Barang;
use Illuminate\Http\Request;

class PemeliharaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeliharaans = Pemeliharaan::with('barang')->where('is_deleted', false)->paginate(10);
        return view('pemeliharaan.index', compact('pemeliharaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('pemeliharaan.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tanggal_pemeliharaan' => 'required|date',
            'deskripsi_masalah' => 'required|string',
            'tindakan' => 'nullable|string',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:selesai,dalam proses',
            'petugas' => 'nullable|string'
        ]);

        Pemeliharaan::create($validated);

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Pemeliharaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemeliharaan = Pemeliharaan::findOrFail($id);
        $barangs = Barang::all();
        return view('pemeliharaan.edit', compact('pemeliharaan', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pemeliharaan = Pemeliharaan::findOrFail($id);

        $validated = $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tanggal_pemeliharaan' => 'required|date',
            'deskripsi_masalah' => 'required|string',
            'tindakan' => 'nullable|string',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:selesai,dalam proses',
            'petugas' => 'nullable|string'
        ]);

        $pemeliharaan->update($validated);

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Pemeliharaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemeliharaan = Pemeliharaan::findOrFail($id);
        $pemeliharaan->update(['is_deleted' => true]);

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Pemeliharaan berhasil dihapus.');
    }
}