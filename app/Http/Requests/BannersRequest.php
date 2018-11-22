<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;

class BannersRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        return [
            'title'    => 'required',
            'position' => 'required|alpha_dash',
        ];
    }

    public function messages ()
    {
        return [
            'title.required'      => '标题不能为空',
            'position.required' => '自定义位置不能为空',
            'position.alpha_dash' => '自定义位格式：字母、数字、破折号（ - ）以及下划线（ _ ）',
        ];
    }
}
