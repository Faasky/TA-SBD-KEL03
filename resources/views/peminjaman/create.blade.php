@extends('components.app-layout')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-4">Tambah Peminjaman</h1>

    <!-- Form Tambah Peminjaman -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <!-- Pilih Barang -->
            <div class="mb-4">
                <label for="barang_id" class="block font-medium">Pilih Barang</label>
                <select name="barang_id" id="barang_id" class="border p-2 rounded w-full">
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
                @error('barang_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Pilih Karyawan -->
            <div class="mb-4">
                <label for="karyawan_id" class="block font-medium">Pilih Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="border p-2 rounded w-full">
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($karyawans as $karyawan)
                    <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
                @error('karyawan_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>



            <!-- Tanggal Pinjam -->
            <div class="mb-4">
                <label for="tanggal_pinjam" class="block font-medium">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="border p-2 rounded w-full">
                @error('tanggal_pinjam') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal Kembali Rencana -->
            <div class="mb-4">
                <label for="tanggal_kembali_rencana" class="block font-medium">Tanggal Kembali (Rencana)</label>
                <input type="date" name="tanggal_kembali_rencana" id="tanggal_kembali_rencana" class="border p-2 rounded w-full">
                @error('tanggal_kembali_rencana') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Status Peminjaman -->
            <div class="mb-4">
                <label for="status_peminjaman" class="block font-medium">Status Peminjaman</label>
                <select name="status_peminjaman" id="status_peminjaman" class="border p-2 rounded w-full">
                    <option value="dipinjam">Dipinjam</option>
                    <option value="terlambat">Terlambat</option>
                    <option value="dikembalikan">Dikembalikan</option>
                </select>
                @error('status_peminjaman') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('peminjaman.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection