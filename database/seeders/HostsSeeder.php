<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hosts')->truncate();
        DB::table('hosts')->insert([
            [
                'id' => 1,
                'user_id' => 2, // John Host
                'document_url' => 'storage/verifications/john_host_id_2024.pdf',
                'status' => 'approved',
                'submitted_at' => Carbon::now()->subDays(30),
                'reviewed_at' => Carbon::now()->subDays(25),
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'id' => 2,
                'user_id' => 3, // Sarah Host
                'document_url' => 'storage/verifications/sarah_host_id_2024.pdf',
                'status' => 'approved',
                'submitted_at' => Carbon::now()->subDays(20),
                'reviewed_at' => Carbon::now()->subDays(15),
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'id' => 3,
                'user_id' => 2, // John Host (additional document)
                'document_url' => 'storage/verifications/john_host_business_license_2024.pdf',
                'status' => 'approved',
                'submitted_at' => Carbon::now()->subDays(10),
                'reviewed_at' => Carbon::now()->subDays(8),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'id' => 4,
                'user_id' => 3, // Sarah Host (property verification)
                'document_url' => 'storage/verifications/sarah_host_property_deed_2024.pdf',
                'status' => 'pending',
                'submitted_at' => Carbon::now()->subDays(3),
                'reviewed_at' => null,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
        ]);
    }
}
