@extends('components.app-layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Peminjaman Barang Saya</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex flex-col sm:flex-row justify-between gap-2">
        <a href="{{ route('pinjam_barang.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm w-full sm:w-fit text-center">
            + Tambah Peminjaman
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left border">
            <thead class="bg-gray-100 text-xs font-semibold uppercase">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Barang</th>
                    <th class="px-4 py-2 border">Tanggal Pinjam</th>
                    <th class="px-4 py-2 border">Rencana Kembali</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjaman as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $data->barang->nama_barang }}</td>
                    <td class="px-4 py-2 border">{{ date('d M Y', strtotime($data->tanggal_pinjam)) }}</td>
                    <td class="px-4 py-2 border">{{ date('d M Y', strtotime($data->tanggal_kembali_rencana)) }}</td>
                    <td class="px-4 py-2 border">
                        <span class="px-2 py-1 text-white rounded 
                            @if($data->status_pinjam == 'dipinjam') bg-blue-500
                            @elseif($data->status_pinjam == 'terlambat') bg-red-500
                            @else bg-green-500 @endif">
                            {{ ucfirst($data->status_pinjam) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border flex flex-wrap gap-2">
                        <a href="{{ route('pinjam_barang.show', $data->id_pinjam_barang) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">Detail</a>
                        <a href="{{ route('pinjam_barang.edit', $data->id_pinjam_barang) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('pinjam_barang.destroy', $data->id_pinjam_barang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $peminjaman->links() }}
    </div>
</div>
@endsection
