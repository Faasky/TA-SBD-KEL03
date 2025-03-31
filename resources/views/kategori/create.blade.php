@extends('components.app-layout')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Tambah Kategori</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('kategori.store') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="nama_kategori" class="block font-medium">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="border p-2 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block font-medium">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="border p-2 rounded w-full"></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('kategori.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Batal</a>
            </form>
        </div>
    </div>
@endsection
