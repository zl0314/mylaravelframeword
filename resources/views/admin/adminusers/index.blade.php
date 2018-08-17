@extends('layouts.admin.master')
@section('content')
    {{Cookie::get('name')}}
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><input onclick="selallck(this)" type="checkbox" id="selectBtn" style="cursor:pointer;"></th>
                <th>用户名</th>
                <th>真实姓名</th>
                <th>是否超级管理员</th>
                <th>角色</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if(!$data->isEmpty())
                @foreach($data as $item)
                    <tr id="item_{{$item->id}}">
                        @if(!$item->is_super)
                            <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                        @else
                            <td></td>
                        @endif
                        <td>{{$item->username}}</td>
                        <td>{{$item->profile->realname or '--'}}</td>
                        <td>{!!
                            $item->is_super == 1 ?
                         '<span class="label label-danger">是</span>' :
                          '<span class="label label-default">否</span>'
                           !!}</td>
                        <td>
                            @if($item->roles()->count())
                                @foreach($item->roles()->get() as $role)
                                    <span class="label label-info ">{{ $role->display_name }}</span>
                                @endforeach
                            @else
                                <span class="label label-info">无</span>
                            @endif
                        </td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <div class="btn-group">
                                @if(!$item->is_super)
                                    <a class="btn btn-default"
                                       href="{{url('/admin/'.$siteClass.'/'.$item->id.'/edit')}}"><span
                                                class="fa fa-edit"> 编辑</span></a>
                                    <a class="btn btn-default" href="javascript:;"
                                       onclick="del('{{$item->id}}')"><span class="fa fa-remove"> 删除</span> </a>
                                @else
                                    --
                                @endif
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

@endsection