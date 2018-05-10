<?php

namespace App\Http\Requests;

use App\Model\AdminUsers;
use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUsersRequest extends CommonRequest
{


    public function getRule ()
    {
        if ( !empty( $this->route( 'adminuser' ) ) ) {
            $adminuser = new AdminUsers();
            $adminuser = $adminuser->findOrFail( $this->route( 'adminuser' ) );
        }
        $rule = [];
        if ( !empty( $adminuser->id ) ) {
            $rule = [
                'password'              => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|required_with:password|min:6',
                'username'              => [
                    Rule::unique( 'admin_users' )->ignore( $adminuser->id ),
                ],
            ];
        } else {
            $rule = [
                'password'              => 'required|min:6',
                'password_confirmation' => 'required_with:password|required|min:6',
                'username'              => 'unique:admin_users,username',
            ];
        }
        $rule['profile.realname'] = 'required';

        return $rule;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        return $this->getRule();
    }

    public function messages ()
    {
        return [
            'username.required'              => '姓名不能为空',
            'username.unique'                => '唯一登录凭证不能重复',
            'password.required'              => '密码不能为空',
            'password.confirmed'             => '两次密码不一样',
            'password_confirmation.required' => '确认密码不能为空',
            'password_confirmation.min'      => '确认密码长度不能不能小于6位',
            'profile.realname.required'      => '真实姓名不能为空',
        ];
    }
}
