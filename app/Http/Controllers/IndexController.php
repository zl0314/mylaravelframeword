<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/4/19 15:50
 * FileName : IndexController.php
 */

namespace App\Http\Controllers;


use App\Model\AdminUsers;
use App\Zl\Controllers\FrontController;

class IndexController extends FrontController
{

    public function index ()
    {
        //查询管理员所在的角色， 获取所拥有角色的所有权限

        $admin = AdminUsers::findOrFail( 2 );
        echo $admin->username . '的角色有：';
        foreach ( $admin->roles as $r ) {
            echo $r->display_name . '， 的权限<br>';
            foreach ( $r->permissions as $permission ) {
                echo $permission->display_name . ' , ';
            }
            echo '<br><br>';
        }

        return $this->display();
    }
}