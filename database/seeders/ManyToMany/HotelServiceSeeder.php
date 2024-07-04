<?php
namespace Database\Seeders\ManyToMany;

use App\Models\ManyToMany\HotelService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        HotelService::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $combinations = [];
        for ($hotel_id = 1; $hotel_id <= 20; $hotel_id++) {
            for ($service_id = 1; $service_id <= 6; $service_id++) {
                $combinations[] = [
                    'hotel_id' => $hotel_id,
                    'service_id' => $service_id,
                ];
            }
        }

        // Barajar las combinaciones para insertarlas en orden aleatorio.
        shuffle($combinations);

        // Seleccionar las primeras 20 combinaciones únicas.
        $combinationsToInsert = array_slice($combinations, 0, 20);

        // Inserción en lote.
        HotelService::insert($combinationsToInsert);
    }
}