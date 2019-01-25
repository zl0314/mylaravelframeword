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
            <select name="type" class="form-control" id="type" >
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

        <div class="form-group">
            <label for="">轮播图</label>
            <div class="box" id="box"> </div>
        </div>

    @include('BatchUpload::header')
    <!--如果要用到排序，请去掉注释-->
        <!--<script src="/path/to/jquery/jquery-ui.js"></script>-->
        <script type="text/javascript">
            var imgFile = new ImgUploadeFiles('#box', function (e) {
                this.init({
                    MAX: 30, //限制个数
                    inputName: 'pics[]',
                    imgList: '{!! !empty($model->pics) ? json_encode($model->pics) : (old('pics')?json_encode([old('pics')]):'') !!}',
                    MH: 588, //像素限制高度
                    MW: 1170, //像素限制宽度
                    TitleName: '轮播图',
                    allowSize: '{{intval(ini_get('upload_max_filesize'))*1024*1024}}',
                    callback: function (dom) {
                        $.post('/jq-batch-upload/upload', {src: this.imgSrc}, function (res) {
                            if (res.success == 1) {
                                $(dom).attr('realsrc', res.src);
                                $(dom).find('input').val(res.src);
                            } else {
                                alert(res.message);
                            }
                        }, 'json');
                    },
                    remove: function (id) {
                        var realsrc = $('#batch_upload_' + id).attr('realsrc');
                        $.post('/jq-batch-upload/delete', {src: realsrc}, function (res) {

                        }, 'json');
                    }
                });
            });
        </script>
        <script>
            //如果要用到排序，请开启
            //$(function () {
            //    $("#sortable").sortable();
            //});
        </script>

        <button type="submit" class="btn btn-primary"><span
                    class="fa fa-save">{{!empty($model->id) ? ' 修 改' :' 保 存'}} </span></button>

    </form>


</div></div>