<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define array category
     *
     */
    protected $category = ["prebenjamines", "benjamines", "alevines", "infantiles", "cadete", "junior", "senior"];

    /**
     * Define array gender
     *
     */
    protected $gender = ["famale", "male", "mixed"];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()-> name(),
            'category' => $this->category[fake()->numberBetween(int1: 0, int2: 6)],
            'gender' => $this->gender[fake()->numberBetween(int1: 0, int2: 2)]
        ];
    }
}
