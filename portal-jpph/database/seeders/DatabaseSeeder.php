<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CaseDutiSetemSeeder::class,
            CasePinjamanPerumahanSeeder::class,
            CaseTukarSyaratSeeder::class,
            PageSeeder::class,
            AnnouncementSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
