<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+96103255199',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'John',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'host',
                'phone' => '+96176005005',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Sarah',
                'email' => 'sarah@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'host',
                'phone' => '+96171453786',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Mike Traveler',
                'email' => 'mike.traveler@example.com',
                'password' => Hash::make('password'),
                'role' => 'traveler',
                'phone' => '+96178999654',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Emma',
                'email' => 'emma@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'traveler',
                'phone' => '+96170615345',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'David',
                'email' => 'david@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'traveler',
                'phone' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
