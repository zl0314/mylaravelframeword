<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> 您没有权限执行此操作</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="http://www.layui.com/admin/std/dist/layuiadmin/style/admin.css" media="all">

    <link rel="stylesheet" href="<?php echo e(asset('/static/admin/font/css/font-awesome.min.css')); ?>">

    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
</head>
<body>


<div class="layui-fluid">
    <div class="layadmin-tips">
        <i class="fa fa-info-circle fa-5x " style="color:red"></i>
        <div class="layui-text">
            <h3>
                对不起，您没有权限执行此操作
            </h3>
            <br>
            <form method="post" action="#">
                <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-primary btn-block">首页</a>
                <br>
                <a href="<?php echo e($previousUrl); ?>" class="btn btn-default btn-block">点击返回</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>