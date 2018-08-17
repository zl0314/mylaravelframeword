<?php

namespace App\Model\Admin;

use App\Zl\Model\MyModel;

class AdminUsers extends MyModel
{
    public function profile ()
    {
        return $this->hasOne( 'App\Model\Admin\AdminProfile' );
    }

    //自动设置密码字段
    public function setPasswordAttribute ( $value )
    {
        if ( !empty( $value ) ) {
            $this->attributes['password'] = bcrypt( $value );
        }
    }

    public function roles ()
    {
        return $this->belongsToMany( 'App\Model\Admin\Roles','admin_user_role','admin_user_id','role_id' );
    }
}
