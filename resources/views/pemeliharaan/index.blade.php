@extends('components.app-layout')

@section('title', 'Manajemen Pemeliharaan')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-4">Manajemen Pemeliharaan</h1>

    <!-- Tombol Tambah Pemeliharaan -->
    <div class="mb-4">
        <a href="{{ route('pemeliharaan.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
            + Tambah Pemeliharaan
        </a>
    </div>

    <!-- Tabel Pemeliharaan -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Barang</th>
                    <th class="border px-4 py-2">Tanggal Pemeliharaan</th>
                    <th class="border px-4 py-2">Deskripsi Masalah</th>
                    <th class="border px-4 py-2">Tindakan</th>
                    <th class="border px-4 py-2">Biaya</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Petugas</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemeliharaans as $index => $pemeliharaan)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $pemeliharaans->firstItem() + $index }}</td>
                    <td class="border px-4 py-2">{{ $pemeliharaan->barang->nama_barang }}</td>
                    <td class="border px-4 py-2">{{ $pemeliharaan->tanggal_pemeliharaan }}</td>
                    <td class="border px-4 py-2">{{ $pemeliharaan->deskripsi_masalah }}</td>
                    <td class="border px-4 py-2">{{ $pemeliharaan->tindakan }}</td>
                    <td class="border px-4 py-2">{{ number_format($pemeliharaan->biaya, 2, ',', '.') }}</td>
                    <td class="border px-4 py-2">
                        @if ($pemeliharaan->status == 'dalam proses')
                        <span class="bg-yellow-500 text-white px-2 py-1 rounded">Dalam Proses</span>
                        @else
                        <span class="bg-green-500 text-white px-2 py-1 rounded">Selesai</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $pemeliharaan->petugas }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('pemeliharaan.edit', $pemeliharaan->id_pemeliharaan) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('pemeliharaan.destroy', $pemeliharaan->id_pemeliharaan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemeliharaan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="border px-4 py-2 text-center">Tidak ada pemeliharaan ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pemeliharaans->links() }}
        </div>
    </div>
</div>
@endsection
