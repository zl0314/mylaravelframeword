<?php

namespace App\Model\Admin;

use App\Zl\Model\MyModel;
use Illuminate\Database\Eloquent\Model;

class Roles extends MyModel
{
    public function users ()
    {
        return $this->belongsToMany( 'App\Model\Admin\AdminUsers' );
    }

    public function permissions ()
    {
        return $this->belongsToMany( 'App\Model\Admin\Permissions', 'permission_role', 'role_id', 'permission_id' )->orderBy( 'sort', 'desc' );
    }
}
