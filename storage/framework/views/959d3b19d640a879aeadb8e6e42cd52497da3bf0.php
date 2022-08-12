<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Customers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create customer')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-size="2xl" data-url="<?php echo e(route('customer.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Customer')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto commonModal">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Contact')); ?></th>
                                <th> <?php echo e(__('Email')); ?></th>
                                <th> <?php echo e(__('Balance')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="cust_tr" id="cust_detail" data-url="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" data-id="<?php echo e($customer['id']); ?>">
                                    <td class="Id">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>
                                            <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>">
                                                <?php echo e(AUth::user()->customerNumberFormat($customer['customer_id'])); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-outline-primary">
                                                <?php echo e(AUth::user()->customerNumberFormat($customer['customer_id'])); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="font-style"><?php echo e($customer['name']); ?></td>
                                    <td><?php echo e($customer['contact']); ?></td>
                                    <td><?php echo e($customer['email']); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($customer['balance'])); ?></td>
                                    <td class="Action">
                                        <span>
                                        <?php if($customer['is_active']==0): ?>
                                                <i class="fa fa-lock" title="Inactive"></i>
                                            <?php else: ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>
                                                    <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit customer')): ?>
                                                    <a href="#" class="edit-icon" data-size="2xl" data-url="<?php echo e(route('customer.edit',$customer['id'])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Customer')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete customer')): ?>
                                                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($customer['id']); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $customer['id']],'id'=>'delete-form-'.$customer['id']]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </span>
                                    </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/customer/index.blade.php ENDPATH**/ ?>