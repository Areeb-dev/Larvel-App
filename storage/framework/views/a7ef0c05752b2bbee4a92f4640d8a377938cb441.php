<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract Type')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 "><?php echo e(__('Contract Type')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Constant')); ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Contract Type')); ?></li>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create label')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(route('contractType.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Contract Type')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?> </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center dataTable">
                <thead>
                <tr>
                    <th scope="col"><?php echo e(__('Name')); ?></th>
                    <?php if(\Auth::user()->type=='company'): ?>
                        <th scope="col" class=""><?php echo e(__('Action')); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody class="list">
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="font-style">
                        <td><?php echo e($type->name); ?></td>
                        <?php if(\Auth::user()->type=='company'): ?>
                            <td class="">
                                <a href="#" data-url="<?php echo e(route('contractType.edit',$type->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Contract Type')); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#!" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($type->id); ?>').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['contractType.destroy', $type->id],'id'=>'delete-form-'.$type->id]); ?>

                                <?php echo Form::close(); ?>

                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/contractType/index.blade.php ENDPATH**/ ?>