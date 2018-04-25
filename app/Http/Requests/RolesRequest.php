<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends CommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        return [
            'name'         => 'required',
            'display_name' => 'required',
        ];
    }

    public function messages ()
    {
        return [
            'name.required'         => '名称不能为空',
            'display_name.required' => '显示名不能为空',
        ];
    }
}
