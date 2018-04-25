<?php

namespace App\Model;

use App\Zl\Model\MyModel;
use App\Model\AdminUserRole;

class AdminProfile extends MyModel
{
    protected $table = 'admins_profile';

    //保存管理员个人信息
    public static function saveProfile ( $adminUser )
    {
        $adminProfile = AdminProfile::firstOrNew( [
            'admin_users_id' => $adminUser->id,
        ] );
        $adminProfile->realname = request()->input( 'profile.realname' );
        $adminProfile->save();
    }

    //保存管理员的角色信息
    public static function saveRole ( $adminUser )
    {
        $roles = request()->input( 'role' );
        $adminUser->roles()->sync( $roles );
    }
}
