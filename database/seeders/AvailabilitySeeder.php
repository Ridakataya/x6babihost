<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('availabilities')->truncate();
        DB::table('availabilities')->insert([
            // Room 1 - Master Suite
            [
                'room_id' => 1,
                'start_date' => '2024-08-17',
                'end_date' => '2024-09-14',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 1,
                'start_date' => '2024-09-15',
                'end_date' => '2024-09-20',
                'is_available' => false, // Booked
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 1,
                'start_date' => '2024-09-21',
                'end_date' => '2024-12-31',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Room 2 - Standard Room
            [
                'room_id' => 2,
                'start_date' => '2024-08-17',
                'end_date' => '2024-12-19',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 2,
                'start_date' => '2024-12-20',
                'end_date' => '2024-12-25',
                'is_available' => false, // Cancelled booking, but let's keep it unavailable
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 2,
                'start_date' => '2024-12-26',
                'end_date' => '2025-02-28',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Room 3 - Ocean View Suite
            [
                'room_id' => 3,
                'start_date' => '2024-08-17',
                'end_date' => '2024-09-30',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 3,
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-05',
                'is_available' => false, // Booked
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 3,
                'start_date' => '2024-10-06',
                'end_date' => '2025-02-28',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Room 4 - Beach Room
            [
                'room_id' => 4,
                'start_date' => '2024-08-17',
                'end_date' => '2025-02-28',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Room 5 - Mountain Cabin Room
            [
                'room_id' => 5,
                'start_date' => '2024-08-17',
                'end_date' => '2024-08-24',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 5,
                'start_date' => '2024-08-25',
                'end_date' => '2024-08-30',
                'is_available' => false, // Booked (completed)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 5,
                'start_date' => '2024-08-31',
                'end_date' => '2025-02-28',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Room 6 - Historic Loft
            [
                'room_id' => 6,
                'start_date' => '2024-08-17',
                'end_date' => '2024-11-09',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 6,
                'start_date' => '2024-11-10',
                'end_date' => '2024-11-15',
                'is_available' => false, // Pending booking
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'room_id' => 6,
                'start_date' => '2024-11-16',
                'end_date' => '2025-02-28',
                'is_available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
