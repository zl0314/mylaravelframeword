<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎</title>
</head>
<body>
<script>
    $.ajaxSetup({
        headers: { // 默认添加请求头
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
    });
    var public_key = "{{config('rsa.rsa_module')}}";
    var public_length = "{{config('rsa.e')}}";
</script>
@yield('content')
</body>
</html>