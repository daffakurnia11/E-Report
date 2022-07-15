<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentGas>
 */
class EquipmentGasFactory extends Factory
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
            'gas_filter'    => fake()->word(),
            'flowmeter'     => fake()->randomDigitNotNull(),
            'capacity'      => fake()->numerify(),
            'unit'          => fake()->randomLetter(),
            'quantity'      => mt_rand(1, 5),
        ];
    }
}
