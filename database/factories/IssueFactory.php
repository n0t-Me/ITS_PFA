<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $a = ['Open','Closed'];
        return [
          'title' => 'Title_'.Str::random(10),
          'status' => $a[array_rand($a)],
          'description' => 'Desc_'.Str::random(20),
          'severity' => random_int(1,10),
          'team_id' => 1,
          'owner_id' => 1,
        ];
    }
}
