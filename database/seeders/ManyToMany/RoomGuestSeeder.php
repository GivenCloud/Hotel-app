<?php

namespace Database\Seeders\ManyToMany;

use App\Models\ManyToMany\RoomGuest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        RoomGuest::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $combinations = [];
        for ($room_id = 1; $room_id <= 20; $room_id++) {
            for ($guest_id = 1; $guest_id <= 20; $guest_id++) {
                $combinations[] = [
                    'room_id' => $room_id,
                    'guest_id' => $guest_id,
                ];
            }
        }

        // Barajar las combinaciones para insertarlas en orden aleatorio.
        shuffle($combinations);

        // Seleccionar las primeras 20 combinaciones únicas.
        $combinationsToInsert = array_slice($combinations, 0, 20);

        // Inserción en lote.
        RoomGuest::insert($combinationsToInsert);
    }
}