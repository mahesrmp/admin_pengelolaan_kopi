<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama_lengkap' => 'ahmad',
            'username' => 'ahmad',
            'role' => 'fasilitator',
            'password' => Hash::make('ahmad1'),
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
            'password' => Hash::make('admin01'),
        ]);
    }
}
