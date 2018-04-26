<?php

namespace App\Http\Middleware;

use App\Model\Permissions;
use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle ( $request, Closure $next )
    {

        if ( !Auth::guard( 'admin' )->check() ) {
            return redirect( '/admin/login' );
        }

        if ( Session( 'authpwd' ) != Auth::guard( 'admin' )->user()->authpwd ) {
            Auth::guard( 'admin' )->logout();

            return redirect( '/admin/login' );
        }
        if ( Auth::guard( 'admin' )->user()->is_super ) {
            return $next( $request );
        }
        $curRouteName = Route::currentRouteName();
        $previousUrl = URL::previous();

        if ( in_array( $curRouteName, [ 'admin.quit' ] ) ) {
            return $next( $request );
        } else {
            if ( strpos( $curRouteName, 'public' ) !== false ) {
                return $next( $request );
            }
            $permission = array_column( Permissions::getALLMenus(), 'name' );
            if ( !in_array( $curRouteName, $permission ) ) {
                if ( $request->ajax() ) {
                    return \Ajax::fail( '您没有权限执行此操作' );
                } else {
                    return response()->view( 'admin.errors.403', [ 'previousUrl' => $previousUrl ] );
                }
            }
        }


        return $next( $request );
    }
}
