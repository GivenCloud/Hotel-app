<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Type::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
