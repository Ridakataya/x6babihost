<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomAmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_amenities')->truncate();
        DB::table('room_amenities')->insert([
            // Master Suite (Room 1) amenities
            ['room_id' => 1, 'amenity_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // WiFi
            ['room_id' => 1, 'amenity_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Air Conditioning
            ['room_id' => 1, 'amenity_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Television
            ['room_id' => 1, 'amenity_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Kitchen

            // Standard Room (Room 2) amenities
            ['room_id' => 2, 'amenity_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // WiFi
            ['room_id' => 2, 'amenity_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Air Conditioning
            ['room_id' => 2, 'amenity_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Television

            // Ocean View Suite (Room 3) amenities
            ['room_id' => 3, 'amenity_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // WiFi
            ['room_id' => 3, 'amenity_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Air Conditioning
            ['room_id' => 3, 'amenity_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Television
            ['room_id' => 3, 'amenity_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Kitchen
            ['room_id' => 3, 'amenity_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Pool
            ['room_id' => 3, 'amenity_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Balcony

            // Beach Room (Room 4) amenities
            ['room_id' => 4, 'amenity_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // WiFi
            ['room_id' => 4, 'amenity_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Air Conditioning
            ['room_id' => 4, 'amenity_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Pool

            // Mountain Cabin Room (Room 5) amenities
            ['room_id' => 5, 'amenity_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // WiFi
            ['room_id' => 5, 'amenity_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Television
            ['room_id' => 5, 'amenity_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Kitchen
            ['room_id' => 5, 'amenity_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Parking
            ['room_id' => 5, 'amenity_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Pet Friendly

            // Historic Loft (Room 6) amenities
            ['room_id' => 6, 'amenity_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // WiFi
            ['room_id' => 6, 'amenity_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Air Conditioning
            ['room_id' => 6, 'amenity_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Television
            ['room_id' => 6, 'amenity_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Gym
            ['room_id' => 6, 'amenity_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Washing Machine
        ]);
    }
}