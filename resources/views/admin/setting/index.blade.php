@extends('layouts.admin.master')
@section('content')
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><input onclick="selallck(this)" type="checkbox" id="selectBtn" style="cursor:pointer;"></th>
                <th>ID</th>
                <th>说明</th>
                <th>关键字</th>
                <th>类别</th>
                <th>值</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!$data->isEmpty())
                @foreach($data as $item)
                    <tr id="item_{{$item->id}}">
                        <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->intro}}</td>
                        <td>{{$item->key}}</td>
                        <td>{{\App\Model\Setting::getValueType()[$item->type]}}</td>
                        <td>
                            @if($item->type == 3)
                                <div id="iframe_customize_html" style="display:none;">
                                    {!! $item->value !!}
                                </div>
                                <a href="javascript:iframe_customize_html();">内容可能过多，点击查看</a>
                            @else
                                {!! $item->value !!}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-default"
                                   href="{{url('/admin/'.$siteClass.'/'.$item->id.'/edit')}}"><span class="fa fa-edit"> 编辑</span></a>
                                <a class="btn btn-default" href="javascript:;"
                                   onclick="del('{{$item->id}}')"> <span class="fa fa-remove"> 删除</span></a>
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
            {!! getDataPaginate($data) !!}
        </ul>
    </div>
@endsection