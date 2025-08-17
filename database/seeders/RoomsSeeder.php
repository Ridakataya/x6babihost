<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'property_id' => 1,
                'room_type' => 'Master Suite',
                'description' => 'Spacious master bedroom with king-size bed and private bathroom.',
                'capacity' => 2,
                'price' => 150.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'property_id' => 1,
                'room_type' => 'Standard Room',
                'description' => 'Comfortable room with queen bed and city view.',
                'capacity' => 2,
                'price' => 120.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'property_id' => 2,
                'room_type' => 'Ocean View Suite',
                'description' => 'Luxurious suite with panoramic ocean views and private balcony.',
                'capacity' => 4,
                'price' => 200.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'property_id' => 2,
                'room_type' => 'Beach Room',
                'description' => 'Cozy room steps away from the beach with twin beds.',
                'capacity' => 2,
                'price' => 90.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'property_id' => 3,
                'room_type' => 'Mountain Cabin Room',
                'description' => 'Rustic room with mountain views and fireplace.',
                'capacity' => 3,
                'price' => 110.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'property_id' => 4,
                'room_type' => 'Historic Loft',
                'description' => 'Stylish loft with exposed brick walls and modern amenities.',
                'capacity' => 2,
                'price' => 140.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
