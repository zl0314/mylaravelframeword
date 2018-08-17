<div class="panel-body">
    <form action="/admin/{{$siteClass}}{{!empty($model->id)?'/'.$model->id:''}}" method="post">
        {{csrf_field()}}

        @if($siteMethod == 'edit') {{method_field('PUT')}} @endif

        <div class="form-group">
            <label for="">所属菜单</label>
            <select name="fid" id="" class="form-control">
                <option value="0">无</option>
                @foreach(\App\Model\Admin\Permissions::treePermisstionsByLevel() as $k =>$r))
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
            <label for="">是否初始化增删改权限节点</label>
            <select name="init_curd" id="" class="form-control">
                <option value="1" @if(!empty($model->init_curd) && $model->init_curd == 1) selected @endif>是</option>
                <option value="0" @if( (isset($model->init_curd) && $model->init_curd == 0 ) || empty($model)) selected @endif >否</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">排序</label>
            <input type="text" class="form-control" placeholder=""
                   value="{{$model->sort??old('sort')??1}}"
                   name="sort">
        </div>


        <button type="submit" class="btn btn-primary">{{!empty($model->id) ? '修 改' :'保 存'}} </button>
    </form>
</div></div>