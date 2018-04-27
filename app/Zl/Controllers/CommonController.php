<?php

namespace App\Zl\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class CommonController extends Controller
{
    /**
     * 站点控制器
     * @var
     */
    public $siteClass;

    /**
     * 站点方法（控制器内的就去）
     * @var
     */
    public $siteMethod;

    /**
     * 主键
     * */
    public $id;

    /**
     * 给模板要赋予的值
     * @var null
     */
    public $viewData = null;

    /**
     * 是否是管理后台
     * @var bool
     */
    public $isManager = false;

    /**
     * 是否手机端
     * CommonController constructor.
     */
    public $isMobile = false;
    /**
     * 当前产路由名称
     * @var string
     */
    public $currRouteName = '';

    public function __construct ()
    {
        $this->currRouteName = Route::currentRouteName();
        $this->assign( 'currRouteName', $this->currRouteName );

    }

    /** 给模板赋值
     *
     * @param        $key
     * @param string $value
     */
    public function assign ( $key, $value = '' )
    {
        if ( is_array( $key ) ) {
            foreach ( $key as $k => $r ) {
                if ( !empty( $k ) ) {
                    $this->assign( $k, $r );
                }
            }
        } else {
            $this->viewData[ $key ] = $value;
        }
    }

    /**
     * 显示
     *
     * @param null   $data     数据
     * @param string $template 模板文件
     *
     * @return mixed|void
     */
    public function dispatch ( $data = null, $template = '' )
    {

    }


    /**
     * @param        $data
     * @param string $template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function display ( $data = '', $template = '' )
    {
        $template_info = $this->getTemplate( $template );
        //模板路径
        $template = $template_info['template_path'];
        //模板文件
        $template_file = $template_info['template_file'];

        //创建模板路径，写入默认的模板内容，
        if ( !file_exists( $template_file ) ) {
            //创建目录
            creat_dir_with_filepath( $template_file );
            //模板内容的内容
            $content = $this->getDefaultContent();

            //if ( is_writable( $template_file ) ) {
            file_put_contents( $template_file, $content );
            //} else {
            //    throw new Exception( '没有权限创建' );
            //}

        }
        //给模板传值
        if ( !empty( $data ) ) {
            $this->assign( $data );
        }

        return view( $template, $this->viewData );
    }
}
