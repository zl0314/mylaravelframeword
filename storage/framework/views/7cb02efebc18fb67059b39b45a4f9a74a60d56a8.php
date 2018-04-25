<div class="search_wrap" style="margin-bottom:10px;">
    <form action="" method="get">
        <table class="search_tab">
            <?php echo $__env->yieldContent('searchForm'); ?>
        </table>
    </form>
</div>
<!-- TAB NAVIGATION -->
<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 10px;">
    <li <?php if($siteMethod == 'index'): ?> class="active" <?php endif; ?> >
        <a style="cursor: pointer;" class="" href="<?php echo e(url('admin/'.$siteClass )); ?><?php echo e(isset($params) ? $params : ''); ?>"> <span
                    class="fa fa-th-list"></span> <?php echo e($here); ?>列表</a>
    </li>
    <?php if(empty($dontNeedAdd)): ?>
        <li <?php if($siteMethod == 'create' || $siteMethod == 'edit'): ?> class="active" <?php endif; ?> >
            <?php if($siteMethod == 'index' || $siteMethod == 'create'): ?>
                <a style="cursor: pointer;" href="<?php echo e(url('admin/'.$siteClass.'/create')); ?><?php echo e(isset($params) ? $params : ''); ?>">
                    <span class="fa fa-plus-circle"></span> <?php echo e($here); ?>添加
                </a>
            <?php else: ?>
                <a href="javascript:;"><span class="fa fa-edit"></span> <?php echo e($here); ?>编辑</a>
            <?php endif; ?>
        </li>
    <?php endif; ?>
</ul>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo e($here); ?>管理</h3>
    </div>

