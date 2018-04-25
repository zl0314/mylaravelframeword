<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

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

        return $next( $request );
    }
}
