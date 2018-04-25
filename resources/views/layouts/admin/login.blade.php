<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('/static/admin/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('/static/admin/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('/static/admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/admin/js/ch-ui.admin.js')}}"></script>

    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
</head>
<title>{{env('APP_CN_NAME')}}</title>
<body  style="background:#F3F3F4;">

@yield('content')

</div>
</div>
</body>
</html>