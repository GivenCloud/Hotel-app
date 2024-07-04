<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'category_id' => Category::factory()->create()->id,
        ];
    }
}
