<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $id = 1;
        return [
            'user_id'           => mt_rand(4, 6),
            'code'              => 'Code' . $id++,
            'ship_name'         => 'Kapal ' . fake()->colorName(),
            'ship_owner'        => fake()->name(),
            'ship_size'         => 'Tongkang',
            'contract_start'    => Carbon::now(),
            'contract_ended'    => fake()->dateTimeInInterval(Carbon::now(), '+2 years'),
            'status'            => 'Preparation'
        ];
    }
}
