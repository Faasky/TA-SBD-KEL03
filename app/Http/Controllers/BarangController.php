<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori')->where('is_deleted', 0);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_aset', 'like', "%{$search}%")
                  ->orWhere('spesifikasi', 'like', "%{$search}%");
            });
        }
        
        // Filter kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $barangs = $query->latest()->paginate(10);
        $kategoris = Kategori::where('is_deleted', 0)->get();
        
        return view('barang.index', compact('barangs', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::where('is_deleted', 0)->get();
        return view('barang.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id_kategori',
            'spesifikasi' => 'nullable|string',
            'tanggal_pembelian' => 'required|date',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,dipinjam,rusak,dihapus',
            'lokasi' => 'nullable|string|max:255',
            'kode_aset' => 'required|string|max:255|unique:barangs,kode_aset',
            'gambar' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang-images', 'public');
            $validated['gambar'] = $path;
        }
        
        Barang::create($validated);
        
        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::where('is_deleted', 0)->get();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id_kategori',
            'spesifikasi' => 'nullable|string',
            'tanggal_pembelian' => 'required|date',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,dipinjam,rusak,dihapus',
            'lokasi' => 'nullable|string|max:255',
            'kode_aset' => 'required|string|max:255|unique:barangs,kode_aset,'.$barang->id_barang.',id_barang',
            'gambar' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            
            $path = $request->file('gambar')->store('barang-images', 'public');
            $validated['gambar'] = $path;
        }
        
        $barang->update($validated);
        
        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Soft delete the specified resource.
     */
    public function softDelete(Barang $barang)
    {
        $barang->update(['is_deleted' => true]);
        
        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus (soft delete).');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function destroy(Barang $barang)
    {
        // Hapus gambar jika ada
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }
        
        $barang->delete();
        
        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus secara permanen.');
    }

    public function getKodeAset($id)
{
    $barang = Barang::find($id);

    if (!$barang) {
        return response()->json(['kode_aset' => null], 404);
    }

    return response()->json(['kode_aset' => $barang->kode_aset]);
}

}