<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Database\Seeders\ManyToMany\GuestServiceSeeder;
use Database\Seeders\ManyToMany\HotelServiceSeeder;
use Database\Seeders\ManyToMany\RoomGuestSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        //$this->call(HotelSeeder::class);
        Hotel::factory(20)->create(); 
        $this->call(TypeSeeder::class);
        $this->call(CategorySeeder::class);            
        $this->call(RoomSeeder::class);
        Guest::factory(20)->create();
        $this->call(ServiceSeeder::class);
        $this->call(RoomGuestSeeder::class);
        $this->call(GuestServiceSeeder::class);
        $this->call(HotelServiceSeeder::class);
    }
}
