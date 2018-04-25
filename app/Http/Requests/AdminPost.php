<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminPost extends CommonRequest
{
    //验证原密码是否正确
    public function validator_password ()
    {
        Validator::extend( 'check_password', function ( $attrubute, $value, $parameters, $validator ) {
            return Hash::check( $value, Auth::guard( 'admin' )->user()->password );
        } );
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        //验证密码
        $this->validator_password();

        //规则
        return [
            'original_password'     => 'sometimes|required|check_password',
            'password'              => 'sometimes|required|confirmed|min:8|max:15',
            'password_confirmation' => 'sometimes|required|',

        ];
    }

    /**
     * 中文提示
     * @return array
     */
    public function messages ()
    {
        return [
            'original_password.check_password' => '原密码不正确',
            'original_password.required'       => '原密码不能为空',
            'password.required'                => '密码不能为空',
            'password.confirmed'               => '两次密码不一样',
            'password_confirmation.required'   => '确认密码不能为空',
            'password.min'                     => '密码不能少于8位',
            'password.max'                     => '密码不能大于15位',
        ];
    }
}
