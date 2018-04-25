<div class="panel-body">
    <form action="/admin/<?php echo e($siteClass); ?><?php echo e(!empty($model->id)?'/'.$model->id:''); ?>" method="post">
        <?php echo e(csrf_field()); ?>


        <?php if($siteMethod == 'edit'): ?> <?php echo e(method_field('PUT')); ?> <?php endif; ?>
        <div class="form-group">
            <label for="">角色名</label>
            <input type="text" placeholder="test_group" class="form-control" value="<?php echo e($model->name??old('name')); ?>"
                   name="name">
        </div>
        <div class="form-group">
            <label for="">显示名</label>
            <input type="text" class="form-control" placeholder="如：测试组" value="<?php echo e($model->display_name??old('display_name')); ?>"
                   name="display_name">
        </div>

        <div class="form-group">
            <label for="">描述</label>
            <textarea class="form-control" name="description" id="" cols="30"
                      rows="10"><?php echo e($model->description??old('description')); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary"><?php echo e(!empty($model->id) ? '修 改' :'保 存'); ?> </button>
    </form>
</div></div>