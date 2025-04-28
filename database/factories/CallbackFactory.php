<?php

namespace Database\Factories;

use App\Models\Callback;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Callback>
 */
class CallbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->optional()->phoneNumber,
            'email' => fake()->optional()->email,
            'date' => fake()->optional()->date,
            'time' => fake()->optional()->time,
            'datetime' => fake()->optional()->dateTime,
            'list' => [
                [
                    'date' => fake()->date,
                    'time' => fake()->time,
                    'datetime' => fake()->dateTime,
                ],
                [
                    'date' => fake()->date,
                    'time' => fake()->time,
                    'datetime' => fake()->dateTime,
                ],
            ],
        ];
    }
}
