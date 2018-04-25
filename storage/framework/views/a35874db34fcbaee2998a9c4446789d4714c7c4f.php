<div class="panel-body">
    <form action="/admin/<?php echo e($siteClass); ?><?php echo e(!empty($model->id)?'/'.$model->id:''); ?>" method="post">
        <?php echo e(csrf_field()); ?>


        <?php if($siteMethod == 'edit'): ?> <?php echo e(method_field('PUT')); ?> <?php endif; ?>
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" class="form-control" value="<?php echo e($model->username??old('username')); ?>" name="username">
        </div>

        <div class="form-group">
            <label for="">真实姓名</label>
            <input type="text" class="form-control" value="<?php echo e($model->profile->realname??old('profile.realname')); ?>"
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
                <?php $__currentLoopData = \App\Model\Roles::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label>
                        <input type="checkbox"
                               <?php if(!empty($model->id) && in_array($r->id, array_column($model->roles()->get()->toArray(), 'id') )  ): ?> checked
                               <?php endif; ?> name="role[<?php echo e($r->id); ?>]" value="<?php echo e($r->id); ?>"> <?php echo e($r->display_name); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo e(!empty($model->id) ? '修 改' :'保 存'); ?> </button>
    </form>
</div></div>