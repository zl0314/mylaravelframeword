@extends('layouts.admin.login')

@section('content')
    <div class="login_box">
        <h1>&nbsp;</h1>
        <h2>{{env('APP_CN_NAME')}}</h2>
        <div class="form">
            @if(session('msg'))
                <div class="alert alert-danger">
                    <p style="color:red">{{session('msg')}}</p>
                </div>
            @endif
            <form action="{{url('admin/login')}}" method="post">
                {{csrf_field()}}
                <ul>
                    <li>
                        <input type="text" id="username" name="username" class="text"/>
                        <span><i class="fa fa-user"></i></span>
                    </li>
                    <li>
                        <input type="password" name="password" class="text"/>
                        <span><i class="fa fa-lock"></i></span>
                    </li>
                    <li>
                        <input type="text" class="code" name="captcha" maxlength="5"/>
                        <span><i class="fa fa-check-square-o"></i></span>
                        <img src="{{url('/captcha/1')}}" style="cursor: pointer;" alt=""
                             onclick="this.src='{{url('/captcha')}}/'+Math.random()">
                    </li>
                    <li>
                        <input type="submit" value="立即登陆"/>
                    </li>
                </ul>
            </form>

            <script>
                $('#username').focus();
            </script>
@endsection
