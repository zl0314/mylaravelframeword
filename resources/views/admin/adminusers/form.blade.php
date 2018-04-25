<div class="panel-body">
    <form action="/admin/{{$siteClass}}{{!empty($model->id)?'/'.$model->id:''}}" method="post">
        {{csrf_field()}}

        @if($siteMethod == 'edit') {{method_field('PUT')}} @endif
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" class="form-control" value="{{$model->username??old('username')}}" name="username">
        </div>

        <div class="form-group">
            <label for="">真实姓名</label>
            <input type="text" class="form-control" value="{{$model->profile->realname??old('profile.realname')}}"
                   name="profile[realname]">
        </div>

        <div class="form-group">
            <label for="">密码</label>
            <input type="text" class="form-control" value="" name="password">
        </div>

        <div class="form-group">
            <label for="">确认密码</label>
            <input type="text" class="form-control" value="" name="password_confirmation">
        </div>

        <hr>
        <div class="form-group">
            <label for="">角色选择</label>
            <div class="checkbox">
                @foreach(\App\Model\Roles::all() as $r)
                    <label>
                        <input type="checkbox"
                               @if(!empty($model->id) && in_array($r->id, array_column($model->roles()->get()->toArray(), 'id') )  ) checked
                               @endif name="role[{{$r->id}}]" value="{{$r->id}}"> {{$r->display_name}}
                    </label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{!empty($model->id) ? '修 改' :'保 存'}} </button>
    </form>
</div></div>