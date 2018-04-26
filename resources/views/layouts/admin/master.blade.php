<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/static/admin/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('/static/admin/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('/static/admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/admin/js/ch-ui.admin.js')}}"></script>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <!-- Latest compiled and minified JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/static/admin/layer/layer.js"></script>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/js/global.js"></script>
</head>
<title>{{env('APP_CN_NAME')}}</title>
<body>
<script>
    var public_key = "{{config('rsa.rsa_module')}}";
    var public_length = "{{config('rsa.e')}}";
    $.ajaxSetup({
        headers: { // 默认添加请求头
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
    });
    $(function () {
        $('#menu_box').height($('body').height() - 50);
        // $('#main_box').width($('body').width()-188);
    })

    function del(id) {
        //询问框
        layer.confirm('确认要删除此记录？', {
            btn: ['确认', '取消'] //按钮
        }, function () {
            $.ajax({
                url: '{{url(request()->path())}}/' + id,
                method: 'DELETE',
                dataType: 'json',
                success: function (res) {
                    layer.msg(res.message, {icon: 1}, function () {
                        if (res.success == 1) {
                            $('#item_' + id).remove();
                        }
                    });
                }
            })
        });
    }

    function del_batch() {
        var ids = [];
        $('td').find('input[type="checkbox"]:checked').each(function () {
            ids[ids.length] = $(this).val();
        });
        if (ids.length <= 0) {
            layer.msg('请选择要删除的记录');
            return;
        } else {
            layer.confirm('确定删除这些信息吗？', function () {
                $.ajax({
                    url: '{{url('/admin/batchDel')}}/{{$siteClass}}',
                    method: 'POST',
                    dataType: 'json',
                    data: {ids: ids},
                    success: function (res) {
                        layer.msg(res.message, {icon: 1}, function () {
                            if (res.success == 1) {
                                for (k in ids) {
                                    $('#item_' + ids[k]).remove();
                                }
                            }
                        });
                    }
                })
            });
        }
    }

    //全选操作
    function selallck(o) {
        if ($(o).prop('checked')) {
            $('td').find('input[type="checkbox"]').prop('checked', true);
        } else {
            $('td').find('input[type="checkbox"]').prop('checked', false);
        }
    }
</script>

<!--头部 开始-->
<div style="width:100%;">
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/" target="_blank"
                   style="width:100%;min-width: 188px; text-align: center;">{{env('APP_CN_NAME')}}</a>
            </div>
            <div>
                {!!  \App\Services\Menus::getTopMenus() !!}
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            管理员：{{Auth::guard('admin')->user()->username}} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/admin/my')}}"><span class="fa fa-user"> 我的资料</span></a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('/admin/chpass')}}"><span class="fa fa-edit"> 修改密码</span></a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('/admin/quite')}}"><span class="fa fa-sign-out"> 退出</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!--头部 结束-->
<div>
    <!--左侧导航 开始-->
    <div class="menu_box" id="menu_box" style="height:100%;min-height: 600px;">
        {!! \App\Services\Menus::getLeftMenus($siteClass) !!}
    </div>
    <!--左侧导航 结束-->

    <!--主体部分 开始-->
    <div class="main_box" id="main_box">
        @include('layouts.admin.crumb')

        <div class="container" style="margin-top:10px;width:99%">
            @include('flash::message')
            {{--不显示 列表 添加 导航的类--}}
            {{--@if($siteClass != 'index' && $siteClass != 'chpass' && $siteClass != 'my')--}}

            @if(file_exists(resource_path().'/views/admin/'.$siteClass.'/nav.blade.php'))
                @includeIf('admin.'.$siteClass.'.nav')
            @else
                @include('layouts.admin.nav')
            @endif
            {{--@endif--}}

            @yield('content')
        </div>
    </div>
    <!--主体部分 结束-->
</div>

<script>
    var menu = {!!  json_encode(\App\Services\Menus::getMenuInfo($siteClass.'.index'))!!}
    $('#menu_box').find('.menus').hide();

    $(function () {
        //父级菜单显示
        $('#SubMenu_' + menu.fid).parent().show();
        //当前菜单加焦点
        $('#curMenu_{{$siteClass}}').find('a').addClass('curr');
        $('#curMenu_{{$siteClass}}').find('a > i').addClass('fa fa-circle-o');
        //显示所有同级菜单
        $('#SubMenu_' + menu.fid).find('.sub_menu').show();

        //顶级菜单显示
        $('#top_nav').find('li').removeClass('active');
        var topParent = $('#curMenu_{{$siteClass}}').attr('top_parent');
        $('#topMenu_' + topParent).addClass('active');
    })

    $('#top_nav').find('li a').click(function () {
        change_menu($(this))
    });

    function change_menu(obj) {
        var index = $(obj).parent().index();
        $('#top_nav').find('li').removeClass('active');
        $(obj).parent().addClass('active');

        $('#menu_box').find('.menus').hide();
        // var a = $('#menu_box').find('.menus:eq('+parseInt(index)+')').html();
        $('#menu_box').find('.menus:eq(' + parseInt(index) + ')').show()
        $('#menu_box').find('.menus:eq(' + parseInt(index) + ')').find('.sub_menu').show()
    }

</script>
@include('layouts.admin.errors')
@include('layouts.admin.ajaxupload')

</body>
</html>