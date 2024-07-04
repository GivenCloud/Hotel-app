<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Room::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return [
            'number' => $this->faker->randomNumber(3, true),
            'type_id' => Type::factory()->create()->id,
            'hotel_id' => Hotel::factory()->create()->id,
        ];
    }
}
