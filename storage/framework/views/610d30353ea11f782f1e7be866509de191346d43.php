<?php $__env->startSection('content'); ?>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><input onclick="selallck(this)" type="checkbox" id="selectBtn" style="cursor:pointer;"></th>
                <th>用户名</th>
                <th>真实姓名</th>
                <th>是否超级管理员</th>
                <th>角色</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!$data->isEmpty()): ?>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="item_<?php echo e($item->id); ?>">
                        <?php if(!$item->is_super): ?>
                            <td><input type="checkbox" name="id[]" value="<?php echo e($item->id); ?>"></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo e($item->username); ?></td>
                        <td><?php echo e(isset($item->profile->realname) ? $item->profile->realname : '--'); ?></td>
                        <td><?php echo $item->is_super == 1 ?
                         '<span class="label label-danger">是</span>' :
                          '<span class="label label-default">否</span>'; ?></td>
                        <td>
                            <?php if($item->roles()->count()): ?>
                                <?php $__currentLoopData = $item->roles()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="label label-info "><?php echo e($role->display_name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span class="label label-info">无</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->created_at); ?></td>
                        <td>
                            <div class="btn-group">
                                <?php if(!$item->is_super): ?>
                                    <a class="btn btn-default"
                                       href="<?php echo e(url('/admin/'.$siteClass.'/'.$item->id.'/edit')); ?>"><span
                                                class="fa fa-edit"> 编辑</span></a>
                                    <a class="btn btn-default" href="javascript:;"
                                       onclick="del('<?php echo e($item->id); ?>')"><span class="fa fa-remove"> 删除</span> </a>
                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="20">暂时没有任何数据。。</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

    </div>
    </div>
    <div style="padding:0 5px; height:70px; border-radius: 5px;" class="">
        <?php if(!$data->isEmpty()): ?>
            <div class="btn btn-primary" style="float:left;width:100px;margin-top:15px;" onclick="del_batch()"><span
                        class="fa fa-trash-o "> 批量删除</span></div>
        <?php endif; ?>
        <ul class="pagination" style="float:right; margin-top:0px;">
            <?php echo $data->links(); ?>

        </ul>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>