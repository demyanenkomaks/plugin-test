<?php

use App\Http\Controllers\Api\V1\CallbackController;
use App\Http\Controllers\Api\V1\TestValidateController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->middleware([ForceJsonResponse::class])->group(function () {
    Route::prefix('test-validate')->controller(TestValidateController::class)->group(function () {
        Route::post('email', 'email');
        Route::post('phone', 'phone');
        Route::post('phone-international', 'phoneInternational');
        Route::post('date', 'date');
        Route::post('time', 'time');
        Route::post('datetime', 'timestamp');
    });

    Route::prefix('callback')->controller(CallbackController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}','update');
        Route::delete('/{id}', 'destroy');
    });
});
