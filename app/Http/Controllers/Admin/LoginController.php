<?php

namespace App\Http\Controllers\Admin;


use App\Model\Admins;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends BackController
{
    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {
        if ( Auth::guard( 'admin' )->check() ) {
            return redirect( '/admin/info' );
        }

        return $this->display();
    }

    /**
     * 登录确认页面
     */
    public function dologin ( Request $request )
    {
        $userCaptcha = $request->input( 'captcha' );
        $sessionCaptcha = Session( 'captcha' );
        if ( $userCaptcha && strtolower( $userCaptcha ) == strtolower( $sessionCaptcha ) ) {
            $status = Auth::guard( 'admin' )->attempt( [
                'username' => $request->input( 'username' ),
                'password' => $request->input( 'password' ),
            ] );
            if ( $status ) {
                $authpwd = md5( time() );
                Session( [ 'authpwd' => $authpwd ] );
                Admins::where( [ 'id' => Auth::guard( 'admin' )->id() ] )->update( [ 'authpwd' => $authpwd ] );

                return redirect( '/admin/info' );
            } else {
                return redirect( '/admin/login' )->with( 'msg', '登录失败，请重试' );
            }
        } else {
            Session::flash( 'msg', '验证码输入错误' );

            return $this->display();
        }
    }


}
