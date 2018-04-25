<?php

use Illuminate\Support\Facades\Log;

/**
 * Created by Aaron Zhang.
 * Date: 2017/12/14 22:49
 * FileName : common_helper.php
 */
/**
 * 创建多级文件夹 参数为带有文件名的路径
 *
 * @param string $path 路径名称
 */
function creat_dir_with_filepath ( $path, $mode = 0777 )
{
    return creat_dir( dirname( $path ), $mode );
}

/**
 * 创建多级文件夹
 *
 * @param string $path 路径名称
 */
function creat_dir ( $path, $mode = 0777 )
{
    if ( !is_dir( $path ) ) {
        if ( creat_dir( dirname( $path ) ) ) {
            return @mkdir( $path, $mode );
        }
    } else {
        return true;
    }
}


//过滤字符
function newhtmlspecialchars ( $string )
{
    if ( is_array( $string ) ) {
        return array_map( 'newhtmlspecialchars', $string );
    } else {
        $string = htmlspecialchars( $string );
        $string = sstripslashes( $string );
        $string = saddslashes( $string );

        return trim( $string );
    }
}

//去掉slassh
function sstripslashes ( $string )
{
    if ( is_array( $string ) ) {
        foreach ( $string as $key => $val ) {
            $string[ $key ] = sstripslashes( $val );
        }
    } else {
        $string = stripslashes( $string );
    }

    return $string;
}

function saddslashes ( $string )
{
    if ( is_array( $string ) ) {
        foreach ( $string as $key => $val ) {
            $string[ $key ] = saddslashes( $val );
        }
    } else {
        $string = addslashes( $string );
    }

    return $string;
}

/**
 * @desc 检查是否是合法的手机号格式，现阶段合法的格式：以13,15,18,17开头的11位数字
 *
 * @param $cellphone
 */
function isMobile ( $cellphone )
{
    $pattern = "/^(13|15|18|17|14|16){1}\d{9}$/";

    return str_match( $pattern, $cellphone );
}

//字符串匹配
function str_match ( $pattern, $str )
{
    if ( !empty( $str ) ) {
        if ( preg_match( $pattern, $str ) ) {
            return true;
        }
    }

    return false;
}

//解密前端加密的数据
function parseEncryptData ()
{
    $data = request()->post( 'data' );
    $formData = app( 'rsa' )->privateDecrypt( $data );
    parse_str( $formData, $result );

    return $result;
}


/**
 * 发送短信给用户
 * @$mobile  手机号
 * @$content 短信内容
 */
function sendUserMessage ( $mobile = '', $content = '' )
{
    if ( $mobile == '' && $content == '' ) {
        return false;
    }
    $sn = 'SDK-WKS-010-00921'; //提供的账号
    $pwd = strtoupper( md5( $sn . '6@d953@4d59' ) );
    $data = [
        'sn'      => $sn, //提供的账号
        'pwd'     => $pwd, //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
        'mobile'  => $mobile, //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
        'content' => $content . '【拓拓宝】',
        'ext'     => '',
        'stime'   => '', //定时时间 格式为2011-6-29 11:09:21
        'rrid'    => '',//默认空 如果空返回系统生成的标识串 如果传值保证值唯一 成功则返回传入的值
        'msgfmt'  => '',
    ];
    $url = "http://sdk2.entinfo.cn:8061/mdsmssend.ashx";
    $retult = api_notice_increment( $url, $data );
    $retult = str_replace( "<?xml version=\"1.0\" encoding=\"utf-8\"?>", "", $retult );
    $retult = str_replace( "<string xmlns=\"http://tempuri.org/\">", "", $retult );
    $retult = str_replace( "</string>", "", $retult );
    if ( $retult > 0 ) {
        Log::error( $mobile . '发送成功返回值为:' . $retult . ' content ' . $content );

        return true;
    } else {
        Log::error( $mobile . '发送失败 返回值为 : ' . $retult . ' content ' . $content );

        return true;
    }
}

function api_notice_increment ( $url, $data )
{
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt( $curl, CURLOPT_URL, $url ); // 要访问的地址
    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] ); // 模拟用户使用的浏览器
    curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
    curl_setopt( $curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
    curl_setopt( $curl, CURLOPT_POST, 1 ); // 发送一个常规的Post请求
    $data = http_build_query( $data );
    curl_setopt( $curl, CURLOPT_POSTFIELDS, $data ); // Post提交的数据包
    curl_setopt( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
    curl_setopt( $curl, CURLOPT_HEADER, 0 ); // 显示返回的Header区域内容
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回

    $lst = curl_exec( $curl );
    if ( curl_errno( $curl ) ) {
        Log::error( 'Errno' . curl_error( $curl ) );//捕抓异常
    }
    curl_close( $curl );

    return $lst;
}


//获取在线IP
function getonlineip ( $format = 0 )
{

    if ( isset( $_SERVER['HTTP_CDN_SRC_IP'] ) && $_SERVER['HTTP_CDN_SRC_IP'] && strcasecmp( $_SERVER['HTTP_CDN_SRC_IP'], 'unknown' ) ) {
        $onlineip = $_SERVER['HTTP_CDN_SRC_IP'];
    } elseif ( getenv( 'HTTP_CLIENT_IP' ) && strcasecmp( getenv( 'HTTP_CLIENT_IP' ), 'unknown' ) ) {
        $onlineip = getenv( 'HTTP_CLIENT_IP' );
    } elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp( getenv( 'HTTP_X_FORWARDED_FOR' ), 'unknown' ) ) {
        $onlineip = getenv( 'HTTP_X_FORWARDED_FOR' );
    } elseif ( getenv( 'REMOTE_ADDR' ) && strcasecmp( getenv( 'REMOTE_ADDR' ), 'unknown' ) ) {
        $onlineip = getenv( 'REMOTE_ADDR' );
    } elseif ( isset( $_SERVER['REMOTE_ADDR'] ) && $_SERVER['REMOTE_ADDR'] && strcasecmp( $_SERVER['REMOTE_ADDR'], 'unknown' ) ) {
        $onlineip = $_SERVER['REMOTE_ADDR'];
    }
    preg_match( "/[\d\.]{7,15}/", $onlineip, $onlineipmatches );
    $onlineip = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';

    if ( $format ) {
        $ips = explode( '.', $onlineip );
        for ( $i = 0; $i < 3; $i++ ) {
            $ips[ $i ] = intval( $ips[ $i ] );
        }

        return sprintf( '%03d%03d%03d', $ips[0], $ips[1], $ips[2] );
    } else {
        return $onlineip;
    }
}

/**
 * 重新解析介绍信息，
 *
 * @param $intro    内容
 * @param $wrapper  外面包围的标签
 */
function getParseIntro ( $intro, $wrapper = 'p', $delimiter = PHP_EOL )
{
    $intro = explode( PHP_EOL, $intro );
    $html = '';
    foreach ( $intro as $k => $r ) {
        $html .= '<' . $wrapper . '>' . $r . '</' . $wrapper . '>';
    }

    return $html;
}

/**
 * 解析视频
 *
 * @param $video 视频地址
 *               如果是.mp4格式，返回video标签， 如果是腾讯， 或是优酷， 返回iframe
 *
 * @return string
 */
function parseVideo ( $video, $width = '1280px', $height = '640px' )
{
    $html = '';
    if ( strpos( $video->video_url, '.mp4' ) !== false ) {
        $html = '<video src="' . $video->video_url . '" poster="' . $video->thumb . '" preload="preload" controls="controls"></video>';
    } else {
        $html = '<iframe src="' . $video->video_url . '" style="width:' . $width . ';height:' . $height . ';" scrolling="false" frameborder="0"></iframe>';
    }

    return $html;
}

/**
 * 上一条
 *
 * @param  $item  当前记录
 * @param  $model 模型
 * @param  $url   链接
 */
function getPrevItem ( $item, $model, $url = '' )
{
    $model = new $model;
    $prev = $model->where( 'id', '<', $item->id )->orderBy( 'id', 'desc' )->first();
    if ( !empty( $prev->id ) ) {
        return [
            'title' => $prev->title,
            'url'   => $url . '/' . $prev->id . '?id=' . $prev->id,
        ];
    } else {
        return [
            'title' => '没有了',
            'url'   => 'javascript:;',
        ];
    }
}

/**
 * 下一条
 *
 * @param  $item  当前记录
 * @param  $model 模型
 * @param  $url   链接
 */
function getNextItem ( $item, $model, $url = '' )
{
    $model = new $model;
    $next = $model->where( 'id', '>', $item->id )->orderBy( 'id', 'asc' )->first();
    if ( !empty( $next->id ) ) {
        return [
            'title' => $next->title,
            'url'   => $url . '/' . $next->id . '?id=' . $next->id,
        ];
    } else {
        return [
            'title' => '没有了',
            'url'   => 'javascript:;',
        ];
    }
}


//如果URL没有HTTP， 添加HTTP， 如果URL为空，则链接为javascript:;
function get_add_http_url ( $url = '' )
{
    if ( $url ) {
        if ( strpos( $url, 'http' ) !== false ) {
            return $url;
        } else {
            return 'http://' . $url;
        }
    } else {
        return 'javascript:;';
    }
}
