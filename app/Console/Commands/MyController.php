<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyController extends Command
{
    /**
     * The name and signature of the console command.
     * 创建自定义的控制器
     * {name}  控制器名称  自动加 Controller 后缀
     * -h 后台控制器指定的当前位置名称
     * -m 创建模型
     * -r 创建Request
     * @var string
     */
    protected $signature = 'make:my_controller {name} {--h=?} {--m=true} {--r=true}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Command description';

    public $controllerName;

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle ()
    {
        $controllerName = $this->argument( 'name' );
        $isAdmin = false;
        $here = $this->option( 'h' );
        $isMakeModel = $this->option( 'm' );
        $isMakeRequest = $this->option( 'r' );
        if ( strpos( strtolower( $controllerName ), 'admin' ) !== false ) {
            $isAdmin = true;
        }
        $controllerName = str_replace( 'Admin/', '', $controllerName );
        $this->controllerName = ucfirst( $controllerName );
        //写入控制器内容
        $this->setControllerContent();

        if ( $isAdmin && $isMakeModel ) {
            //写入模型
            $this->setModelContent();
        }
        if ( $isAdmin && $isMakeRequest ) {
            //写入Request
            $this->setRequestContent();
        }
        echo 'controller ' . $this->controllerName  . ' created success!';

    }

    /**
     * 写入控制器内容
     *
     * @param $isAdmin
     */
    protected function setControllerContent ()
    {
        //后台管理控制器
        $controllerPathBack = app_path() . '/Http/Controllers/Admin/' . $this->controllerName . 'Controller.php';
        //前台控制器
        $controllerPathFront = app_path() . '/Http/Controllers/' . $this->controllerName . 'Controller.php';

        //前台控制器内容
        $contentFront = file_get_contents( dirname( __FILE__ ) . '/frontController' );
        //后台控制器内容
        $contentBack = file_get_contents( dirname( __FILE__ ) . '/backController' );

        $contentFront = $this->replaceContent( $contentFront );
        $contentBack = $this->replaceContent( $contentBack );

        //写入前台控制器
        file_put_contents( $controllerPathFront, $contentFront );
        //写入后台控制器
        file_put_contents( $controllerPathBack, $contentBack );
    }

    /**
     * 写入模型内容
     *
     * @param $isAdmin
     */
    protected function setModelContent ()
    {
        $modelCommonPath = app_path() . '/Model/Common/Common' . $this->controllerName . '.php';
        $modelBackPath = app_path() . '/Model/Admin/' . $this->controllerName . '.php';
        $modelFrontPath = app_path() . '/Model/Web/' . $this->controllerName . '.php';


        //前台控制器内容
        $contentFrontBack = file_get_contents( dirname( __FILE__ ) . '/model' );
        //后台控制器内容
        $contentCommon = file_get_contents( dirname( __FILE__ ) . '/commonModel' );

        $contentFrontBack = $this->replaceContent( $contentFrontBack );
        $contentCommon = $this->replaceContent( $contentCommon );

        //写入前台模型
        file_put_contents( $modelFrontPath, $contentFrontBack );
        //写入公共模型
        file_put_contents( $modelCommonPath, $contentCommon );
        //写入后台模型
        file_put_contents( $modelBackPath, $contentFrontBack );
    }

    /**
     * 写入 Request 内容
     *
     * @param $isAdmin
     */
    protected function setRequestContent ()
    {
        $content = file_get_contents( dirname( __FILE__ ) . '/request' );
        $filePath = app_path() . '/Http/Requests/' . $this->controllerName . 'Request.php';
        $content = $this->replaceContent( $content );

        file_put_contents( $filePath, $content );
    }

    /**
     *  替换内容
     *
     * @param $content 模板内容
     *
     * @return mixed
     */
    protected function replaceContent ( $content )
    {
        $content = str_replace( [
            '{controller}',
            '{here}',
        ], [
            $this->controllerName,
            iconv( 'gb2312', 'utf-8', $this->option( 'h' ) ),
        ], $content );

        return $content;
    }
}
