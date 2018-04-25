<?php

namespace App\Http\Controllers\Admin;

use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;

class BatchController extends BackController
{
    public function delete ( $model )
    {
        $ids = request()->post( 'ids' );
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
