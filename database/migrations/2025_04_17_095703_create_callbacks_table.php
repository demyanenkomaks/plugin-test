<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('callbacks', function (Blueprint $table): void {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('name', 255); // Обязательное поле
            $table->string('phone', 255)->nullable(); // Необязательное поле
            $table->string('email')->nullable(); // Необязательное поле
            $table->date('date')->nullable(); // Необязательное поле
            $table->time('time')->nullable(); // Необязательное поле
            $table->timestamp('datetime')->nullable(); // Необязательное поле
            $table->json('list')->nullable(); // Необязательное поле, массив данных
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callbacks');
    }
};
