<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            UsersSeeder::class,
           Amenities::class,
           PropertiesSeeder::class,
           RoomsSeeder::class,
           RoomAmenitiesSeeder::class,
           BookingsSeeder::class,
           PaymentsSeeder::class,
           AvailabilitySeeder::class,
           ReviewsSeeder::class,
           HostsSeeder::class, // Add HostsSeeder to the seeder call
           FavoritesSeeder::class, // Add FavoritesSeeder to the seeder call
        ]);
    }
}
