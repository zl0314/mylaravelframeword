<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.'.$siteClass.'.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>