<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maksde\Support\Contracts\Validation\DateTimeValidate;
use Maksde\Support\Contracts\Validation\DateValidate;
use Maksde\Support\Contracts\Validation\EmailValidate;
use Maksde\Support\Contracts\Validation\PhoneInternationalValidate;
use Maksde\Support\Contracts\Validation\PhoneValidate;
use Maksde\Support\Contracts\Validation\TimeValidate;

class TestValidateController
{
    public function email(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => ['required', new EmailValidate],
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $validationException->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function phone(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'phone' => ['required', new PhoneValidate],
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $validationException->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function phoneInternational(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'phone' => ['required', new PhoneInternationalValidate],
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $validationException->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function date(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'date' => ['required', new DateValidate],
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $validationException->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function time(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'time' => ['required', new TimeValidate],
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $validationException->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function timestamp(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'datetime' => ['required', new DateTimeValidate],
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $validationException->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }
}
