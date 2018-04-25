<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(url('/admin/chpass')); ?>" method="post" class="form-horizontal" role="form">
        <?php echo e(csrf_field()); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">修改密码</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="原密码" class="col-sm-1 control-label">用户名</label>
                    <div class="col-sm-10">
                        <?php echo e(Auth::guard('admin')->user()->username); ?>

                    </div>
                </div>

                <div class="form-group">
                    <label for="原密码" class="col-sm-1 control-label">原密码</label>
                    <div class="col-sm-10">
                        <input type="text" name="original_password" class="form-control" id="original_password"
                               placeholder="原密码">
                    </div>
                </div>

                <div class="form-group">
                    <label for="新密码" class="col-sm-1 control-label">新密码</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" class="form-control" id="password" placeholder="新密码">
                    </div>
                </div>

                <div class="form-group">
                    <label for="确认密码" class="col-sm-1 control-label">确认密码</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="password_confirmation" id="password_confirmation"
                               placeholder="确认密码">
                    </div>
                </div>

                
                <button type="submit" class="btn btn-primary">保存修改</button>
            </div>
        </div>


    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>