<?php

namespace App\Http\Requests;

use App\Contracts\UserContract;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            UserContract::FIELD_FIRST_NAME => ['required', 'string'],
            UserContract::FIELD_LAST_NAME => ['nullable', 'string'],
            UserContract::FIELD_EMAIL => [
                'required',
                'email',
                'unique:users,email,NULL,id,deleted_at,NULL'
            ],
            UserContract::FIELD_PASSWORD => [
                'required',
                'min:5'
            ]
        ];

        if ($this->method() === 'PUT') {
            $rules = [
                UserContract::FIELD_FIRST_NAME => ['required', 'string'],
                UserContract::FIELD_LAST_NAME => ['nullable', 'string'],
                UserContract::FIELD_EMAIL => [
                    'required',
                    'email',
                    'unique:users,email,' . $this->route('user')->id .',id,deleted_at,NULL'
                ],
            ];
        }

        return $rules;
    }
}
