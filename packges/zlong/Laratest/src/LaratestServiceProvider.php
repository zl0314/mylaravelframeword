<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/12/20
 * Time: 15:06
 */

namespace Zlong\Laratest;


use Illuminate\Support\ServiceProvider;

class LaratestServiceProvider extends ServiceProvider
{

    public function boot ()
    {

        //加载视图
        $this->loadViewsFrom( __DIR__ . '/../views/', 'Laratest' );
        //发布
        $this->publishes([
            realpath(__DIR__ . '/../views/') => base_path('resources/views/vendor/laratest')
        ],'view');

        //加载语言包
        $this->loadTranslationsFrom(__DIR__ . '/../translations/','Laratest');


        //自定义一个路由
        $router = app( 'router' );
        $config = [];
        $config['namespace'] = __NAMESPACE__;
        $router->group( $config, function ( $router ) {
            $router->get( 'laratest', function () {
                echo 'Hello, laratest';
            } );
        } );


    }
}