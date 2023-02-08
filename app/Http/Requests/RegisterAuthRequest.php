<?php

namespace App\Http\Requests;

use App\Contracts\UserContract;
use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            UserContract::FIELD_EMAIL =>
                'required|string|email|max:100|unique:users,email,NULL,id,deleted_at,NULL',
            UserContract::FIELD_PASSWORD =>
                'required|string|min:4',
            UserContract::FIELD_FIRST_NAME =>
                'required|string|between:2,100',
            UserContract::FIELD_LAST_NAME =>
                'required|string|between:2,100',
        ];
    }
}
