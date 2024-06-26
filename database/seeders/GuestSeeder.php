<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Guest::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        function randomDate($startDate, $endDate) {
            $startTimestamp = strtotime($startDate);
            $endTimestamp = strtotime($endDate);
            $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
            return date('Y-m-d H:i:s', $randomTimestamp);
        }

        for ($i = 0; $i < 20; $i++) {
            $date = randomDate('2024-01-01', '2024-06-25');
            Guest::create(
                ['name' => 'Guest ' . $i,
                'lastName' => 'Lastname ' . $i,
                'dniPassport' => 'DNI ' . $i,
                'email' => 'guest' . $i . '@gmail.com',
                'phone' => random_int(900000000, 999999999),
                'checkInDate' => $date,
                'checkOutDate' => randomDate($date, '2024-06-26')]
            );
        }
    }
}
