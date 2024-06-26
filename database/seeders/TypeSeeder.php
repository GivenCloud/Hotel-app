<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Type::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Type:: create( 
            ['name' => 'Single',
            'price' => 30]
        );
        
        Type:: create( 
            ['name' => 'Double',
            'price' => 50]
        );

        Type:: create( 
            ['name' => 'Triple',
            'price' => 70]
        );

        Type:: create( 
            ['name' => 'Queen',
            'price' => 110]
        );

        Type:: create( 
            ['name' => 'King',
            'price' => 130]
        );

        Type:: create( 
            ['name' => 'Studio',
            'price' => 190]
        );

        Type:: create( 
            ['name' => 'Master',
            'price' => 210]
        );

        Type:: create( 
            ['name' => 'President',
            'price' => 250]
        );
    }
}
