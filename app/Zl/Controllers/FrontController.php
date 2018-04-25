<?php

namespace App\Zl\Controllers;

use App\Model\Setting;
use App\Zl\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Model\Banner;

class FrontController extends CommonController
{
    /**
     * FrontController constructor.
     */
    public function __construct ()
    {
        parent::__construct();

        $this->isMobile = $this->isMobile();

        $path = request()->path();
        $pathArr = explode( '/', $path );

        $siteClass = !empty( $pathArr[0] ) ? $pathArr[0] : 'index';
        $id = ( !empty( $pathArr[1] ) && is_numeric( $pathArr[1] ) ) ? $pathArr[1] : '0';
        $siteMethod = !empty( $id ) ? ( !empty( $pathArr[2] ) ? $pathArr[2] : 'show' ) : ( !empty( $pathArr[1] ) ? $pathArr[1] : 'index' );

        $this->siteMethod = $siteMethod;
        $this->siteClass = $siteClass;
        $this->id = $id;

        $webset = cache()->remember( 'setting', config( 'cache.expire' ), function () {
            $setting = Setting::where( [] )->get();
        } );

        $vars = [
            'siteMethod' => $siteMethod,
            'siteClass'  => $siteClass,
            'webSet' => $webset
        ];

        $this->assign( $vars );

    }

    /**
     * 获取模板的路径和模板文件
     *
     * @param $template
     *
     * @return array
     */
    protected function getTemplate ( $template )
    {

        $template_dir = $this->isMobile ? 'mobile' : 'web';
        $template = $template ? $template : $template_dir . '.' . $this->siteClass . '.' . $this->siteMethod;
        $template_file = resource_path() . '/views/' . str_replace( '.', '/', $template ) . '.blade.php';

        return [
            'template_path' => $template,
            'template_file' => $template_file,
        ];
    }

    protected function getDefaultContent ()
    {
        $template_dir = $this->isMobile ? 'mobile' : 'web';
        $returnContent = '@extends(\'layouts.' . $template_dir . '.master\')'
            . "\r\n" . '@section(\'content\')'
            . "\r\n\r\n"
            . '@endsection';

        return $returnContent;
    }

    //设置页面标题
    public function setPageTitle ( $title )
    {
        $this->assign( 'page_title', $title );
    }

    /**
     * 获取栏目位置Banner
     *
     * @param $pos     位置
     * @param $default 没有得到pos位置的Banner， 去读取default里的Banner
     *
     * @throws \Exception
     */
    public function getPosBanner ( $pos, $default = '' )
    {
        $banners = Banner::getPosBanner( $pos );
        if ( $default && $banners->isEmpty() ) {
            $banners = Banner::getPosBanner( $default );
        }
        $vars = [
            'banners' => $banners,
        ];
        $this->assign( $vars );
    }

    /**
     * 判断是否是移动端访问
     * @return bool
     */
    public function isMobile ()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if ( isset ( $_SERVER['HTTP_X_WAP_PROFILE'] ) ) {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if ( isset ( $_SERVER['HTTP_VIA'] ) ) {
            return stristr( $_SERVER['HTTP_VIA'], "wap" ) ? true : false;// 找不到为flase,否则为TRUE
        }
        // 判断手机发送的客户端标志,兼容性有待提高
        if ( isset ( $_SERVER['HTTP_USER_AGENT'] ) ) {
            $clientkeywords = [
                'mobile',
                'nokia',
                'sony',
                'ericsson', 'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
            ];
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if ( preg_match( "/(" . implode( '|', $clientkeywords ) . ")/i", strtolower( $_SERVER['HTTP_USER_AGENT'] ) ) ) {
                return true;
            }
        }
        if ( isset ( $_SERVER['HTTP_ACCEPT'] ) ) { // 协议法，因为有可能不准确，放到最后判断
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ( ( strpos( $_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml' ) !== false ) && ( strpos( $_SERVER['HTTP_ACCEPT'], 'text/html' ) === false || ( strpos( $_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml' ) < strpos( $_SERVER['HTTP_ACCEPT'], 'text/html' ) ) ) ) {
                return true;
            }
        }

        return false;
    }

}
