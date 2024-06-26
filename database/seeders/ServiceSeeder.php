<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Service::create(
            ['name' => 'Wi-Fi',
            'description' => 'Internet',
            'category_id' => 1]
        );

        Service::create(
            ['name' => 'TV',
            'description' => 'TV',
            'category_id' => 1]
        );

        Service::create(
            ['name' => 'Breakfast',
            'description' => 'Breakfast',
            'category_id' => 2]
        );

        Service::create(
            ['name' => 'Parking',
            'description' => 'Parking',
            'category_id' => 3]
        );

        Service::create(
            ['name' => 'Pool',
            'description' => 'Pool',
            'category_id' => 3]
        );

        Service::create(
            ['name' => 'Gym',
            'description' => 'Gym',
            'category_id' => 3]
        );
    }
}
