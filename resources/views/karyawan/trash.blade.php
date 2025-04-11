@extends('components.app-layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Data Karyawan Terhapus (Trash)</h1>

    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('karyawan.trash') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" class="border rounded p-2" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
        </form>
        <a href="{{ route('karyawan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">← Kembali</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm md:text-base">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Departemen</th>
                    <th class="border p-2">Peran</th>
                    <th class="border p-2">Tanggal Bergabung</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawans as $karyawan)
                <tr class="border">
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $karyawan->nama }}</td>
                    <td class="border p-2">{{ $karyawan->email }}</td>
                    <td class="border p-2">{{ $karyawan->departemen }}</td>
                    <td class="border p-2 text-center">{{ ucfirst($karyawan->role) }}</td>
                    <td class="border p-2 text-center">{{ $karyawan->tanggal_bergabung }}</td>
                    <td class="border p-2 text-center flex flex-col md:flex-row gap-2 justify-center">
                        <form action="{{ route('karyawan.restore', $karyawan->id_karyawan) }}" method="POST" onsubmit="return confirm('Kembalikan karyawan ini?')">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Restore</button>
                        </form>
                        <form action="{{ route('karyawan.deletePermanent', $karyawan->id_karyawan) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-4">Tidak ada data karyawan terhapus.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4">
        {{ $karyawans->links() }}
    </div>
</div>
@endsection