<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->truncate();
        DB::table('reviews')->insert([
            [
                'id' => 1,
                'traveler_id' => 6, // David Guest (for completed booking)
                'room_id' => 5, // Mountain Cabin Room
                'property_id' => 1, // Assuming this is the property ID for the Mountain Cabin
                'rating' => 5,
                'comment' => 'Amazing mountain views and very peaceful. The cabin was clean and well-equipped. Perfect for a nature getaway!',
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'id' => 2,
                'traveler_id' => 4, // Mike Traveler (past guest)
                'room_id' => 1, // Master Suite (from a previous stay)
                'property_id' => 2, // Assuming this is the property ID for the Master Suite
                'rating' => 4,
                'comment' => 'Great location in downtown, very spacious room. The only downside was some street noise at night.',
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'id' => 3,
                'traveler_id' => 5, // Emma Traveler (past guest)
                'room_id' => 3, // Ocean View Suite (from a previous stay)
                'property_id' => 3, // Assuming this is the property ID for the Ocean View Suite
                'rating' => 5,
                'comment' => 'Absolutely stunning ocean views! The suite was luxurious and the balcony was perfect for morning coffee. Will definitely book again.',
                'created_at' => Carbon::now()->subDays(45),
                'updated_at' => Carbon::now()->subDays(45),
            ],
            [
                'id' => 4,
                'traveler_id' => 4, // Mike Traveler (past guest)
                'room_id' => 6, // Historic Loft (from a previous stay)
                'property_id' => 4, // Assuming this is the property ID for the Historic Loft
                'rating' => 4,
                'comment' => 'Love the historic charm and exposed brick walls. The loft has character and is well-maintained. Great location near museums.',
                'created_at' => Carbon::now()->subDays(60),
                'updated_at' => Carbon::now()->subDays(60),
            ],
            [
                'id' => 5,
                'traveler_id' => 6, // David Guest (past guest)
                'room_id' => 2, // Standard Room (from a previous stay)
                'property_id' => 2, // Assuming this is the property ID for the Standard Room
                'rating' => 3,
                'comment' => 'Room was decent for the price. Clean and comfortable but nothing special. Good for a short business trip.',
                'created_at' => Carbon::now()->subDays(75),
                'updated_at' => Carbon::now()->subDays(75),
            ],
            [
                'id' => 6,
                'traveler_id' => 5, // Emma Traveler (past guest)
                'room_id' => 4, // Beach Room (from a previous stay)
                'property_id' => 4, // Assuming this is the property ID for the Beach Room
                'rating' => 5,
                'comment' => 'So close to the beach! You can literally walk out and be on the sand in seconds. Room was cozy and perfect for our beach vacation.',
                'created_at' => Carbon::now()->subDays(90),
                'updated_at' => Carbon::now()->subDays(90),
            ],
        ]);
    }
}
