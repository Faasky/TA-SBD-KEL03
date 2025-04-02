@extends('components.app-layout')

@section('title', 'Manajemen Barang')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Manajemen Barang</h1>

        <!-- Tombol Tambah Barang -->
        <div class="mb-4">
            <a href="{{ route('barang.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                + Tambah Barang
            </a>
        </div>

        <!-- Search & Filter -->
        <form method="GET" action="{{ route('barang.index') }}" class="mb-4 flex flex-col gap-2 sm:flex-row sm:space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Barang..."
                class="border p-2 rounded w-full sm:w-1/3">

            <select name="kategori_id" class="border p-2 rounded w-full sm:w-auto">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}" {{ request('kategori_id') == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="border p-2 rounded w-full sm:w-auto">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="rusak" {{ request('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
            </select>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                <a href="{{ route('barang.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Reset</a>
            </div>
        </form>

        <!-- Tabel Barang -->
        <div class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Barang</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $barang)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $barangs->firstItem() + $index }}</td>
                            <td class="border px-4 py-2">{{ $barang->nama_barang }}</td>
                            <td class="border px-4 py-2">{{ $barang->kategori->nama_kategori }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($barang->status) }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border px-4 py-2 text-center">Tidak ada barang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $barangs->links() }}
            </div>
        </div>
    </div>
@endsection
