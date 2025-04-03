<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    
    public function register()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'departemen' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:karyawans'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $role = Karyawan::count() == 0 ? 'admin' : 'karyawan'; // Admin jika ini user pertama
        if ($role == 'admin') {
            $request->validate([
                'role' => ['required', 'in:admin,karyawan'],
            ]);
        } else {
            $request->validate([
                'role' => ['required', 'in:karyawan'],
            ]);
        }
        // Cek apakah email sudah terdaftar
        if (Karyawan::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Email sudah terdaftar.']);
        }
        // Cek apakah password sudah sesuai
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password' => 'Password tidak sesuai.']);
        }
        // Cek apakah role sudah sesuai
        if ($role == 'admin' && $request->role !== 'admin') {
            return back()->withErrors(['role' => 'Role tidak sesuai.']);
        }
        if ($role == 'karyawan' && $request->role !== 'karyawan') {
            return back()->withErrors(['role' => 'Role tidak sesuai.']);
        }
        // Cek apakah tanggal bergabung sudah sesuai
        if ($request->tanggal_bergabung > now()) {
            return back()->withErrors(['tanggal_bergabung' => 'Tanggal bergabung tidak sesuai.']);
        }
        // Cek apakah password sudah sesuai
        if (strlen($request->password) < 8) {
            return back()->withErrors(['password' => 'Password minimal 8 karakter.']);
        }
        // Cek apakah password sudah sesuai
        if (!preg_match('/[A-Z]/', $request->password)) {
            return back()->withErrors(['password' => 'Password harus mengandung huruf kapital.']);
        }
        if (!preg_match('/[a-z]/', $request->password)) {
            return back()->withErrors(['password' => 'Password harus mengandung huruf kecil.']);
        }
        if (!preg_match('/[0-9]/', $request->password)) {
            return back()->withErrors(['password' => 'Password harus mengandung angka.']);
        }
        $user = Karyawan::create([
            'nama' => $request->nama,
            'departemen' => $request->departemen,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'karyawan', // Default role is karyawan
            'tanggal_bergabung' => now(),
        ]);
        
        Auth::login($user);
        
        return redirect()->route('dashboard');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}