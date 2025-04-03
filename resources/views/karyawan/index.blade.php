@extends('components.app-layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Manajemen Karyawan</h1>
    
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-4 gap-4">
        <form action="{{ route('karyawan.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
            <input type="text" name="search" class="border rounded p-2 w-full md:w-48" placeholder="Cari nama/email..." value="{{ request('search') }}">
            <select name="role" class="border rounded p-2 w-full md:w-32">
                <option value="">Semua Peran</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="karyawan" {{ request('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
        </form>
        <a href="{{ route('karyawan.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Karyawan</a>
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
                @foreach ($karyawans as $karyawan)
                <tr class="border">
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $karyawan->nama }}</td>
                    <td class="border p-2">{{ $karyawan->email }}</td>
                    <td class="border p-2">{{ $karyawan->departemen }}</td>
                    <td class="border p-2 text-center">{{ ucfirst($karyawan->role) }}</td>
                    <td class="text-center">{{ $karyawan->tanggal_bergabung }}</td>
                    <td class="border p-2 text-center flex flex-col md:flex-row gap-2">
                        <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-center">Edit</a>
                        <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="flex justify-center mt-4">
        {{ $karyawans->links() }}
    </div>
</div>
@endsection
