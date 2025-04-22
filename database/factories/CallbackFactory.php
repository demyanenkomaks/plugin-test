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
            'name' => $this->faker->name(), // Имя пользователя
            'phone' => $this->faker->optional()->phoneNumber, // Телефон (необязательное поле)
            'email' => $this->faker->optional()->email, // Почта (необязательное поле)
            'date' => $this->faker->optional()->date, // Дата (необязательное поле)
            'time' => $this->faker->optional()->time, // Время (необязательное поле)
            'datetime' => $this->faker->optional()->dateTime, // Дата и время (необязательное поле)
            'list' => [ // Список дат (необязательное поле)
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
