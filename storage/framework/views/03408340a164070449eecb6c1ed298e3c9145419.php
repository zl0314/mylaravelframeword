<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('/admin/my')); ?>" method="post" class="form-horizontal" role="form">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="id" value="<?php echo e(isset($user->id) ? $user->id : ''); ?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">我的资料</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="真实姓名" class="col-sm-1 control-label">真实姓名</label>
                    <div class="col-sm-10">
                        <input type="text" name="realname" value="<?php echo e(isset($user->realname) ? $user->realname : old('realname')); ?>"
                               class="form-control"
                               id="realname" placeholder="真实姓名">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">保存修改</button>
            </div>
        </div>

    </form>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>