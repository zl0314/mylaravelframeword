<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RolesRequest;
use App\Model\Roles;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;

class RolesController extends BackController
{
    public $here = '角色';
    public $model = Roles::class;
    public $formRequest = RolesRequest::class;

    public function permission ( $id )
    {
        $role = Roles::findOrFail( $id );
        $vars = [
            'role'        => $role,
            'here'        => '权限设置 --【' . $role->display_name . '】',
            'dontNeedAdd' => true,
        ];
        $this->assign( $vars );

        return $this->display();
    }

    public function setPermisstion ( $id )
    {
        $permission = request()->input( 'permission' );
        $role = Roles::findOrFail( $id );

        if ( !empty( $permission ) ) {
            $role->permissions()->sync( $permission );

            flash()->success( '权限分配成功' );

            return redirect( url( 'admin/' . $this->siteClass ) );
        } else {
            flash()->success( '请选择权限' );

            return redirect( url( 'admin/role/permission/' . $role->id ) );
        }
    }
}
