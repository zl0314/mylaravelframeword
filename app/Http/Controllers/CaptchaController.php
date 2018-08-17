<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{

    /**
     * 获取验证码
     */
    public function code ( $random )
    {
        $builder = new CaptchaBuilder();
        $builder->setMaxAngle(0);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        $builder->setMaxOffset(0);
        $builder->build( 150, 32 );
        $phrase = $builder->getPhrase();
        session( [ 'captcha' => $phrase ] ); //存储验证码
        ob_clean(); //清除缓存

        return response( $builder->output() )->header( 'Content-type', 'image/jpeg' ); //把验证码数据以jpeg图片的格式输出
    }
}
