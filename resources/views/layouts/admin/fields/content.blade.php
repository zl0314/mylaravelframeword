@include('UEditor::head')
<div class="form-group">
    <label for="">{{$title}} </label>
    <!-- 加载编辑器的容器 -->
    <script type="text/plain" style="width:100%;height:400px;" id="container_{{$name}}" name="{{$name}}">
        {!! ($model->$name??old($name)) !!}
    </script>

    <script type = "text/javascript" >
    var ue = UE.getEditor('container_{{$name}}');

    </script>
</div>

<script>
    ue.ready(function () {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
    });
</script>