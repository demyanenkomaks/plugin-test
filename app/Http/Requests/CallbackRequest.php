<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Maksde\Support\Contracts\Validation\DateTimeValidate;
use Maksde\Support\Contracts\Validation\DateValidate;
use Maksde\Support\Contracts\Validation\EmailValidate;
use Maksde\Support\Contracts\Validation\NameValidate;
use Maksde\Support\Contracts\Validation\PhoneValidate;
use Maksde\Support\Contracts\Validation\TimeValidate;

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
            'name' => ['required', new NameValidate],
            'phone' => ['nullable', new PhoneValidate],
            'email' => ['nullable', new EmailValidate],
            'date' => ['nullable', new DateValidate],
            'time' => ['nullable', new TimeValidate],
            'datetime' => ['nullable', new DateTimeValidate],
            'list' => ['nullable', 'array'],
            'list.*.date' => ['nullable', new DateValidate],
            'list.*.time' => ['nullable', new TimeValidate],
            'list.*.datetime' => ['nullable', new DateTimeValidate],
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
