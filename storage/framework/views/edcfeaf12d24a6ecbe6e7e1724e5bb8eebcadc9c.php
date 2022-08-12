<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bank Account')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bank account')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(route('bank-account.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Account')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Bank')); ?></th>
                                <th> <?php echo e(__('Account Number')); ?></th>
                                <th> <?php echo e(__('Current Balance')); ?></th>
                                <th> <?php echo e(__('Contact Number')); ?></th>
                                <th> <?php echo e(__('Bank Branch')); ?></th>
                                <?php if(Gate::check('edit bank account') || Gate::check('delete bank account')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($account->holder_name); ?></td>
                                    <td><?php echo e($account->bank_name); ?></td>
                                    <td><?php echo e($account->account_number); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($account->opening_balance)); ?></td>
                                    <td><?php echo e($account->contact_number); ?></td>
                                    <td><?php echo e($account->bank_address); ?></td>
                                    <?php if(Gate::check('edit bank account') || Gate::check('delete bank account')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if($account->holder_name!='Cash'): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit bank account')): ?>
                                                        <a href="#" class="edit-icon" data-url="<?php echo e(route('bank-account.edit',$account->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Account')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete bank account')): ?>
                                                        <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($account->id); ?>').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['bank-account.destroy', $account->id],'id'=>'delete-form-'.$account->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/bankAccount/index.blade.php ENDPATH**/ ?>