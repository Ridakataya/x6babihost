<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('favorites')->truncate();
        DB::table('favorites')->insert([
            [
                'id' => 1,
                'user_id' => 4, // Mike Traveler
                'property_id' => 1, // Luxury Downtown Apartment
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'id' => 2,
                'user_id' => 4, // Mike Traveler
                'property_id' => 3, // Modern Mountain Cabin
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'id' => 3,
                'user_id' => 5, // Emma Traveler
                'property_id' => 2, // Cozy Beach House
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'id' => 4,
                'user_id' => 5, // Emma Traveler
                'property_id' => 4, // Historic City Loft
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'id' => 5,
                'user_id' => 6, // David Guest
                'property_id' => 1, // Luxury Downtown Apartment
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'id' => 6,
                'user_id' => 6, // David Guest
                'property_id' => 2, // Cozy Beach House
                'created_at' => Carbon::now()->subDays(12),
                'updated_at' => Carbon::now()->subDays(12),
            ],
        ]);
    }
}
