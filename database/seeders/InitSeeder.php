<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Penting: Kita panggil Model yang mau dipakai
use App\Models\Role;
use App\Models\User;
use App\Models\Equipment;
use Illuminate\Support\Facades\Hash;


class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Role dulu (Pastikan tabel roles sudah ada)
        // Kita simpan ke variabel agar id-nya bisa diambil
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'Pengunjung']);

        // 2. Buat User Admin
        User::create([
            'role_id' => $adminRole->id, // Ambil ID dari role admin yg baru dibuat
            'name' => 'Super Admin',
            'email' => 'admin@bedengan.com',
            'password' => Hash::make('12345') // Enkripsi password
        ]);

        // 3. Buat User Pengunjung (Opsional, buat tes aja)
        User::create([
            'role_id' => $userRole->id,
            'name' => 'Budi Pengunjung',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('12345')
        ]);

        // 4. Buat Equipment (Perlengkapan Camping)
        Equipment::create([
            'name' => 'Tenda 4 Orang',
            'description' => 'Tenda berkualitas tinggi untuk 4 orang, waterproof dan tahan angin',
            'price' => 100000,
            'quantity' => 5
        ]);

        Equipment::create([
            'name' => 'Sleeping Bag',
            'description' => 'Sleeping bag premium dengan suhu nyaman hingga 5°C',
            'price' => 50000,
            'quantity' => 10
        ]);

        Equipment::create([
            'name' => 'Matras Camping',
            'description' => 'Matras anti air dan tebal untuk kenyamanan maksimal',
            'price' => 30000,
            'quantity' => 8
        ]);

        Equipment::create([
            'name' => 'Kompor Portable',
            'description' => 'Kompor camping portabel dengan tabung gas kecil',
            'price' => 75000,
            'quantity' => 4
        ]);

        Equipment::create([
            'name' => 'Lampu Camping',
            'description' => 'Lampu LED camping rechargeable, terang dan hemat energi',
            'price' => 40000,
            'quantity' => 12
        ]);
    }
}