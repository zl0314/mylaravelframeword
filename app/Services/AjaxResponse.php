<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/12/14
 * Time: 10:09
 */

namespace App\Services;


class AjaxResponse
{
    protected static function Response ( $code, $message, $data = null )
    {
        $out = [
            'success' => $code,
            'message' => $message,
        ];
        if ( is_array( $message ) ) {
            $out['data'] = $message;
            $out['message'] = '';
        }
        //if ( !empty( $data ) ) {
            $out['data'] = $data;
        //}


        return response()->json( $out, 200 );
    }

    public static function success ( $message, $data = null, $code = 1 )
    {
        return self::Response( $code, $message, $data );
    }

    public static function fail ( $message, $data = null, $code = 0 )
    {
        return self::Response( $code, $message, $data );
    }

}