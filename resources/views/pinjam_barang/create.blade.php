@extends('components.app-layout')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Form Tambah Peminjaman</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pinjam_barang.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Pilih Barang</label>
            <select name="id_barang" id="barangSelect" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Barang --</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Kode Aset</label>
            <input type="text" id="kodeAset" name="kode_aset" class="w-full border rounded px-3 py-2" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Kembali (Rencana)</label>
            <input type="date" name="tanggal_kembali_rencana" class="w-full border rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('pinjam_barang.index') }}" class="text-gray-600 ml-3">Batal</a>
    </form>
</div>

{{-- JS AJAX --}}
<script>
    document.getElementById('barangSelect').addEventListener('change', function () {
        const idBarang = this.value;
        const kodeAsetInput = document.getElementById('kodeAset');

        if (idBarang) {
            fetch(`/barang/${idBarang}/kode-aset`)
                .then(response => response.json())
                .then(data => {
                    kodeAsetInput.value = data.kode_aset || '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    kodeAsetInput.value = '';
                });
        } else {
            kodeAsetInput.value = '';
        }
    });
</script>
@endsection
