@extends('components.app-layout')

@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold mb-4">Edit Karyawan</h1>

    <!-- Error handling -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Karyawan Edit Form -->
    <form action="{{ route('karyawan.update', $karyawan->id_karyawan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Nama -->
            <div class="flex flex-col">
                <label for="nama" class="text-sm font-medium text-gray-700">Nama Karyawan</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $karyawan->nama) }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $karyawan->email) }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Departemen -->
            <div class="flex flex-col">
                <label for="departemen" class="text-sm font-medium text-gray-700">Departemen</label>
                <input type="text" name="departemen" id="departemen" value="{{ old('departemen', $karyawan->departemen) }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Role -->
            <div class="flex flex-col">
                <label for="role" class="text-sm font-medium text-gray-700">Peran</label>
                <select name="role" id="role" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="admin" {{ old('role', $karyawan->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ old('role', $karyawan->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                </select>
            </div>

            <!-- Tanggal Bergabung -->
            <div class="flex flex-col">
                <label for="tanggal_bergabung" class="text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung" id="tanggal_bergabung" value=">{{ \Carbon\Carbon::parse($karyawan->created_at)->format('d M Y') }}<" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Submit button -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <!-- Cancel button -->
    <div class="mt-4">
        <a href="{{ route('karyawan.index') }}" class="text-blue-500 hover:text-blue-700">Kembali ke Daftar Karyawan</a>
    </div>
</div>
@endsection
