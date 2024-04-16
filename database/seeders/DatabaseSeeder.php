<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        \App\Models\User::factory()->create([
            'nama_lengkap' => 'gilang sukses',
            'username' => 'gilang',
            'password' => Hash::make('gilanglang1'),
            'confirm_password' => Hash::make('gilanglang1'),

        ]);
    }
}
