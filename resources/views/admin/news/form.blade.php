<div class="panel-body">
    <form action="/admin/{{$siteClass}}{{!empty($model->id)?'/'.$model->id:''}}" method="post">
        {{csrf_field()}}

        @if($siteMethod == 'edit') {{method_field('PUT')}} @endif
        <div class="form-group">
            <label for="">标题</label>
            <input type="text" class="form-control" value="{{$model->title??old('title')}}" name="title">
        </div>
        <div class="form-group">
            <label for="">来源 </label>
            <input type="text" class="form-control" value="{{$model->source??old('source')}}" name="source">
        </div>
        <div class="form-group">
            <label for="">类别</label>
            <select name="type" class="form-control" id="type" onchange="toggle_type(this)">
                <option value="">请选择</option>
                @foreach(\App\Model\Admin\News::getType() as $k => $r)
                    <option value="{{$k}}"
                            @if(!empty($model) && $model->type == $k || old('type') == $k) selected @endif >{{$r}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">描述</label>
            <textarea name="description" id="" cols="30" class="form-control"
                      rows="10">{{$model->description??old('description')}}</textarea>
        </div>

        @component('layouts.admin.fields.thumb', [
                 'title' => '缩略图&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                 'name' => 'thumb',
                 'siteClass' => $siteClass,
                 'size' => '384*259',
                 'model' => $model??null,
             ])
        @endcomponent

        @component('layouts.admin.fields.content', [
                   'title' => '内容',
                   'name' => 'content',
                   'model' => $model??null,
               ])
        @endcomponent
        <script src="/static/admin/js/WdatePicker.js"></script>
        <div class="form-group">
            <label for="">添加时间</label>
            <input size="16" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="created_at"
                   value="{{$model->created_at??old('created_at')??date('Y-m-d H:i:s')}}"
                   readonly
                   class="form_datetime form-control " id="created_at">
        </div>

        <button type="submit" class="btn btn-primary"><span
                    class="fa fa-save">{{!empty($model->id) ? ' 修 改' :' 保 存'}} </span></button>

    </form>


</div></div>