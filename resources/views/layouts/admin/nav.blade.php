<div class="search_wrap" style="margin-bottom:10px;">
    <form action="" method="get">
        <table class="search_tab">
            @yield('searchForm')
        </table>
    </form>
</div>
<!-- TAB NAVIGATION -->
<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 10px;">
    <li @if($siteMethod == 'index') class="active" @endif >
        <a style="cursor: pointer;" class="" href="{{url('admin/'.$siteClass )}}{{$params or ''}}"> <span
                    class="fa fa-th-list"></span> {{$here}}列表</a>
    </li>
    @if(empty($dontNeedAdd))
        <li @if($siteMethod == 'create' || $siteMethod == 'edit') class="active" @endif >
            @if($siteMethod == 'index' || $siteMethod == 'create')
                <a style="cursor: pointer;" href="{{url('admin/'.$siteClass.'/create')}}{{$params or ''}}">
                    <span class="fa fa-plus-circle"></span> {{$here}}添加
                </a>
            @else
                <a href="javascript:;"><span class="fa fa-edit"></span> {{$here}}编辑</a>
            @endif
        </li>
    @endif
</ul>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">{{$here}}管理</h3>
    </div>

