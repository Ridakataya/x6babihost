<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'id' => 1,
                'booking_id' => 1,
                'amount' => 750.00, // 5 nights * $150
                'payment_method' => 'credit_card',
                'payment_status' => 'completed',
                'paid_at' => Carbon::now()->subDays(9),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(9),
            ],
            [
                'id' => 2,
                'booking_id' => 2,
                'amount' => 800.00, // 4 nights * $200
                'payment_method' => 'paypal',
                'payment_status' => 'completed',
                'paid_at' => Carbon::now()->subDays(4),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'id' => 3,
                'booking_id' => 3,
                'amount' => 550.00, // 5 nights * $110
                'payment_method' => 'bank_transfer',
                'payment_status' => 'completed',
                'paid_at' => Carbon::now()->subDays(24),
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(24),
            ],
            [
                'id' => 4,
                'booking_id' => 4,
                'amount' => 700.00, // 5 nights * $140
                'payment_method' => 'credit_card',
                'payment_status' => 'pending',
                'paid_at' => null,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'id' => 5,
                'booking_id' => 5,
                'amount' => 600.00, // 5 nights * $120
                'payment_method' => 'credit_card',
                'payment_status' => 'failed',
                'paid_at' => null,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ]);
    }
}
