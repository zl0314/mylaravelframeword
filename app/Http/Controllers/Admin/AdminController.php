<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminPost;
use App\Http\Requests\AdminProfile as AdminProfilePost;
use App\Model\AdminProfile;
use App\Http\Controllers\Controller;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends BackController
{

    public function info ()
    {
        $vars = [
            'dontNeedAdd' => true,
        ];
        $this->assign( $vars );

        return $this->display( null, 'admin.admin.index' );
    }

    public function index ()
    {
        $vars = [
            'dontNeedAdd' => true,
        ];
        $this->assign( $vars );

        return $this->display( null, 'admin.admin.index' );
    }

    /**
     * 修改密码表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function my ()
    {
        $admin_id = Auth::guard( 'admin' )->user()->id;
        $user = AdminProfile::where( 'admin_users_id', '=', $admin_id )->first();

        return $this->display( [
            'user'        => $user,
            'here'        => '个人资料',
            'dontNeedAdd' => true,
        ], 'admin.admin.my' );
    }


    public function updateInfo ( AdminProfilePost $request )
    {
        $model = new AdminProfile;
        //先查找有没有当前管理员的个人信息记录
        $admin_id = Auth::guard( 'admin' )->user()->id;
        $row = $model->where( 'admin_users_id', '=', 1 )->first();

        if ( !empty( $row->id ) ) {
            $data = [
                'realname' => $request['realname'],
            ];
            DB::table( 'admins_profile' )->where( [ 'admin_users_id' => $admin_id ] )->update( $data );
            $res = true;
        } else {
            $model->realname = $request['realname'];
            $model->admin_users_id = $admin_id;
            $res = $model->save();
        }

        if ( $res ) {
            flash()->success( '信息保存成功' );
        } else {
            flash()->error( '信息保存失败' );
        }

        return redirect( '/admin/my' );
    }

    public function chpassForm ()
    {
        return $this->display( [
            'here'        => '修改密码',
            'dontNeedAdd' => true,
        ], 'admin.admin.chpass' );
    }

    /**
     * 修改密码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword ( AdminPost $request )
    {
        $model = Auth::guard( 'admin' )->user();
        $model->password = bcrypt( $request->password );
        $model->save();

        flash()->success( '密码修改成功' )->overlay();

        return redirect( 'admin/chpass' );
    }


    /**管理员退出
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function quite ()
    {
        app( 'Zcache' )->forget( 'permisstions' . Auth::guard( 'admin' )->user()->id );

        Auth::guard( 'admin' )->logout();

        return redirect( '/admin/login' );
    }

}
