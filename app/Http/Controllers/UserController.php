<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get(); 
        return view('dashboard.users.index', compact('users'));
    }

    // form tambah user baru
    public function create()
    {
        $roles = Role::all(); 
        return view('dashboard.users.create', compact('roles'));
    }

    // simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role_id' => 'required' 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id 
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan lewat Dashboard!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        
        // lempar balik ke view
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    //simpan edit/update
    public function update(Request $request, User $user)
    {
        // Validasi
        $request->validate([
            'name' => 'required|max:255',
            // Rule unik khusus: Boleh pakai email lama milik sendiri (ignore id)
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
            // Password boleh kosong jika tidak ingin mengganti
            'password' => 'nullable|min:5', 
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        // logika ganti password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
    }
    // hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}