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
            'name' => $this->faker->name(),
            'phone' => $this->faker->optional()->phoneNumber,
            'email' => $this->faker->optional()->email,
            'date' => $this->faker->optional()->date,
            'time' => $this->faker->optional()->time,
            'datetime' => $this->faker->optional()->dateTime,
            'list' => [
                [
                    'date' => $this->faker->date,
                    'time' => $this->faker->time,
                    'datetime' => $this->faker->dateTime,
                ],
                [
                    'date' => $this->faker->date,
                    'time' => $this->faker->time,
                    'datetime' => $this->faker->dateTime,
                ],
            ],
        ];
    }
}
