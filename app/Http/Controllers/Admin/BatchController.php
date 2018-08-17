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

        if ( !empty( $ids ) ) {
            $model = app( 'rsa' )->privateDecrypt( request()->post( 'm' ) );
            $obj = new $model;

            foreach ( $ids as $k => $r ) {
                $result_model = $obj->findOrFail( $r );
                $obj->where( [ 'id' => $r ] )->delete();
                $contoller = app( 'rsa' )->privateDecrypt( request()->post( 'c' ) );
                $contoller_inst = new $contoller;
                if ( method_exists( $contoller_inst, 'deleteCallback' ) ) {
                    $contoller_inst->deleteCallback( $result_model );
                }
            }
            app( 'Zcache' )->clearAllCache();
            cache()->flush();


            return \Ajax::success( '删除成功' );
        } else {
            return \Ajax::fail( '参数错误' );
        }

    }
}
