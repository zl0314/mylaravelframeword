<div class="panel-body">
    <form action="/admin/<?php echo e($siteClass); ?><?php echo e(!empty($model->id)?'/'.$model->id:''); ?>" method="post">
        <?php echo e(csrf_field()); ?>


        <?php if($siteMethod == 'edit'): ?> <?php echo e(method_field('PUT')); ?> <?php endif; ?>

        <div class="form-group">
            <label for="">所属菜单</label>
            <select name="fid" id="" class="form-control">
                <option value="0">无</option>
                <?php $__currentLoopData = \App\Model\Permissions::treePermisstionsByLevel(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>)
                <option <?php if(!empty($model) && $model->fid == $r['id']): ?> selected <?php endif; ?> value="<?php echo e($r['id']); ?>"><?php if($r['fid'] != 0): ?> <?php echo e(str_repeat('&nbsp;', $r['level'] * 2)); ?>

                    |_ <?php endif; ?> <?php echo e($r['display_name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="">权限名</label>
            <input type="text" placeholder="如：admin_user" class="form-control" value="<?php echo e($model->name??old('name')); ?>"
                   name="name">
        </div>
        <div class="form-group">
            <label for="">显示名</label>
            <input type="text" class="form-control" placeholder="如：测试组"
                   value="<?php echo e($model->display_name??old('display_name')); ?>"
                   name="display_name">
        </div>

        <div class="form-group">
            <label for="">描述</label>
            <textarea class="form-control" name="description" id="" cols="30"
                      rows="10"><?php echo e($model->description??old('description')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="">是否菜单</label>
            <select name="is_menu" id="" class="form-control">
                <option value="1" <?php if(!empty($model->is_menu) && $model->is_menu == 1): ?> selected <?php endif; ?>>是</option>
                <option value="0" <?php if(isset($model->is_menu) && $model->is_menu == 0): ?> selected <?php endif; ?> >否</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">排序</label>
            <input type="text" class="form-control" placeholder=""
                   value="<?php echo e($model->sort??old('sort')??1); ?>"
                   name="sort">
        </div>

        <button type="submit" class="btn btn-primary"><?php echo e(!empty($model->id) ? '修 改' :'保 存'); ?> </button>
    </form>
</div></div>