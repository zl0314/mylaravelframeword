<?php if($siteMethod != 'permission'): ?>
    <?php echo $__env->make('layouts.admin.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>