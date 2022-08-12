<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 "><?php echo e(__('Contract')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Contract')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="<?php echo e(route('contract.grid')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
            <span class="btn-inner--icon"><?php echo e(__('Grid View')); ?></span>
        </a>
        </div>


        <?php if(\Auth::user()->type=='company'): ?>

            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(route('contract.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Contract')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?> </a>
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
                    <th scope="col"><?php echo e(__('Subject')); ?></th>
                    <?php if(\Auth::user()->type!='client'): ?>
                        <th scope="col"><?php echo e(__('Client')); ?></th>
                    <?php endif; ?>
                    <th scope="col"><?php echo e(__('Contract Type')); ?></th>
                    <th scope="col"><?php echo e(__('Contract Value')); ?></th>
                    <th scope="col"><?php echo e(__('Start Date')); ?></th>
                    <th scope="col"><?php echo e(__('End Date')); ?></th>
                    <th scope="col"><?php echo e(__('Description')); ?></th>
                    <?php if(\Auth::user()->type=='company'): ?>
                        <th scope="col" class="text-right"><?php echo e(__('Action')); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody class="list">
                <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr class="font-style">
                        <td><?php echo e($contract->subject); ?></td>
                        <?php if(\Auth::user()->type!='client'): ?>
                            <td><?php echo e(!empty($contract->clients)?$contract->clients->name:''); ?></td>
                        <?php endif; ?>
                        <td><?php echo e(!empty($contract->types)?$contract->types->name:''); ?></td>
                        <td><?php echo e(\Auth::user()->priceFormat($contract->value)); ?></td>
                        <td><?php echo e(\Auth::user()->dateFormat($contract->start_date )); ?></td>
                        <td><?php echo e(\Auth::user()->dateFormat($contract->end_date )); ?></td>
                        <td>
                            <a href="#" class="action-item" data-url="<?php echo e(route('contract.description',$contract->id)); ?>" data-ajax-popup="true" data-toggle="tooltip" data-title="<?php echo e(__('Desciption')); ?>"><i class="fa fa-comment"></i></a>
                        </td>
                        <?php if(\Auth::user()->type=='company'): ?>
                            <td class="action text-right">
                                <a href="#" data-url="<?php echo e(route('contract.edit',$contract->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Contract')); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#!" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($contract->id); ?>').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id],'id'=>'delete-form-'.$contract->id]); ?>

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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/contract/index.blade.php ENDPATH**/ ?>