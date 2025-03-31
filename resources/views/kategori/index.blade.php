@extends('components.app-layout')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Manajemen Kategori</h1>

        <!-- Tombol Tambah Kategori -->
        <div class="mb-4">
            <a href="{{ route('kategori.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                + Tambah Kategori
            </a>
        </div>

        <!-- Tabel Kategori -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Kategori</th>
                        <th class="border px-4 py-2">Deskripsi</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $index => $kategori)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $kategoris->firstItem() + $index }}</td>
                            <td class="border px-4 py-2">{{ $kategori->nama_kategori }}</td>
                            <td class="border px-4 py-2">{{ $kategori->deskripsi }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('kategori.edit', $kategori->id_kategori) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border px-4 py-2 text-center">Tidak ada kategori ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
@endsection
