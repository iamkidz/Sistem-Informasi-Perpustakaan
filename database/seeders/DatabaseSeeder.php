<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'alamat' => '-',
                'level' => 1,
            ],
            [
                'nama' => 'Petugas',
                'username' => 'petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('petugas'),
                'alamat' => '-',
                'level' => 2,
            ],
            [
                'nama' => 'Peminjam',
                'username' => 'peminjam',
                'email' => 'peminjam@gmail.com',
                'password' => Hash::make('peminjam'),
                'alamat' => '-',
                'level' => 3,
            ]
        ];

        \App\Models\User::insert($user);
    }
}
