<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Room::truncate();
        

        for ($i = 1; $i <= 20; $i++) {
            $type = Type::inRandomOrder()->first();
            $hotel = Hotel::inRandomOrder()->first();
            Room::create(
                ['number' => $i,
                'type_id' => $type->id,
                'hotel_id' => $hotel->id]
            );
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
