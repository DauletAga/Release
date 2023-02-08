<?php

namespace App\Http\Requests;

use App\Contracts\ReleaseContract;
use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
{
    public function rules()
    {
        return [
            ReleaseContract::FIELD_NAME => [
                'required',
                'string',
            ],
            ReleaseContract::FIELD_TEXT => [
                'required',
                'string'
            ],
            ReleaseContract::FIELD_PROJECT_ID => [
                'required',
                'integer',
                'exists:projects,id,deleted_at,NULL'
            ],
            ReleaseContract::FIELD_DATE => [
                'nullable',
                'date'
            ],
        ];
    }
}
