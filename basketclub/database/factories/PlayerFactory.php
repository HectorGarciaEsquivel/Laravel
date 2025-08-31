<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define array gender
     *
     */
    protected $gender = ["famale", "male", "other"];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => $this->gender[fake()->numberBetween(int1: 0, int2: 2)],
            'date_birth' => fake()->dateTimeBetween(startDate: '-50 years', endDate: '-6 years') -> format(format: 'Y_m_d')
        ];
    }
}
