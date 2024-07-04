<?php

namespace Database\Seeders\ManyToMany;

use App\Models\ManyToMany\GuestService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        GuestService::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $combinations = [];
        for ($guest_id = 1; $guest_id <= 20; $guest_id++) {
            for ($service_id = 1; $service_id <= 6; $service_id++) {
                $combinations[] = [
                    'guest_id' => $guest_id,
                    'service_id' => $service_id,
                ];
            }
        }

        // Barajar las combinaciones para insertarlas en orden aleatorio.
        shuffle($combinations);

        // Seleccionar las primeras 20 combinaciones únicas.
        $combinationsToInsert = array_slice($combinations, 0, 20);

        // Inserción en lote.
        GuestService::insert($combinationsToInsert);
    }
}