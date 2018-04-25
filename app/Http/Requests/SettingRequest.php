<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends CommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        return [
            'intro' => 'required',
            'key'   => 'required|regex:/^[a-zA-z]{1,}$/',
            'value' => 'required',
        ];
    }

    public function messages ()
    {
        return [
            'intro.required' => '说明不能为空',
            'key.required'   => '关键字不能为空',
            'key.regex'      => '关键字只能为字母',
            'value.required' => '值不能为空',
        ];
    }
}
