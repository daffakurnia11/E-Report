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

        static $user_id = 7;
        static $project_id = 1;

        if ($project_id == 11) {
            $project_id = 1;
            $user_id++;
        }

        if ($user_id == 7) {
            $status = 'Preparation';
        } else {
            $status = 'Waiting for approval';
        }

        return [
            'user_id'       => $user_id,
            'project_id'    => $project_id++,
            'block_name'    => $blockName,
            'block_weight'  => mt_rand(100, 500),
            'filename'      => null,
            'build_start'   => fake()->date(),
            'build_ended'   => fake()->date(),
            'status'        => $status
        ];
    }
}
