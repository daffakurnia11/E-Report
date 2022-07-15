<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentElectric>
 */
class EquipmentElectricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'       => mt_rand(10, 16),
            'name'          => fake()->word(),
            'volt'          => fake()->numberBetween(17, 600),
            'ampere'        => fake()->numberBetween(20, 40),
            'watt'          => fake()->numberBetween(10, 100),
            'power_factor'  => fake()->numberBetween(0, 1),
            'quantity'      => fake()->numerify()
        ];
    }
}
