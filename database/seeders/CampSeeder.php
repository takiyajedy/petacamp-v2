<?php

namespace Database\Seeders;

use App\Models\Camp;
use App\Models\Amenity;
use App\Models\User;
use Illuminate\Database\Seeder;

class CampSeeder extends Seeder
{
    public function run(): void
    {
        // Get all regular users (not admin)
        $users = User::where('role', 'user')->get();
        
        if ($users->isEmpty()) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $camps = [
            [
                'name' => 'Taman Negara Camping',
                'name_bm' => 'Perkhemahan Taman Negara',
                'address' => 'Jalan Taman Negara, 27000 Jerantut, Pahang',
                'state' => 'Pahang',
                'city' => 'Jerantut',
                'postcode' => '27000',
                'latitude' => 4.3647,
                'longitude' => 102.3886,
                'description' => 'Experience camping in one of the oldest rainforests in the world. Perfect for nature lovers and adventure seekers.',
                'description_bm' => 'Alami perkhemahan di salah satu hutan hujan tertua di dunia. Sesuai untuk pencinta alam dan pencari pengembaraan.',
                'phone' => '09-266 1234',
                'email' => 'info@tamannegara.com.my',
                'website' => 'https://www.tamannegara.com.my',
                'price_per_night' => 35.00,
                'price_per_person' => 15.00,
                'max_capacity' => 50,
                'tent_sites' => 15,
                'status' => 'approved',
            ],
            [
                'name' => 'Fraser\'s Hill Camping Ground',
                'name_bm' => 'Tapak Perkhemahan Bukit Fraser',
                'address' => 'Fraser\'s Hill, 49000 Raub, Pahang',
                'state' => 'Pahang',
                'city' => 'Raub',
                'postcode' => '49000',
                'latitude' => 3.7196,
                'longitude' => 101.7381,
                'description' => 'Cool highland camping with bird watching activities. Enjoy the fresh mountain air and scenic views.',
                'description_bm' => 'Perkhemahan di kawasan tinggi yang sejuk dengan aktiviti pemerhatian burung. Nikmati udara gunung yang segar dan pemandangan indah.',
                'phone' => '09-362 2007',
                'email' => 'info@frasershill.com',
                'price_per_night' => 25.00,
                'max_capacity' => 30,
                'tent_sites' => 10,
                'status' => 'approved',
            ],
            [
                'name' => 'Melaka Riverfront Camp',
                'name_bm' => 'Perkhemahan Tepi Sungai Melaka',
                'address' => 'Jalan Kota Laksamana, 75200 Melaka',
                'state' => 'Melaka',
                'city' => 'Melaka',
                'postcode' => '75200',
                'latitude' => 2.1896,
                'longitude' => 102.2501,
                'description' => 'Urban camping experience by the historic Melaka River. Close to tourist attractions.',
                'description_bm' => 'Pengalaman perkhemahan bandar di tepi Sungai Melaka yang bersejarah. Berhampiran dengan tarikan pelancong.',
                'phone' => '06-288 9988',
                'email' => 'camp@melaka.com',
                'website' => 'https://www.melakacamp.com',
                'price_per_night' => 40.00,
                'price_per_person' => 20.00,
                'max_capacity' => 40,
                'tent_sites' => 12,
                'status' => 'approved',
            ],
            [
                'name' => 'Cameron Highlands Valley Camp',
                'name_bm' => 'Kem Lembah Cameron Highlands',
                'address' => 'Brinchang, 39000 Cameron Highlands, Pahang',
                'state' => 'Pahang',
                'city' => 'Cameron Highlands',
                'postcode' => '39000',
                'latitude' => 4.5089,
                'longitude' => 101.3779,
                'description' => 'Highland camping surrounded by tea plantations and strawberry farms.',
                'description_bm' => 'Perkhemahan tanah tinggi dikelilingi ladang teh dan strawberi.',
                'phone' => '05-491 2345',
                'price_per_night' => 30.00,
                'max_capacity' => 35,
                'tent_sites' => 12,
                'status' => 'approved',
            ],
            [
                'name' => 'Desaru Beach Camp',
                'name_bm' => 'Kem Pantai Desaru',
                'address' => 'Jalan Pantai, 81900 Kota Tinggi, Johor',
                'state' => 'Johor',
                'city' => 'Kota Tinggi',
                'postcode' => '81900',
                'latitude' => 1.5534,
                'longitude' => 104.2517,
                'description' => 'Beachfront camping with water activities. Perfect for families and beach lovers.',
                'description_bm' => 'Perkhemahan tepi pantai dengan aktiviti air. Sesuai untuk keluarga dan pencinta pantai.',
                'phone' => '07-822 1234',
                'email' => 'info@desarucamp.com',
                'price_per_night' => 45.00,
                'price_per_person' => 25.00,
                'max_capacity' => 60,
                'tent_sites' => 20,
                'status' => 'approved',
            ],
            [
                'name' => 'Gopeng Rainforest Camp',
                'name_bm' => 'Kem Hutan Hujan Gopeng',
                'address' => 'Gopeng, 31600 Perak',
                'state' => 'Perak',
                'city' => 'Gopeng',
                'postcode' => '31600',
                'latitude' => 4.4670,
                'longitude' => 101.1619,
                'description' => 'Adventure camping with white water rafting and jungle trekking activities.',
                'description_bm' => 'Perkhemahan pengembaraan dengan aktiviti rafting air putih dan mendaki hutan.',
                'phone' => '05-359 8888',
                'price_per_night' => 38.00,
                'max_capacity' => 45,
                'tent_sites' => 14,
                'status' => 'approved',
            ],
            [
                'name' => 'Pulau Perhentian Camp Site',
                'name_bm' => 'Tapak Perkhemahan Pulau Perhentian',
                'address' => 'Pulau Perhentian, 22300 Besut, Terengganu',
                'state' => 'Terengganu',
                'city' => 'Besut',
                'postcode' => '22300',
                'latitude' => 5.9134,
                'longitude' => 102.7423,
                'description' => 'Island camping with crystal clear waters. Snorkeling and diving paradise.',
                'description_bm' => 'Perkhemahan pulau dengan air yang jernih. Syurga snorkeling dan menyelam.',
                'phone' => '09-697 5555',
                'price_per_night' => 50.00,
                'max_capacity' => 30,
                'tent_sites' => 8,
                'status' => 'approved',
            ],
            [
                'name' => 'Kota Kinabalu Eco Camp',
                'name_bm' => 'Kem Eko Kota Kinabalu',
                'address' => 'Jalan Bundusan, 88300 Kota Kinabalu, Sabah',
                'state' => 'Sabah',
                'city' => 'Kota Kinabalu',
                'postcode' => '88300',
                'latitude' => 5.9788,
                'longitude' => 116.0753,
                'description' => 'Eco-friendly camping near Mount Kinabalu. Experience Sabah\'s natural beauty.',
                'description_bm' => 'Perkhemahan mesra alam berhampiran Gunung Kinabalu. Alami keindahan alam Sabah.',
                'phone' => '088-232 456',
                'price_per_night' => 42.00,
                'max_capacity' => 40,
                'tent_sites' => 15,
                'status' => 'approved',
            ],
            [
                'name' => 'Kuching Riverside Camp',
                'name_bm' => 'Kem Tepi Sungai Kuching',
                'address' => 'Jalan Satok, 93400 Kuching, Sarawak',
                'state' => 'Sarawak',
                'city' => 'Kuching',
                'postcode' => '93400',
                'latitude' => 1.5535,
                'longitude' => 110.3422,
                'description' => 'Urban riverside camping in the heart of Kuching city.',
                'description_bm' => 'Perkhemahan tepi sungai bandar di tengah bandaraya Kuching.',
                'phone' => '082-424 567',
                'price_per_night' => 35.00,
                'max_capacity' => 35,
                'tent_sites' => 10,
                'status' => 'approved',
            ],
            [
                'name' => 'Janda Baik Forest Camp',
                'name_bm' => 'Kem Hutan Janda Baik',
                'address' => 'Janda Baik, 28750 Bentong, Pahang',
                'state' => 'Pahang',
                'city' => 'Bentong',
                'postcode' => '28750',
                'latitude' => 3.3210,
                'longitude' => 101.8510,
                'description' => 'Peaceful forest camping with river activities. Popular weekend getaway.',
                'description_bm' => 'Perkhemahan hutan yang aman dengan aktiviti sungai. Percutian hujung minggu yang popular.',
                'phone' => '09-234 5678',
                'price_per_night' => 28.00,
                'max_capacity' => 25,
                'tent_sites' => 8,
                'status' => 'approved',
            ],
            [
                'name' => 'Penang Hill Camping Ground',
                'name_bm' => 'Tapak Perkhemahan Bukit Bendera',
                'address' => 'Bukit Bendera, 11500 Air Itam, Penang',
                'state' => 'Penang',
                'city' => 'Air Itam',
                'postcode' => '11500',
                'latitude' => 5.4250,
                'longitude' => 100.2778,
                'description' => 'Highland camping with panoramic views of Penang island.',
                'description_bm' => 'Perkhemahan tanah tinggi dengan pemandangan panorama Pulau Pinang.',
                'phone' => '04-829 1234',
                'price_per_night' => 32.00,
                'max_capacity' => 28,
                'tent_sites' => 9,
                'status' => 'approved',
            ],
            [
                'name' => 'Port Dickson Beach Camp',
                'name_bm' => 'Kem Pantai Port Dickson',
                'address' => 'Jalan Pantai, 71000 Port Dickson, Negeri Sembilan',
                'state' => 'Negeri Sembilan',
                'city' => 'Port Dickson',
                'postcode' => '71000',
                'latitude' => 2.5289,
                'longitude' => 101.8306,
                'description' => 'Beachside camping close to Kuala Lumpur. Great for weekend trips.',
                'description_bm' => 'Perkhemahan tepi pantai berhampiran Kuala Lumpur. Sesuai untuk percutian hujung minggu.',
                'phone' => '06-647 8888',
                'price_per_night' => 38.00,
                'max_capacity' => 50,
                'tent_sites' => 18,
                'status' => 'approved',
            ],
        ];

        foreach ($camps as $index => $campData) {
            // Assign to random user
            $campData['created_by'] = $users->random()->id;
            
            $camp = Camp::create($campData);
            
            // Attach random amenities (4-8 amenities per camp)
            $amenities = Amenity::inRandomOrder()->limit(rand(4, 8))->pluck('id');
            $camp->amenities()->attach($amenities);
            
            $this->command->info("✓ Created camp: {$camp->name}");
        }

        $this->command->info('✓ Successfully created ' . count($camps) . ' camps with amenities');
    }
}