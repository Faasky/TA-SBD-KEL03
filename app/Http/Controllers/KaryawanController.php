<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;



class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Karyawan::where('is_deleted', 0);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('departemen', 'like', "%{$search}%");
            });
        }
        
        // Filter role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        
        $karyawans = $query->latest()->paginate(10);
        
        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:karyawans',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,karyawan',
            'tanggal_bergabung' => 'required|date',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        
        Karyawan::create($validated);
        
        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:karyawans,email,'.$karyawan->id_karyawan.',id_karyawan',
            'role' => 'required|in:admin,karyawan',
            'tanggal_bergabung' => 'required|date',
        ]);
        
        // Update password jika ada
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Password::min(8)],
            ]);
            
            $validated['password'] = Hash::make($request->password);
        }
        
        $karyawan->update($validated);
        
        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil diperbarui.');
    }

   /**
 * Tampilkan data yang di-soft delete.
 */
public function trash()
{
    $karyawans = Karyawan::onlyTrashed()->where('is_deleted', 1)->latest()->paginate(10);
    return view('karyawan.trash', compact('karyawans'));
}

/**
 * Soft delete data.
 */
public function softDelete(Karyawan $karyawan)
{
    $karyawan->update(['is_deleted' => true]);
    $karyawan->delete(); // Ini akan mengisi deleted_at

    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus sementara.');
}

/**
 * Restore dari soft delete.
 */
public function restore($id)
{
    $karyawan = Karyawan::onlyTrashed()->where('id_karyawan', $id)->firstOrFail();
    $karyawan->update(['is_deleted' => false]);
    $karyawan->restore();

    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dipulihkan.');
}

/**
 * Hard delete permanen.
 */
public function destroy($id)
{
    $karyawan = Karyawan::onlyTrashed()->where('id_karyawan', $id)->firstOrFail();
    $karyawan->forceDelete();

    return redirect()->route('karyawan.trash')->with('success', 'Karyawan dihapus secara permanen.');
}
}
