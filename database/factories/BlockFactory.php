<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $blockName = 'Block ' . Str::upper(fake()->randomLetter);
        return [
            'user_id'       => mt_rand(7, 10),
            'project_id'    => mt_rand(1, 10),
            'block_name'    => $blockName,
            'block_weight'  => mt_rand(100, 500),
            'sequence'      => fake()->word(),
            'filename'      => null,
            'build_start'   => fake()->date(),
            'build_ended'   => fake()->date(),
            'status'        => 'Waiting for approval'
        ];
    }
}
