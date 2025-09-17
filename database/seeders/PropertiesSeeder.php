<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('properties')->truncate();
        DB::table('properties')->insert([
            [
                'id' => 1,
                'host_id' => 2, // John Host
                'title' => 'Luxury Downtown Apartment',
                'description' => 'A beautiful and spacious apartment located in the heart of downtown. Perfect for business travelers and tourists alike.',
                'address' => '123 Main Street',
                'city' => 'New York',
                'country' => 'United States',
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'verified' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'host_id' => 2, // John Host
                'title' => 'Cozy Beach House',
                'description' => 'A charming beach house with stunning ocean views. Perfect for a relaxing getaway.',
                'address' => '456 Ocean Drive',
                'city' => 'Miami',
                'country' => 'United States',
                'latitude' => 25.7617,
                'longitude' => -80.1918,
                'verified' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'host_id' => 3, // Sarah Host
                'title' => 'Modern Mountain Cabin',
                'description' => 'A contemporary cabin nestled in the mountains. Great for hiking enthusiasts and nature lovers.',
                'address' => '789 Mountain View Road',
                'city' => 'Denver',
                'country' => 'United States',
                'latitude' => 39.7392,
                'longitude' => -104.9903,
                'verified' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'host_id' => 3, // Sarah Host
                'title' => 'Historic City Loft',
                'description' => 'A beautifully renovated loft in a historic building. Walking distance to museums and restaurants.',
                'address' => '321 Historic Avenue',
                'city' => 'Boston',
                'country' => 'United States',
                'latitude' => 42.3601,
                'longitude' => -71.0589,
                'verified' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}