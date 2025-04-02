@extends('components.app-layout')

@section('title', 'Edit Pemeliharaan')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-4">Edit Pemeliharaan</h1>

    <form action="{{ route('pemeliharaan.update', $pemeliharaan->id_pemeliharaan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Barang -->
            <div class="mb-4">
                <label for="id_barang" class="block text-sm font-medium text-gray-700">Barang</label>
                <select id="id_barang" name="id_barang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                    <option value="{{ $barang->id_barang }}" {{ $barang->id_barang == $pemeliharaan->id_barang ? 'selected' : '' }}>
                        {{ $barang->nama_barang }}
                    </option>
                    @endforeach
                </select>
                @error('id_barang')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Pemeliharaan -->
            <div class="mb-4">
                <label for="tanggal_pemeliharaan" class="block text-sm font-medium text-gray-700">Tanggal Pemeliharaan</label>
                <input type="date" id="tanggal_pemeliharaan" name="tanggal_pemeliharaan" value="{{ old('tanggal_pemeliharaan', $pemeliharaan->tanggal_pemeliharaan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('tanggal_pemeliharaan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi Masalah -->
            <div class="mb-4">
                <label for="deskripsi_masalah" class="block text-sm font-medium text-gray-700">Deskripsi Masalah</label>
                <textarea id="deskripsi_masalah" name="deskripsi_masalah" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('deskripsi_masalah', $pemeliharaan->deskripsi_masalah) }}</textarea>
                @error('deskripsi_masalah')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tindakan -->
            <div class="mb-4">
                <label for="tindakan" class="block text-sm font-medium text-gray-700">Tindakan</label>
                <textarea id="tindakan" name="tindakan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('tindakan', $pemeliharaan->tindakan) }}</textarea>
                @error('tindakan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Biaya -->
            <div class="mb-4">
                <label for="biaya" class="block text-sm font-medium text-gray-700">Biaya</label>
                <input type="number" id="biaya" name="biaya" value="{{ old('biaya', $pemeliharaan->biaya) }}" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('biaya')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="dalam proses" {{ $pemeliharaan->status == 'dalam proses' ? 'selected' : '' }}>Dalam Proses</option>
                    <option value="selesai" {{ $pemeliharaan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Petugas -->
            <div class="mb-4">
                <label for="petugas" class="block text-sm font-medium text-gray-700">Petugas</label>
                <input type="text" id="petugas" name="petugas" value="{{ old('petugas', $pemeliharaan->petugas) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('petugas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4 flex justify-end space-x-4">
                <a href="{{ route('pemeliharaan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
