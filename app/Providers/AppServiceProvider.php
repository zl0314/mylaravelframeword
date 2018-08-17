<?php

namespace App\Providers;

use App\Http\Services\Rsa;
use App\Zl\Cache\CacheDisable;
use App\Zl\Cache\CacheEnable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot ()
    {

        //Schema::defaultStringLength( 191 );

        //登录，修改密码等敏感信息， 用RSA加密
        $this->app->singleton( 'rsa', function () {
            return new Rsa();
        } );

        //缓存开关
        $this->app->singleton( 'Zcache', function () {
            if ( config( 'cache.enable' ) ) {
                return new CacheEnable();
            } else {
                return new CacheDisable();
            }
        } );
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register ()
    {
        //
    }
}
