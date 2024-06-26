<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Hotel::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 0; $i < 20; $i++) {
            Hotel::create(
                ['name' => "Hotel $i",
                'adress' => "Adress $i",
                'phone' => random_int(900000000, 999999999),
                'email' => Str::random(10).'@gmail.com',
                'website' => "Website $i.com",]
            );
        }
    }
}
