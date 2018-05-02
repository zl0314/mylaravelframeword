<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/5/2 15:06
 * FileName : JqBatchUploadServiceProvider.php
 */

namespace Jq\BatchUpload;


use Illuminate\Support\ServiceProvider;

class JqBatchUploadServiceProvider extends ServiceProvider
{
    public function boot ()
    {
        //视图
        $viewPath = realpath( __DIR__ . '/../resource/views' );

        $this->loadViewsFrom( $viewPath, 'BatchUpload' );
        $this->publishes( [
            $viewPath => resource_path() . '/vendor/jq-batch-upload',
        ], 'view' );

        //资源文件
        $assetPath = realpath( __DIR__ . '/../resource/public' );
        $this->publishes( [
            $assetPath => public_path() . '/jq-batch-upload',
        ], 'public' );


        $router = app( 'router' );
        $config['namespace'] = __NAMESPACE__;
        //定义路由
        $router->group( $config, function ( $router ) {
            $router->any( '/jq-batch-upload/upload', 'UploadController@upload' );
            $router->any( '/jq-batch-upload/delete', 'UploadController@delete' );
        } );

    }

    public function register ()
    {
        $configPath = realpath( __DIR__ . '/../config/jq-batch-upload.php' );
        $this->mergeConfigFrom( $configPath, 'BatchUpload' );
        $this->publishes( [ $configPath => config_path( 'jq-batch-upload.php' ) ], 'config' );
    }
}