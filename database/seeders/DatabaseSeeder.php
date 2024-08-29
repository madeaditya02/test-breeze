<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Place;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'test',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Test+User'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Made Aditya',
            'username' => 'mdadityaa',
            'email' => 'imadeaditya4@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Made+Aditya'
        ]);
        $user3 = User::factory()->create([
            'name' => 'Wahyu Pranata',
            'username' => 'wahyupranata',
            'email' => 'wahyupranata@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Wahyu+Pranata'
        ]);
        $user4 = User::factory()->create([
            'name' => 'Kadek Chandra',
            'username' => 'kdkchandra',
            'email' => 'kadekchandra@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Kadek+Chandra'
        ]);
        $user5 = User::factory()->create([
            'name' => 'Bisma Yoga',
            'username' => 'ygbismaa',
            'email' => 'bismayoga@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Bisma+Yoga'
        ]);
        $user3->following()->attach($user2);
        $user4->following()->attach($user3);
        $id1 = Str::random(6);
        $plan1 = Plan::create([
            // 'id' => $id1,
            'name' => 'Trip to Bali',
            'start_date' => now(),
            'end_date' => now()->add(3, 'days'),
            'public_id' => (string) Str::uuid()
        ]);
        $plan1->users()->attach($user2->id, ['accepted_at' => now(), 'role' => 'Owner']);
        $place1 = Place::create([
            'id' => "ChIJwRIJzsFB0i0RQdXwd3GvJvA",
            'name' => "Sanur",
            'address' => "Sanur, Bali, Indonesia",
            'types' => json_encode(["natural_feature", "establishment"]),
            "latitude" => -8.7071782,
            "longitude" => 115.26262360000001,
            "rating" => 4.5,
            "url" => "https://maps.google.com/?cid=17304711520096146753",
            "summary" => "Colorful fishing boats dot beaches of this resort town with galleries, restaurants & an old temple",
            "photo" => "places/ChIJwRIJzsFB0i0RQdXwd3GvJvA/photos/AelY_CtepczqVkRoDw8RO-fWd7rwH10KrjAagClRivVdqe8Z8eHcfPax48IET0mHk6xL3wseCTlRUY6h9gYycgTQudaQdcU1X3S2b2ygBhvhicTYrB4Jh1Ft1WrvzvzI7VMsI9Vz0W4snkW9V9Gcf5viJSIk61jBXUhljznX",
        ]);
        $place2 = Place::create([
            'id' => "ChIJJ_QeCxRF0i0RPuU1Y3d-RuI",
            'name' => "Balangan Beach",
            'address' => "Balangan Beach, South Kuta, Badung Regency, Bali, Indonesia",
            'types' => json_encode(["natural_feature", "establishment"]),
            "latitude" => -8.7920477999999989,
            "longitude" => 115.12341719999999,
            "rating" => 4.6,
            "url" => "https://maps.google.com/?cid=16304858552172143934",
            "summary" => "Low-key, white-sand beach popular with surfers & sunset viewers, with a few eateries nearby",
            "photo" => "places/ChIJJ_QeCxRF0i0RPuU1Y3d-RuI/photos/AelY_CsJGBvQjjmHyajZLaKDMPyXqAyOaLmHPDmcZTftX21LgHs9qIpf7qBEABqaoDA1byc2Jp2-APCAZQfVYXZ77HBLexyq8243o-RmTU_cz-7ZfBOF18a7n8P4N2rqviPdhN-5ItGdHr2eyaY0JB_Ry7jvcM4Es8RhkMfz",
        ]);
        $plan1->activities()->createMany([[
            'place_id' => $place1->id,
            'time' => now()->add(3, 'hours')
        ], [
            'place_id' => $place2->id,
            'time' => now()->add(8, 'hours')
        ]]);
    }
}