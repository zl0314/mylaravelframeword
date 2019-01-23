@extends('layouts.admin.master')
@section('searchForm')
    <tr>
        <th width="70">标题:</th>
        <td><input type="text" name="title" value="{{request()->get('title')}}" placeholder="标题"></td>

        <th width="70">类别:</th>
        <td>
            <select name="type" class="form-control" >
                <option value="">请选择</option>
                @foreach(\App\Model\Admin\News::getType() as $k => $r)
                    <option value="{{$k}}"
                            @if(request()->get('type') == $k ) selected @endif >{{$r}}</option>
                @endforeach
            </select>

        </td>

        <td><input type="submit" class="btn btn-primary" value="查询"></td>
    </tr>
@endsection

@section('content')
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><input onclick="selallck(this)" type="checkbox" id="selectBtn" style="cursor:pointer;"></th>
                <th>标题</th>
                <th>类别</th>
                <th>来源 </th>
                <th style="width:350px;">描述</th>

                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if(!$data->isEmpty())
                @foreach($data as $item)
                    <tr id="item_{{$item->id}}">
                        <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                        <td>{!! htmlspecialchars_decode(html_entity_decode($item->title))!!}</td>
                        <td>{{\App\Model\Admin\News::getType()[$item->type]}}</td>
                        <td>{{$item->source}}</td>
                        <td> {!! htmlspecialchars_decode(html_entity_decode($item->description))!!}</td>

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

@endsection