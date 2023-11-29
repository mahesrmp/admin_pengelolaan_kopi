<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Hapus semua data dari tabel users sebelum menambahkan data dummy
        // DB::table('users')->truncate();

        // // Tambahkan data dummy
        // DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'email' => 'john@gmail.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Jane Doe',
        //     'email' => 'jane@gmail.com',
        //     'password' => Hash::make('password456'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'gilang',
        //     'email' => 'gilang@gmail.com',
        //     'password' => Hash::make('gilanglang1'),
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'gilang',
            'email' => 'gilang@gmail.com',
            'password' => Hash::make('gilanglang1'),

        ]);
    }
}
