<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminProfile extends CommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        return [
            'realname'    => 'required',
        ];
    }

    /**
     * 中文提示
     * @return array
     */
    public function messages ()
    {
        return [
            'realname.required' => '真实姓名不能为空',
        ];
    }
}
