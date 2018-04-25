<div class="form-group">
    <label for="">{{ $title }} </label>
    <textarea name="{{$name}}" cols="30" rows="10" class="form-control">{{$model->$name??old($name)}}</textarea>
</div>