<div class="panel-body">
    <form action="/admin/<?php echo e($siteClass); ?><?php echo e(!empty($model->id)?'/'.$model->id:''); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <?php if($siteMethod == 'edit'): ?> <?php echo e(method_field('PUT')); ?> <?php endif; ?>

        <div class="form-group">
            <label for="">说明</label>
            <input type="text" class="form-control" value="<?php echo e($model->intro??old('intro')); ?>" name="intro">
        </div>

        <div class="form-group">
            <label for="">关键字</label>
            <input type="text" class="form-control" value="<?php echo e($model->key??old('key')); ?>" name="key">
        </div>

        <div class="form-group">
            <label for="">值 </label>
            <textarea name="value" cols="30" rows="10" class="form-control"><?php echo e($model->value??old('value')); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <span class="fa fa-save"> <?php echo !empty($model->id) ? '修 改' :'保 存'; ?></span>
        </button>
    </form>
</div></div>