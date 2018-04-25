<?php

namespace App\Providers;

use App\Services\AjaxResonse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class AjaxResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $responseFactory)
    {
        $this->app->singleton('AjaxResponseService', function () {
            return new \App\Services\AjaxResponse();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
