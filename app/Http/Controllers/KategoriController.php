<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::where('is_deleted', 0)->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);
        
        Kategori::create($validated);
        
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id . ',id_kategori',
            'deskripsi' => 'nullable|string',
        ]);
        
        $kategori->update($validated);
        
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Soft delete the specified resource.
     */
    public function softDelete($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update(['is_deleted' => true]);
        
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus (soft delete).');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus secara permanen.');
    }
}
// Compare this snippet from app/Http/Controllers/PeminjamanController.php:

