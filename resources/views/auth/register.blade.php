<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Inventaris Kantor</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 py-4">
                <h2 class="text-center text-white text-2xl font-bold">Sistem Inventaris Kantor</h2>
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-700 mb-6 text-center">Daftar Akun Baru</h3>
                
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required autofocus class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="departemen" class="block text-gray-700 font-medium mb-2">Departemen</label>
                        <input type="text" name="departemen" id="departemen" value="{{ old('departemen') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Role Field -->
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
                        <select name="role" id="role" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                            <!-- Add more roles as needed -->
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Minimal 8 karakter</p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Daftar
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-gray-600">Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
