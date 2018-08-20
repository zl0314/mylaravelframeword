@extends('layouts.admin.master')
@section('content')

    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><input onclick="selallck(this)" type="checkbox" id="selectBtn" style="cursor:pointer;">

                </th>
                <th>&nbsp;</th>
                <th>名称</th>
                <th>说明</th>
                <th>是否菜单</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if(!$data->isEmpty())
                @foreach($data as $item)
                    <tr id="item_{{$item->id}}" loaded="0" level="0">
                        <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                        <td><span class="fa fa-chevron-right" style="cursor: pointer;" title="查看子菜单"
                                  onclick="getSubmenus('{{$item->id}}')">&nbsp;</span></td>
                        <td>{{$item->display_name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{!! $item->is_menu == 1 ? '<span class="label label-danger">是</span>' : '<span class="label label-default">否</span>'!!}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-default"
                                   href="{{url('/admin/'.$siteClass.'/'.$item->id.'/edit')}}"><span class="fa fa-edit"> 编辑</span></a>
                                <a class="btn btn-default" href="javascript:;"
                                   onclick="del('{{$item->id}}')"><span class="fa fa-remove"> 删除</span> </a>
                            </div>
                        </td>
                    </tr>

                @endforeach
            @else
                <tr>
                    <td colspan="20">暂时没有任何数据。。</td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>
    </div>
    <div style="padding:0 5px; height:70px; border-radius: 5px;" class="">
        @if(!$data->isEmpty())
            <div class="btn btn-primary" style="float:left;width:100px;margin-top:15px;" onclick="del_batch()"><span
                        class="fa fa-trash-o "> 批量删除</span></div>
        @endif
        <ul class="pagination" style="float:right; margin-top:0px;">
            {!! $data->links() !!}
        </ul>
    </div>
    <script>
        function getSubmenus(id) {
            var loaded = $('#item_' + id).attr('loaded');
            var level = $('#item_' + id).attr('level');

            if (loaded == 1) {
                return false;
            }
            ajax('/admin/permissions/publicGetSubMenus', {id: id, level: level}, function (res) {
                if (res == '') {
                    alert_mini('没有子菜单');
                } else {
                    $('#item_' + id).attr('loaded', 1);
                    $('#item_' + id).after(res);
                }
            }, 'html');
        }
    </script>
@endsection