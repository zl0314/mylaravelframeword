<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/1/9
 * Time: 15:34
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;


use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('web/index/index', 'App\Http\ViewComposers\IndexComposer');
    }

    public function register()
    {

    }
}