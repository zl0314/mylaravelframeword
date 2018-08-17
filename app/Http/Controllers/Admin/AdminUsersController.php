<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUsersRequest;
use App\Model\Admin\AdminProfile;
use App\Model\Admin\AdminUsers;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;

class AdminUsersController extends BackController
{
    public $here = '管理员';
    public $model = AdminUsers::class;
    public $formRequest = AdminUsersRequest::class;

    public function getData ()
    {
        $data = $this->getRequest()->post();
        unset( $data['profile'] );
        unset( $data['role'] );
        unset( $data['password_confirmation'] );

        return $data;
    }

    public function saveCallback ( $model )
    {
        //保存管理员个人信息
        AdminProfile::saveProfile( $model );
        //保存管理员的角色信息
        AdminProfile::saveRole( $model );
    }

    //如果 是超级管理员，不能进行删除
    public function checkDelete ( $id )
    {
        $admin_user = AdminUsers::findOrFail( $id );
        if ( $admin_user->is_super ) {
            return false;
        }
    }
}
