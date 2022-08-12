<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Clients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create client')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Client')); ?>" data-url="<?php echo e(route('clients.create')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?> </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row mt-0">
        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-sm-6 col-md-4">
                <div class="card profile-card">
                    <div class="edit-profile user-text">
                        <div class="dropdown action-item">
                            <?php if($client->is_active == 1): ?>
                                <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo e(route('clients.show',$client->id)); ?>" class="dropdown-item text-sm"><?php echo e(__('View')); ?></a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit client')): ?>
                                        <a href="#" class="dropdown-item text-sm" data-url="<?php echo e(route('clients.edit',$client->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Client')); ?>"><?php echo e(__('Edit')); ?></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete client')): ?>
                                        <a class="dropdown-item text-sm" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($client->id); ?>').submit();"><?php echo e(__('Delete')); ?></a>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['clients.destroy', $client->id],'id'=>'delete-form-'.$client->id]); ?>

                                        <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <a href="#" class="action-item"><i class="fas fa-lock"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="avatar-parent-child">
                        <img <?php if($client->avatar): ?> src="<?php echo e(asset(Storage::url("uploads/avatar/".$client->avatar))); ?>"  <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> class="avatar rounded-circle avatar-xl">
                    </div>
                    <h4 class="h4 mb-0 mt-2"><a href="<?php echo e(route('clients.show',$client->id)); ?>"><?php echo e($client->name); ?></a></h4>
                    <div class="sal-right-card">
                        <span class="badge badge-pill badge-blue"><?php echo e($client->email); ?></span>
                    </div>
                    <div class="office-time mb-0 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="font-weight-bold text-sm"><?php echo e(__('Deals')); ?></div>
                                <?php if($client->clientDeals): ?>
                                <?php echo e($client->clientDeals->count()); ?>

                                <?php endif; ?>
                            </div>
                            <!-- <div class="col-4">
                                <div class="font-weight-bold text-sm"><?php echo e(__('Invoices')); ?></div>
                                <?php if($client->getInvoiceCount): ?>
                                <?php echo e($client->getInvoiceCount($client->id)); ?>

                                <?php endif; ?>
                            </div> -->
                            <div class="col-6">
                                <div class="font-weight-bold text-sm"><?php echo e(__('Projects')); ?></div>
                                <?php if($client->clientProjects): ?>
                                <?php echo e($client->clientProjects->count()); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/clients/index.blade.php ENDPATH**/ ?>