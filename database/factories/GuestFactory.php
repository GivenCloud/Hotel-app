<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Guest::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $checkInDate = $this->faker->dateTimeBetween('-3 years', '-10 days');
        return [
            'name' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'dniPassport' => $this->faker->randomNumber(8).$this->faker->toUpper($this->faker->randomLetter()),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'checkInDate' => $checkInDate,
            'checkOutDate' => $this->faker->dateTimeInInterval($checkInDate, '+' . $this->faker->numberBetween(1, 30) . ' days'),
        ];
    }
}
