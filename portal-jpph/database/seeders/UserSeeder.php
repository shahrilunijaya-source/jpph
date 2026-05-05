<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'super@jpph.demo'],
            ['name' => 'Datin Norazlin Ahmad', 'password' => Hash::make('Demo!2026'), 'role' => 'super_admin', 'email_verified_at' => now()],
        );
        User::query()->updateOrCreate(
            ['email' => 'admin@jpph.demo'],
            ['name' => 'Encik Rahman Othman', 'password' => Hash::make('Demo!2026'), 'role' => 'pentadbir_kandungan', 'email_verified_at' => now()],
        );
        User::query()->updateOrCreate(
            ['email' => 'staff@jpph.demo'],
            ['name' => 'Puan Aishah Ibrahim', 'password' => Hash::make('Demo!2026'), 'role' => 'staff', 'email_verified_at' => now()],
        );
    }
}
