<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $status = 'Preparation';

        return [
            // 'user_id'       => mt_rand(7, 10),
            'project_id'    => mt_rand(1, 9),
            'block_name'    => $blockName,
            'block_weight'  => mt_rand(100, 500),
            'filename'      => null,
            'build_start'   => fake()->dateTimeInInterval(Carbon::now(), '-1 year'),
            'build_ended'   => fake()->dateTimeInInterval(Carbon::now(), '-1 year'),
            'status'        => $status
        ];
    }
}
