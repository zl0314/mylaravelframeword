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
            <label for="">值 </label>
            <textarea name="value" cols="30" rows="10" class="form-control">{{$model->value??old('value')}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <span class="fa fa-save"> {!! !empty($model->id) ? '修 改' :'保 存' !!}</span>
        </button>
    </form>
</div></div>