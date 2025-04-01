@extends('components.app-layout')

@section('title', 'Manajemen Peminjaman')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-4">Manajemen Peminjaman</h1>

    <!-- Tombol Tambah Peminjaman -->
    <div class="mb-4">
        <a href="{{ route('peminjaman.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
            + Tambah Peminjaman
        </a>
    </div>

    <!-- Tabel Peminjaman -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Barang</th>
                    <th class="border px-4 py-2">Peminjam</th>
                    <th class="border px-4 py-2">Tanggal Pinjam</th>
                    <th class="border px-4 py-2">Tanggal Kembali</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $index => $peminjaman)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $peminjamans->firstItem() + $index }}</td>
                    <td class="border px-4 py-2">{{ $peminjaman->barang->nama_barang }}</td>
                    <td class="border px-4 py-2">{{ $peminjaman->karyawan->nama }}</td>
                    <td class="border px-4 py-2">{{ $peminjaman->tanggal_pinjam }}</td>
                    <td class="border px-4 py-2">{{ $peminjaman->tanggal_kembali_rencana }}</td>
                    <td class="border px-4 py-2">
                        @if ($peminjaman->status_peminjaman == 'dipinjam')
                        <span class="bg-yellow-500 text-white px-2 py-1 rounded">Dipinjam</span>
                        @elseif ($peminjaman->status_peminjaman == 'terlambat')
                        <span class="bg-red-500 text-white px-2 py-1 rounded">Terlambat</span>
                        @else
                        <span class="bg-green-500 text-white px-2 py-1 rounded">Dikembalikan</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        {{ optional($peminjaman->karyawan)->nama_karyawan ?? 'Tidak Ada' }}
                    </td>

                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('peminjaman.edit', $peminjaman->id_peminjaman) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('peminjaman.destroy', $peminjaman->id_peminjaman) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">Tidak ada peminjaman ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $peminjamans->links() }}
        </div>
    </div>
</div>
@endsection