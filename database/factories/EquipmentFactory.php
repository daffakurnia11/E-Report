<?php

namespace Database\Factories;

use App\Models\EquipmentGas;
use App\Models\EquipmentProcess;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeList = ['Electric', 'Gas'];

        static $type_array = 0;
        static $id = 1;

        if ($type_array == 0) {
            $type_array++;
            $gas_id = mt_rand(1, 7);
            $flowmeter = fake()->numberBetween(1, 50);

            $electric_id = null;
            $volt = null;
            $ampere = null;
        } elseif ($type_array == 1) {
            $type_array = 0;
            $gas_id = null;
            $flowmeter = null;

            $electric_id = mt_rand(1, 5);
            $volt = fake()->numberBetween(1, 200);
            $ampere = fake()->numberBetween(1, 50);
        }

        $block_id = mt_rand(1, 10);
        $stopped_at = fake()->dateTimeInInterval(Carbon::now(), '+1 year');

        $equipment = [
            'user_id'               => 7,
            'block_id'              => $block_id,
            'type'                  => $typeList[$type_array],
            'equipment_gas_id'      => $gas_id,
            'equipment_electric_id' => $electric_id,
            'flowmeter'             => $flowmeter,
            'volt'                  => $volt,
            'ampere'                => $ampere,
            'activity'              => fake()->word(),
            'status'                => 'Preparation',
            'stopped_at'            => $stopped_at
        ];

        $start = Carbon::now();
        $duration = $start->diffInSeconds($stopped_at);

        $equipment_gas = EquipmentGas::firstWhere('id', $gas_id);

        if ($typeList[$type_array] == 'Gas') {
            $duration = $duration / 60; // Seconds to Minutes
            $flowmeter = $flowmeter;
            $density = $equipment_gas->density;
            $liter = ($duration * $flowmeter) / 1000;
            $gas_usage = $liter * $density;

            $period = null;
            $kWh = null;
        } else {
            $duration = $duration / 3600; // Seconds to Hours
            $kiloWatt = ($volt * $ampere * (0.5 ** (1 / 3))) / 1000;
            $kWh = $duration * $kiloWatt;
            $period = 'LWBP';

            $gas_usage = null;
        }

        EquipmentProcess::create([
            'block_id'      => $block_id,
            'equipment_id'  => $id++,
            'equipment_type' => $typeList[$type_array],
            'gas_usage'     => $gas_usage,
            'period'        => $period,
            'kWh'           => $kWh,
        ]);

        return $equipment;
    }
}
