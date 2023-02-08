<?php

namespace App\Http\Requests;

use App\Contracts\ProjectContract;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            ProjectContract::FIELD_NAME => [
                'required',
                'string',
                'unique:projects,name,NULL,id,deleted_at,NULL'
            ],
            ProjectContract::FIELD_IMAGE => [
                'nullable',
                'image'
            ],
        ];

        if ($this->method() === 'PUT') {
            $rules = [
                ProjectContract::FIELD_NAME => [
                    'required',
                    'string',
                    'unique:projects,name,' . $this->route('project')->id .',id,deleted_at,NULL'
                ],
            ];
        }

        return $rules;
    }
}
