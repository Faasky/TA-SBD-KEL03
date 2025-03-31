@extends('components.app-layout')

@section('title', 'Edit Barang')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Edit Barang</h1>

        <!-- Form Edit Barang -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nama Barang -->
                    <div>
                        <label class="block text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" required class="w-full border p-2 rounded" value="{{ old('nama_barang', $barang->nama_barang) }}">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-gray-700">Kategori</label>
                        <select name="kategori_id" required class="w-full border p-2 rounded">
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ $barang->kategori_id == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Spesifikasi -->
                    <div class="col-span-2">
                        <label class="block text-gray-700">Spesifikasi</label>
                        <textarea name="spesifikasi" class="w-full border p-2 rounded">{{ old('spesifikasi', $barang->spesifikasi) }}</textarea>
                    </div>

                    <!-- Tanggal Pembelian -->
                    <div>
                        <label class="block text-gray-700">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" required class="w-full border p-2 rounded" value="{{ old('tanggal_pembelian', $barang->tanggal_pembelian) }}">
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-gray-700">Harga</label>
                        <input type="number" name="harga" required class="w-full border p-2 rounded" value="{{ old('harga', $barang->harga) }}">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700">Status</label>
                        <select name="status" required class="w-full border p-2 rounded">
                            <option value="tersedia" {{ $barang->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipinjam" {{ $barang->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="rusak" {{ $barang->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="block text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" class="w-full border p-2 rounded" value="{{ old('lokasi', $barang->lokasi) }}">
                    </div>

                    <!-- Kode Aset -->
                    <div>
                        <label class="block text-gray-700">Kode Aset</label>
                        <input type="text" name="kode_aset" required class="w-full border p-2 rounded" value="{{ old('kode_aset', $barang->kode_aset) }}">
                    </div>

                    <!-- Gambar -->
                    <div class="col-span-2">
                        <label class="block text-gray-700">Gambar (Opsional)</label>
                        <input type="file" name="gambar" class="w-full border p-2 rounded">
                        @if ($barang->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="w-32 rounded">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('barang.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
