<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GasEquipment>
 */
class GasEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $equipmentList = ['C2H2 25 Kg', 'CO2 25 Kg', 'LPG 25 Kg', 'LPG 50 Kg', 'O2 7 m3', 'O2 8000 m3', 'LPG 12 Kg'];

        static $i = 0;
        return [
            'name'  => $equipmentList[$i++]
        ];
    }
}
