@extends('layouts.admin.master')

@section('content')
    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>

                <li>
                    <label>上传附件限制</label><span><?php echo get_cfg_var( "upload_max_filesize" ) ? get_cfg_var( "upload_max_filesize" ) : "不允许上传附件"; ?></span>
                </li>
                <li>
                    <label>北京时间</label><span><?php echo date( 'Y年m月d日 H时i分s秒' )?></span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
                </li>

            </ul>
        </div>
    </div>
@endsection


