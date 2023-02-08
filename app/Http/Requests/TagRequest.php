<?php

namespace App\Http\Requests;

use App\Contracts\TagContract;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules()
    {
        return [
            TagContract::FIELD_NAME => [
                'required',
                'string',
                'unique:tags,name,NULL,id,deleted_at,NULL'
            ]
        ];
    }
}
