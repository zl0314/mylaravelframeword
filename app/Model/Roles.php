<?php

namespace App\Model;

use App\Zl\Model\MyModel;
use Illuminate\Database\Eloquent\Model;

class Roles extends MyModel
{
    public function users ()
    {
        return $this->belongsToMany( 'App\Model\AdminUsers' );
    }

    public function permissions ()
    {
        return $this->belongsToMany( 'App\Model\Permissions', 'permission_role', 'role_id', 'permission_id' );
    }
}
