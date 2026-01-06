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
        $this->call([
            UserSeeder::class,        // Users first
            AmenitySeeder::class,     // Then amenities
            CampSeeder::class,        // Then camps (needs users & amenities)
        ]);
    }
}