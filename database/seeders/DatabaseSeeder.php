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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Made Aditya',
            'email' => 'imadeaditya4@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'Made Aditya 2',
            'email' => 'madeadityaclone02@gmail.com',
        ]);
        $plan1 = Plan::create([
            'id' => Str::random(6),
            'name' => 'Trip to Bali'
        ]);
        $plan2 = Plan::create([
            'id' => Str::random(6),
            'name' => 'Trip to Raja Ampat'
        ]);
        $plan1->activities()->createMany([
            ['activity' => 'Ke Pantai Sanur'],
            ['activity' => 'Ke Pantai Jimbaran']
        ]);
        $plan2->activities()->createMany([
            ['activity' => 'Ke Raja Ampat'],
        ]);
    }
}
