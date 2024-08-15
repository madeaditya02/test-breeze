<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use App\Models\Activity;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
            'profile_picture' => 'https://ui-avatars.com/api/?name=Test+User'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Made Aditya',
            'email' => 'imadeaditya4@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Made+Aditya'
        ]);
        $user3 = User::factory()->create([
            'name' => 'Wahyu Pranata',
            'email' => 'wahyupranata@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Wahyu+Pranata'
        ]);
        $user4 = User::factory()->create([
            'name' => 'Kadek Chandra',
            'email' => 'kadekchandra@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Kadek+Chandra'
        ]);
        $user4 = User::factory()->create([
            'name' => 'Bisma Yoga',
            'email' => 'bismayoga@gmail.com',
            'profile_picture' => 'https://ui-avatars.com/api/?name=Bisma+Yoga'
        ]);
        $id1 = Str::random(6);
        $plan1 = Plan::create([
            'id' => $id1,
            'name' => 'Trip to Bali'
        ]);
        $plan1->users()->attach($user2->id, ['accepted_at' => now()]);
        // $plan1->users()->attach($user3->id);
        $plan2 = Plan::create([
            'id' => Str::random(6),
            'name' => 'Trip to Raja Ampat'
        ]);
        $plan1->activities()->createMany([
            ['activity' => 'Ke Pantai Sanur', 'time' => now()->addHours(2)->toDateTimeString()],
            ['activity' => 'Ke Pantai Jimbaran', 'time' => now()->addHours(2)->toDateTimeString()]
        ]);
        $plan2->activities()->createMany([
            ['activity' => 'Ke Raja Ampat', 'time' => now()->addHours(2)->toDateTimeString()],
        ]);
    }
}
