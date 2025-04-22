<?php

namespace Database\Seeders;

use App\Models\Callback;
use Illuminate\Database\Seeder;

class CallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание 10 записей с использованием фабрики
        Callback::factory()->count(10)->create();
    }
}
