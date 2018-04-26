<?php

namespace App\Http\Controllers\Admin;

use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;
use App\Model\Permissions;

class BatchController extends BackController
{
    public function delete ( $model )
    {
        $ids = request()->post( 'ids' );
        $permission = array_column( Permissions::getALLMenus(), 'name' );
        if ( !in_array( $model . '.batch_destroy', $permission ) ) {
            return \Ajax::fail( '对不起，您没有权限执行此操作' );
        } else {
            if ( !empty( $ids ) ) {
                $model = '\App\Model\\' . ucfirst( $model );
                $obj = new $model;
                foreach ( $ids as $k => $r ) {
                    $obj->where( [ 'id' => $r ] )->delete();
                }

                return \Ajax::success( '删除成功' );
            } else {
                return \Ajax::fail( '参数错误' );
            }
        }

    }
}
