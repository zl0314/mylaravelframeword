<div class="panel-body">
    <form action="/admin/{{$siteClass}}{{!empty($model->id)?'/'.$model->id:''}}" method="post">
        {{csrf_field()}}

        @if($siteMethod == 'edit') {{method_field('PUT')}} @endif
        <div class="form-group">
            <label for="">标题</label>
            <input type="text" class="form-control" value="{{$model->title??old('title')}}" name="title">
        </div>

        <div class="form-group">
            <label for="">自定义位置</label>
            <input type="text" class="form-control" value="{{$model->position??old('position')}}" name="position">
        </div>

        <div class="form-group">
            <label for="">链接地址</label>
            <input type="text" class="form-control" value="{{$model->url??old('url')}}" name="url">
        </div>
        @component('layouts.admin.fields.thumb', [
                         'title' => '图片&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                         'name' => 'image',
                         'siteClass' => $siteClass,
                         'size' => '360*238',
                         'model' => $model??null,
                     ])
        @endcomponent
        <div class="form-group">
            <label for="">排序</label>
            <input type="text" class="form-control" value="{{$model->listorder??old('listorder')}}" name="listorder">
            <span class="help-block">越大越靠前 </span>
        </div>
        <button type="submit" class="btn btn-primary">
            <span class="fa fa-save"> {{!empty($model->id) ? '修 改' :'保 存'}} </span>
        </button>
    </form>
</div></div>