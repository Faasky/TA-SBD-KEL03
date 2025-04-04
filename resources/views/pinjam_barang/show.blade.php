@extends('components.app-layout')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Detail Peminjaman</h2>

    <div class="mb-4">
        <label class="font-medium">Nama Barang:</label>
        <p class="text-gray-700">{{ $peminjaman->barang->nama_barang }}</p>
    </div>

    <div class="mb-4">
        <label class="font-medium">Nama Peminjam:</label>
        <p class="text-gray-700">{{ $peminjaman->karyawan->nama }}</p>
    </div>

    <div class="mb-4">
        <label class="font-medium">Tanggal Pinjam:</label>
        <p class="text-gray-700">{{ date('d M Y', strtotime($peminjaman->tanggal_pinjam)) }}</p>
    </div>

    <div class="mb-4">
        <label class="font-medium">Tanggal Kembali (Rencana):</label>
        <p class="text-gray-700">{{ date('d M Y', strtotime($peminjaman->tanggal_kembali_rencana)) }}</p>
    </div>

    <div class="mb-4">
        <label class="font-medium">Status:</label>
        <span class="px-3 py-1 rounded text-white 
            @if($peminjaman->status_pinjam == 'dipinjam') bg-blue-500
            @elseif($peminjaman->status_pinjam == 'terlambat') bg-red-500
            @else bg-green-500 @endif">
            {{ ucfirst($peminjaman->status_pinjam) }}
        </span>
    </div>

    <a href="{{ route('pinjam_barang.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar</a>
</div>
@endsection
