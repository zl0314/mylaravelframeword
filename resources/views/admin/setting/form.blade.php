<div class="panel-body">
    <form action="/admin/{{$siteClass}}{{!empty($model->id)?'/'.$model->id:''}}" method="post">
        {{csrf_field()}}
        @if($siteMethod == 'edit') {{method_field('PUT')}} @endif

        <div class="form-group">
            <label for="">说明</label>
            <input type="text" class="form-control" value="{{$model->intro??old('intro')}}" name="intro">
        </div>

        <div class="form-group">
            <label for="">关键字</label>
            <input type="text" class="form-control" value="{{$model->key??old('key')}}" name="key">
        </div>

        <div class="form-group">
            <label for="">类型</label>
            <select id="type" name="type" class="form-control" onchange="changeType(this)">
                <option value="0">请选择</option>
                @foreach(\App\Model\Admin\Setting::getValueType() as $k => $r)
                    <option value="{{$k}}" @if(!empty($model->type) && $model->type == $k)) selected @endif >{{$r}}</option>
                    @endforeach
            </select>
        </div>

        <div class="form-group">
            <div id="type_target">
            </div>
            <div id="type_ueditor">
                <script type="text/plain" style="width:100%;height:400px;" id="value_content" name="value">{!! $model->value??old('value') !!}</script>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <span class="fa fa-save"> {!! !empty($model->id) ? '修 改' :'保 存' !!}</span>
        </button>
    </form>
</div></div>


@include('UEditor::head')
<script>
    @if(!empty($model->id))
    changeType('{{$model->type}}');

    @endif
    function changeType(obj) {
        type = typeof(obj) == 'string' ? obj : obj.value;
        var html = '<label for="">内容 </label>';
        if (type == 1) {
            html += '<textarea name="value" cols="30" id="value_text" rows="10"class="form-control">{{str_replace("\r\n",'',$model->value??old('value'))}}</textarea>';
        } else if (type == 2) {
                html += '<input id="value" type="hidden" name="value" value="@if(!empty($model) &&$model->type == 2 || old('type') == 2){{$model->value??old('value')}}@endif" class="input-txt"/>' +
                '            <input type="button" class="ajaxUploadBtn btn-primary btn" id="value_button"' +
                '                   onclick="ajaxUpload(\'value\',\'setting\')"' +
                '                   value="上传图片">' +
                '            <br><img  alt="" id="value_pic" style="width:auto;min-width:100px;" src="@if(!empty($model) &&$model->type == 2 || old('type') == 2){{$model->value??old('value')}}@endif">';

        } else if (type == 3) {
            $('#type_target').html('');
            $('#type_ueditor').show();
            var ue = UE.getEditor('value_content');
            ue.ready(function () {
                ue.execCommand('serverparam', '_token', '{{csrf_token()}}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
            });

            return;
        }
        $('#type_target').html(html);
        $('#type_ueditor').hide();
        if (type == 2) {
            $(".ajaxUploadBtn").trigger('click');
        }


    }
</script>
@include('layouts.admin.ajaxupload')