<?php $__env->startSection('content'); ?>
    <div class="login_box">
        <h1>&nbsp;</h1>
        <h2><?php echo e(env('APP_CN_NAME')); ?></h2>
        <div class="form">
            <?php if(session('msg')): ?>
                <div class="alert alert-danger">
                    <p style="color:red"><?php echo e(session('msg')); ?></p>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(url('admin/login')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

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
                        <img src="<?php echo e(url('/captcha/1')); ?>" style="cursor: pointer;" alt=""
                             onclick="this.src='<?php echo e(url('/captcha')); ?>/'+Math.random()">
                    </li>
                    <li>
                        <input type="submit" value="立即登陆"/>
                    </li>
                </ul>
            </form>

            <script>
                $('#username').focus();
            </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>