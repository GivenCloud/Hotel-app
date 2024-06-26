<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(CategorySeeder::class);            
        $this->call(RoomSeeder::class);
        $this->call(GuestSeeder::class);
        $this->call(ServiceSeeder::class);
        //$this->call(GuestRoomSeeder::class);
        //$this->call(GuestServiceSeeder::class);
        //$this->call(HotelServiceSeeder::class);
    }
}
