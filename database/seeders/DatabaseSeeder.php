<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder khusus yang sudah kita buat (berisi akun Wemvi, Admin, Guru)
        $this->call([
            UserSeeder::class,
        ]);
    }
}