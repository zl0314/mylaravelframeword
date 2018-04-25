<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/4/24 19:38
 * FileName : CommonRequest.php
 */

namespace App\Zl\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommonRequest extends FormRequest
{
    public function authorize ()
    {
        if ( strpos( $this->route()->uri, 'admin' ) !== false ) {
            return Auth::guard( 'admin' )->check();
        } else {
            return true;
        }
    }
}