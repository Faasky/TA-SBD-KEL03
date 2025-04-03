@extends('components.app-layout')

@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold mb-4">Tambah Karyawan Baru</h1>

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

    <!-- Karyawan Create Form -->
    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Nama -->
            <div class="flex flex-col">
                <label for="nama" class="text-sm font-medium text-gray-700">Nama Karyawan</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Departemen -->
            <div class="flex flex-col">
                <label for="departemen" class="text-sm font-medium text-gray-700">Departemen</label>
                <input type="text" name="departemen" id="departemen" value="{{ old('departemen') }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Role -->
            <div class="flex flex-col">
                <label for="role" class="text-sm font-medium text-gray-700">Peran</label>
                <select name="role" id="role" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                </select>
            </div>

            <!-- Tanggal Bergabung -->
            <div class="flex flex-col">
                <label for="tanggal_bergabung" class="text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung" id="tanggal_bergabung" value="{{ old('tanggal_bergabung') }}" class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full p-2 border rounded-lg" required>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border rounded-lg" required>
        </div>

        <!-- Submit button -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                Tambah Karyawan
            </button>
        </div>
    </form>

    <!-- Cancel button -->
    <div class="mt-4">
        <a href="{{ route('karyawan.index') }}" class="text-blue-500 hover:text-blue-700">Kembali ke Daftar Karyawan</a>
    </div>
</div>
@endsection