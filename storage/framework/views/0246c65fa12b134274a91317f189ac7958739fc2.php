<?php $__env->startSection('content'); ?>

    <form action="/admin/roles/permission/<?php echo e($role->id); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <?php $__currentLoopData = \App\Model\Permissions::treePermisstionsBySubMenus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="panel panel-primary" id="top_menu<?php echo e($r['id']); ?>">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="checkbox">
                            <label for="menu<?php echo e($r['id']); ?>">
                                <input
                                        <?php if(!empty($role->id) && in_array($r['id'], array_column($role->permissions()->get()->toArray(), 'id') )  ): ?> checked
                                        <?php endif; ?>
                                        onclick="checkPermission(this)" type="checkbox" id="menu<?php echo e($r['id']); ?>"
                                       name="permission[<?php echo e($r['id']); ?>]" value="<?php echo e($r['id']); ?>"
                                       style="width:20px;height:20px;margin-top:0px;">
                                【<?php echo e($r['display_name']); ?>】权限
                            </label>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php if(!empty($r['submenu'] )): ?>
                        <?php $__currentLoopData = $r['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="panel panel-default" id="top_menu<?php echo e($submenu['id']); ?>">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <div class="checkbox">
                                            <label for="menu<?php echo e($submenu['id']); ?>">
                                                <input parent="<?php echo e($submenu['parent']['id']); ?>"
                                                       <?php if(!empty($role->id) && in_array($submenu['id'], array_column($role->permissions()->get()->toArray(), 'id') )  ): ?> checked
                                                       <?php endif; ?>
                                                       onclick="checkPermission(this)"
                                                       type="checkbox"
                                                       id="menu<?php echo e($submenu['id']); ?>"
                                                       name="permission[<?php echo e($submenu['id']); ?>]" value="<?php echo e($submenu['id']); ?>"
                                                       style="width:20px;height:20px;margin-top:0px;">
                                                【<?php echo e($submenu['display_name']); ?>】权限
                                            </label>
                                        </div>
                                    </h3>
                                </div>
                                <div class="panel-body" id="top_menu<?php echo e($submenu['id']); ?>_child">
                                    <table class="table">
                                        <?php if(!empty($submenu['submenu'] )): ?>
                                            <?php $__currentLoopData = $submenu['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="top_menu<?php echo e($submenu_2['id']); ?>">
                                                    <td style="width:190px;">
                                                        <div class="checkbox">
                                                            <label for="menu<?php echo e($submenu_2['id']); ?>">

                                                                <input parent="<?php echo e(isset($submenu_2['second_parent']) ? $submenu_2['second_parent'] : ''); ?>"
                                                                       onclick="checkPermission(this)" type="checkbox"
                                                                       <?php if(!empty($role->id) && in_array($submenu_2['id'], array_column($role->permissions()->get()->toArray(), 'id') )  ): ?> checked
                                                                       <?php endif; ?>
                                                                       name="permission[<?php echo e($submenu_2['id']); ?>]"
                                                                       id="menu<?php echo e($submenu_2['id']); ?>"
                                                                       value="<?php echo e($submenu_2['id']); ?>">

                                                                <?php echo e($submenu_2['display_name']); ?>

                                                            </label>
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <div class="checkbox">
                                                            <?php $__currentLoopData = \App\Model\Permissions::where(['fid' => $submenu_2['id']])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu_3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <label for="menu<?php echo e($submenu_3->id); ?>">
                                                                    <input parent="<?php echo e($submenu_3->fid); ?>"
                                                                           <?php if(!empty($role->id) && in_array($submenu_3->id, array_column($role->permissions()->get()->toArray(), 'id') )  ): ?> checked
                                                                           <?php endif; ?>
                                                                           onclick="selectParent(this)" type="checkbox"
                                                                           id="menu<?php echo e($submenu_3->id); ?>"
                                                                           name="permission[<?php echo e($submenu_3->id); ?>]"
                                                                           value="<?php echo e($submenu_3->id); ?>"> <?php echo e($submenu_3->display_name); ?>

                                                                </label>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <input type="submit" value="保 存" class="btn btn-primary btn-lg">
    </form>
    <script>
        function checkPermission(o) {
            var parent = $(o).attr('parent');
            var cl = 0;


            if ($(o).prop('checked')) {
                $('#top_menu' + $(o).val()).find('input[type="checkbox"]').prop('checked', true);
            } else {
                $('#top_menu' + $(o).val()).find('input[type="checkbox"]').prop('checked', false);
            }

            $('#top_menu' + parent + '_child').find('input[type="checkbox"]').each(function () {
                if ($(this).prop('checked')) {
                    cl++
                }
            });

            if (cl >= 1) {
                selecttop(true, parent);
            } else {
                selecttop(false, parent);
            }
        }

        function selectParent(o) {
            var cl = 0;
            $(o).parent().parent().find('input[type="checkbox"]').each(function () {
                if ($(this).prop('checked')) {
                    cl++
                }
            });
            var parent = $(o).attr('parent');
            if (cl >= 1) {
                selecttop(true, parent);
            } else {
                selecttop(false, parent);
            }
        }

        function selecttop(isc, parent) {
            $('#menu' + parent).prop('checked', isc);

            //父级的上级选中
            var p_2 = $('#menu' + parent).attr('parent');
            $('#menu' + p_2).prop('checked', isc);
            //父级的上级 的上级选中
            var p_1 = $('#menu' + p_2).attr('parent');
            $('#menu' + p_1).prop('checked', isc);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>