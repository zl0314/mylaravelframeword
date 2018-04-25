<div class="form-group">
    <label for="">{{ $title }} </label>
    <input id="{{$name}}" type="hidden" name="{{$name}}" value="{{$model->$name??old($name)}}"
           class="input-txt"/>
    <input type="button" class="ajaxUploadBtn btn-primary btn" id="{{$name}}_button"
           onclick="ajaxUpload('{{$name}}','{{$siteClass}}')"
           value="上传图片">
    <small id="fileHelpId" class="form-text text-muted">JPG，PNG，GIF 格式图片,{{$size}}</small>
    <br><br>
    <img @if( !empty($model->$name) || old($name))src="{{$model->$name??old($name)}}" @endif
    alt="" id="{{$name}}_pic" width="100">
</div>
