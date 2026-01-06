<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            ['key' => 'parking', 'label_en' => 'Parking', 'label_bm' => 'Tempat Letak Kereta', 'icon' => 'fa-parking', 'order' => 1],
            ['key' => 'toilet', 'label_en' => 'Toilet', 'label_bm' => 'Tandas', 'icon' => 'fa-restroom', 'order' => 2],
            ['key' => 'shower', 'label_en' => 'Shower', 'label_bm' => 'Pancuran', 'icon' => 'fa-shower', 'order' => 3],
            ['key' => 'wifi', 'label_en' => 'WiFi', 'label_bm' => 'WiFi', 'icon' => 'fa-wifi', 'order' => 4],
            ['key' => 'electric', 'label_en' => 'Electricity', 'label_bm' => 'Elektrik', 'icon' => 'fa-plug', 'order' => 5],
            ['key' => 'bbq', 'label_en' => 'BBQ Area', 'label_bm' => 'Kawasan BBQ', 'icon' => 'fa-fire', 'order' => 6],
            ['key' => 'playground', 'label_en' => 'Playground', 'label_bm' => 'Taman Permainan', 'icon' => 'fa-child', 'order' => 7],
            ['key' => 'hiking', 'label_en' => 'Hiking Trail', 'label_bm' => 'Laluan Mendaki', 'icon' => 'fa-hiking', 'order' => 8],
            ['key' => 'river', 'label_en' => 'River/Stream', 'label_bm' => 'Sungai', 'icon' => 'fa-water', 'order' => 9],
            ['key' => 'lake', 'label_en' => 'Lake', 'label_bm' => 'Tasik', 'icon' => 'fa-swimming-pool', 'order' => 10],
            ['key' => 'shop', 'label_en' => 'Shop/Store', 'label_bm' => 'Kedai', 'icon' => 'fa-store', 'order' => 11],
            ['key' => 'security', 'label_en' => 'Security', 'label_bm' => 'Keselamatan', 'icon' => 'fa-shield-alt', 'order' => 12],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}