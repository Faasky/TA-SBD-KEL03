<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris Kantor')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }">
        <!-- Sidebar untuk mobile -->
        <div x-show="sidebarOpen" @click.away="sidebarOpen = false" class="md:hidden fixed inset-0 z-40 flex">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-blue-700">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Sidebar content -->
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4">
                        <h1 class="text-white font-bold text-xl">Inventaris Kantor</h1>
                    </div>
                    <nav class="mt-5 px-2 space-y-1">
                        <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            Dashboard
                        </a>
                        
                        @if(auth()->user() && auth()->user()->role === 'admin')
                        <a href="{{ route('barang.index') }}" class="@if(request()->routeIs('barang.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            Manajemen Barang
                        </a>
                        <a href="{{ route('kategori.index') }}" class="@if(request()->routeIs('kategori.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            Kategori
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="@if(request()->routeIs('peminjaman.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            Peminjaman
                        </a>
                        <a href="{{ route('pemeliharaan.index') }}" class="@if(request()->routeIs('pemeliharaan.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            Pemeliharaan
                        </a>
                        <a href="{{ route('karyawan.index') }}" class="@if(request()->routeIs('karyawan.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            Manajemen Karyawan
                        </a>
                        @endif
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-blue-800 p-4">
                    <div class="flex items-center">
                        <div>
                            <p class="text-white font-medium">{{ auth()->user()->nama ?? 'User' }}</p>
                            <p class="text-blue-200 text-sm">{{ auth()->user()->email ?? 'email@example.com' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0 w-14"></div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <div class="flex-1 flex flex-col min-h-0 bg-blue-700">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <h1 class="text-white font-bold text-xl">Inventaris Kantor</h1>
                    </div>
                    <nav class="mt-5 flex-1 px-2 space-y-1">
                        <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Dashboard
                        </a>
                        
                        @if(auth()->user() && auth()->user()->role === 'admin')
                        <a href="{{ route('barang.index') }}" class="@if(request()->routeIs('barang.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Manajemen Barang
                        </a>
                        <a href="{{ route('kategori.index') }}" class="@if(request()->routeIs('kategori.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Kategori
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="@if(request()->routeIs('peminjaman.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Peminjaman
                        </a>
                        <a href="{{ route('pemeliharaan.index') }}" class="@if(request()->routeIs('pemeliharaan.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Pemeliharaan
                        </a>
                        <a href="{{ route('karyawan.index') }}" class="@if(request()->routeIs('karyawan.*')) bg-blue-800 @endif text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Manajemen Karyawan
                        </a>
                        @endif
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-blue-800 p-4">
                    <div class="flex items-center">
                        <div>
                            <p class="text-white font-medium">{{ auth()->user()->nama ?? 'User' }}</p>
                            <p class="text-blue-200 text-sm">{{ auth()->user()->email ?? 'email@example.com' }}</p>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit" class="text-blue-200 hover:text-white text-sm">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:pl-64 flex flex-col flex-1">
            <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
                <button @click.stop="sidebarOpen = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <main class="flex-1">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            @yield('content')
        </div>
    </div>
</main>
