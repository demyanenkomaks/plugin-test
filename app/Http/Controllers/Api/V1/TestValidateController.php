<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maksde\Support\Contracts\Validation\EmailValidate;

class TestValidateController
{
    public function email(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => ['required', new EmailValidate],
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $exception->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function phone(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'phone' => 'required|'.config('support.validate.format.phone'),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $exception->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function phoneInternational(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'phone' => 'required|'.config('support.validate.format.phone_international'),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $exception->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function date(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'date' => 'required|'.config('support.validate.format.date'),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $exception->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function time(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'time' => 'required|'.config('support.validate.format.time'),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $exception->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }

    public function timestamp(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'datetime' => 'required|'.config('support.validate.format.datetime'),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Ошибка при валидации формы',
                'errors' => $exception->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Валидация прошла успешно!',
        ]);
    }
}
