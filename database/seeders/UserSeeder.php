<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyuntikkan 3 data akun ke dalam tabel users
        DB::table('users')->insert([
            [
                'username' => 'admin_sarpras',
                'nama_lengkap' => 'Admin Tata Usaha',
                'password' => Hash::make('password123'), // Disandikan demi keamanan
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'guru_budi',
                'nama_lengkap' => 'Budi Santoso, S.Pd.',
                'password' => Hash::make('password123'),
                'role' => 'Guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'wemvi',
                'nama_lengkap' => 'wemvi afrialdo',
                'password' => Hash::make('password123'),
                'role' => 'Siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}