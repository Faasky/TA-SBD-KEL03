@extends('layouts.app') 

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Barang -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Barang</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $totalBarang }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Karyawan -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Karyawan</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $totalKaryawan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Peminjaman -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Peminjaman</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $totalPeminjaman }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Chart & Daftar Kategori -->
                <div class="col-span-2 grid grid-cols-1 gap-6">
                    <!-- Status Barang -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Status Barang</h3>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($barangByStatus as $status)
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="text-xl font-bold">{{ $status->total }}</p>
                                    <p class="text-gray-600 capitalize">{{ $status->status }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barang Per Kategori -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Barang Per Kategori</h3>
                            <div class="space-y-4">
                                @foreach($barangByKategori as $kategori)
                                <div class="flex items-center">
                                    <div class="w-full">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium">{{ $kategori->nama_kategori }}</span>
                                            <span class="text-sm font-medium">{{ $kategori->total }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            @php
                                                $percentage = $totalBarang > 0 ? ($kategori->total / $totalBarang) * 100 : 0;
                                            @endphp
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Peminjaman Terbaru -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Peminjaman Terbaru</h3>
                        
                        <div class="space-y-4">
                            @foreach($peminjamanTerbaru as $peminjaman)
                            <div class="border-b pb-3">
                                <div class="flex justify-between mb-1">
                                    <span class="font-medium">{{ $peminjaman->barang->nama_barang }}</span>
                                    <span class="text-sm 
                                        @if($peminjaman->status_peminjaman == 'dipinjam') text-blue-600 
                                        @elseif($peminjaman->status_peminjaman == 'terlambat') text-red-600 
                                        @else text-green-600 @endif">
                                        {{ ucfirst($peminjaman->status_peminjaman) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Peminjam: {{ $peminjaman->karyawan->nama }}</p>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>Tanggal Pinjam: {{ date('d M Y', strtotime($peminjaman->tanggal_pinjam)) }}</span>
                                    <span>Kembali: {{ date('d M Y', strtotime($peminjaman->tanggal_kembali_rencana)) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if(auth()->user() && auth()->user()->role === 'admin')
                        <div class="mt-4">
                            <a href="{{ route('peminjaman.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Semua &rarr;
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection