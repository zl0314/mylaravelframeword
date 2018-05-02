<div class="panel-body">
    <form action="/admin/{{$siteClass}}{{!empty($model->id)?'/'.$model->id:''}}" method="post">
        {{csrf_field()}}

        @if($siteMethod == 'edit') {{method_field('PUT')}} @endif

        <div class="form-group">
            <label for="">所属菜单</label>
            <select name="fid" id="" class="form-control">
                <option value="0">无</option>
                @foreach(\App\Model\Permissions::treePermisstionsByLevel() as $k =>$r))
                <option @if(!empty($model) && $model->fid == $r['id']) selected
                        @endif value="{{$r['id']}}">@if($r['fid'] != 0) {{str_repeat('&nbsp;', $r['level'] * 2)}}
                    |_ @endif {{$r['display_name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">权限名</label>
            <input type="text" placeholder="如：admin_user" class="form-control" value="{{$model->name??old('name')}}"
                   name="name">
        </div>
        <div class="form-group">
            <label for="">显示名</label>
            <input type="text" class="form-control" placeholder="如：测试组"
                   value="{{$model->display_name??old('display_name')}}"
                   name="display_name">
        </div>

        <div class="form-group">
            <label for="">描述</label>
            <textarea class="form-control" name="description" id="" cols="30"
                      rows="10">{{$model->description??old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label for="">是否菜单</label>
            <select name="is_menu" id="" class="form-control">
                <option value="1" @if(!empty($model->is_menu) && $model->is_menu == 1) selected @endif>是</option>
                <option value="0" @if(isset($model->is_menu) && $model->is_menu == 0) selected @endif >否</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">排序</label>
            <input type="text" class="form-control" placeholder=""
                   value="{{$model->sort??old('sort')??1}}"
                   name="sort">
        </div>

        @include('BatchUpload::header')
        <div class="box" id="box">
        </div>
        <script type="text/javascript">
            var imgFile = new ImgUploadeFiles('#box', function (e) {
                this.init({
                    MAX: 1, //限制个数
                    inputName: 'pics',
                    MH: 800, //像素限制高度
                    MW: 300, //像素限制宽度
                    allowSize : '{{intval(ini_get('upload_max_filesize'))*1024*1024}}',
                    callback: function (dom) {
                        $.post('/jq-batch-upload/upload', {src: this.imgSrc}, function (res) {
                            $(dom).attr('realsrc', res.data.src);
                            $(dom).find('input').val(res.data.src);
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
        <button type="submit" class="btn btn-primary">{{!empty($model->id) ? '修 改' :'保 存'}} </button>
    </form>
</div></div>