<?php

use App\Http\Controllers\Api\V1\CallbackController;
use App\Http\Controllers\Api\V1\TestValidateController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('test-validate')->controller(TestValidateController::class)->group(function () {
        Route::post('email', 'email');
        Route::post('phone', 'phone');
        Route::post('phone-international', 'phoneInternational');
        Route::post('date', 'date');
        Route::post('time', 'time');
        Route::post('datetime', 'timestamp');
    });

    Route::post('callback', CallbackController::class);
});
