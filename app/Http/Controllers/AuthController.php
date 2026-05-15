<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('page.login'); 
    }

    public function showRegisterForm()
    {
        return view('page.register'); 
    }

    public function loginProcess(Request $request)
    {
        // Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek ke Database (Auth::attempt)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // Cek role
            // asumsi nama role di database adalah 'Admin' untuk admin
            if ($user->role->name === 'Admin') {
                return redirect()->route('dashboard')->with('success', 'Selamat Datang Admin!');
            } 
            
            // if not admin maka pengunjung
            return redirect()->route('home')->with('success', 'Login Berhasil! Selamat berlibur.');
        }

        // Jika gfagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }

    //refister
    public function registerProcess(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        // Cek Role Pengunjung
        $rolePengunjung = Role::where('name', 'Pengunjung')->first();

        // Safety check: Kalau database role kosong (belum di-seeder), biar tidak error
        if (!$rolePengunjung) {
            return back()->withErrors(['msg' => 'Role Pengunjung belum disetting di database. Hubungi admin.']);
        }

        // Create user pengunjung
        $user = User::create([
            'role_id' => $rolePengunjung->id,
            'name' => $request->name,   // Ini sekarang bisa diambil karena di blade sudah ada name="name"
            'email' => $request->email, // Ini juga
            'password' => Hash::make($request->password), // Hash sudah diimport di atas
        ]);

        Auth::login($user);

        // Redirect
        return redirect()->route('home')->with('success', 'Akun berhasil dibuat!');
    }
}