@extends('components.app-layout')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Edit Data Peminjaman</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pinjam_barang.update', $peminjaman->id_pinjam_barang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Barang</label>
            <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100" value="{{ $peminjaman->barang->nama_barang }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Pinjam</label>
            <input type="date" class="w-full border rounded px-3 py-2 bg-gray-100" value="{{ $peminjaman->tanggal_pinjam }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Kembali (Rencana)</label>
            <input type="date" name="tanggal_kembali_rencana" class="w-full border rounded px-3 py-2" value="{{ $peminjaman->tanggal_kembali_rencana }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select name="status_pinjam" class="w-full border rounded px-3 py-2">
                <option value="dipinjam" {{ $peminjaman->status_pinjam == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="kembali" {{ $peminjaman->status_pinjam == 'kembali' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="terlambat" {{ $peminjaman->status_pinjam == 'terlambat' ? 'selected' : '' }}>Pengembalian Terlambat</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        <a href="{{ route('pinjam_barang.index') }}" class="text-gray-600 ml-3">Batal</a>
    </form>
</div>
@endsection
