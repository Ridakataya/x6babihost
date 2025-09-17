<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('bookings')->truncate();
        DB::table('bookings')->insert([
            [
                'id' => 1,
                'traveler_id' => 4, // Mike Traveler
                'room_id' => 1, // Master Suite
                'check_in' => '2024-09-15',
                'check_out' => '2024-09-20',
                'total_price' => 750, // 5 nights at $150 per night
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(9),
            ],
            [
                'id' => 2,
                'traveler_id' => 5, // Emma Traveler
                'room_id' => 3, // Ocean View Suite
                'check_in' => '2024-10-01',
                'check_out' => '2024-10-05',
                'total_price' => 1000, // 4 nights at $250 per night
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'id' => 3,
                'traveler_id' => 6, // David Guest
                'room_id' => 5, // Mountain Cabin Room
                'check_in' => '2024-08-25',
                'check_out' => '2024-08-30',
                'total_price' => 550, // 5 nights at $110 per night
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'id' => 4,
                'traveler_id' => 4, // Mike Traveler
                'room_id' => 6, // Historic Loft
                'check_in' => '2024-11-10',
                'check_out' => '2024-11-15',
                'total_price' => 700, // 5 nights at $140 per night
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'id' => 5,
                'traveler_id' => 5, // Emma Traveler
                'room_id' => 2, // Standard Room
                'check_in' => '2024-12-20',
                'check_out' => '2024-12-25',
                'total_price' => 600, // 5 nights at $120 per night
                'status' => 'cancelled',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ]);
    }
}