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

    /**
     * Get custom attributes for validator errors.
     */
    //    public function attributes()
    //    {
    //        return [
    //            'name' => 'Имя',
    //            'phone' => 'Номер телефона',
    //            'email' => 'E-mail',
    //            'date' => 'Дата',
    //            'time' => 'Время',
    //            'datetime' => 'Дата и время',
    //            'list' => 'Список',
    //            'list.*.date' => 'Дата',
    //            'list.*.time' => 'Время',
    //            'list.*.datetime' => 'Дата и время',
    //        ];
    //    }

    protected function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
