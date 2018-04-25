<div class="form-group">
    <label for="">{{ $title }}</label>
    <input type="text" class="form-control" value="{{$model->$name??old($name)}}" name="{{$name}}"
           placeholder="">
</div>