<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Maksde\Support\Contracts\Validation\EmailValidate;

class CallbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', config('support.validate.format.phone')],
            'email' => ['nullable', new EmailValidate],
            'date' => ['nullable', config('support.validate.format.date')],
            'time' => ['nullable', config('support.validate.format.time')],
            'datetime' => ['nullable', config('support.validate.format.datetime')],
            'list' => ['nullable', 'array'],
            'list.*.date' => ['nullable', config('support.validate.format.date')],
            'list.*.time' => ['nullable', config('support.validate.format.time')],
            'list.*.datetime' => ['nullable', config('support.validate.format.datetime')],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Обязательно к заполнению.',
            '*.max' => 'Не должно превышать 255 символов.',
            '*.date_format' => 'Не верный формат.',
            '*.regex' => 'Не верный формат.',
            'email' => 'Не действительный.',
            'list.array' => 'Поле "Список дат" должно быть массивом.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
