<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Proposals')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
  <div class="row d-flex justify-content-end mt-2">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create proposal')): ?>
        <div class="col-auto">
          <?php if(!\Auth::guard('customer')->check()): ?>
              <?php echo e(Form::open(array('route' => array('proposal.index'),'method' => 'GET','id'=>'frm_submit'))); ?>

          <?php else: ?>
              <?php echo e(Form::open(array('route' => array('customer.proposal'),'method' => 'GET','id'=>'frm_submit'))); ?>

          <?php endif; ?>
        </div>
        <?php if(!\Auth::guard('customer')->check()): ?>
            <div class="col-auto">
                <div class="all-select-box">
                    <div class="btn-box">
                        <?php echo e(Form::label('customer', __('Customer'),['class'=>'text-type'])); ?>

                        <?php echo e(Form::select('customer',$customer,isset($_GET['customer'])?$_GET['customer']:'', array('class' => 'form-control select2'))); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('issue_date', __('Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::text('issue_date', isset($_GET['issue_date'])?$_GET['issue_date']:null, array('class' => 'form-control datepicker-range month-btn'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('status', __('Status'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('status', [''=>'All']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('frm_submit').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <?php if(!\Auth::guard('customer')->check()): ?>
                <a href="<?php echo e(route('proposal.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('customer.proposal')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                </a>
            <?php endif; ?>
        </div>
        <div class="col-auto">
            <?php echo e(Form::close()); ?>

        </div>
        <div class="col-2 my-custom">
            <div class="all-button-box">
                <a href="<?php echo e(route('proposal.create',0)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        </div>

    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Proposal')); ?></th>
                                <?php if(!\Auth::guard('customer')->check()): ?>
                                    <th> <?php echo e(__('Customer')); ?></th>
                                <?php endif; ?>
                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Issue Date')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td class="Id">
                                        <?php if(\Auth::guard('customer')->check()): ?>
                                            <a href="<?php echo e(route('customer.proposal.show',\Crypt::encrypt($proposal->id))); ?>"><?php echo e(AUth::user()->proposalNumberFormat($proposal->proposal_id)); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('proposal.show',\Crypt::encrypt($proposal->id))); ?>"><?php echo e(AUth::user()->proposalNumberFormat($proposal->proposal_id)); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(!\Auth::guard('customer')->check()): ?>
                                        <td> <?php echo e(!empty($proposal->customer)? $proposal->customer->name:''); ?> </td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($proposal->category)?$proposal->category->name:''); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($proposal->issue_date)); ?></td>
                                    <td>
                                        <?php if($proposal->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 1): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 2): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 3): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 4): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                        <td class="Action">
                                            <?php if($proposal->is_convert==0): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert invoice')): ?>
                                                    <a href="#" class="edit-icon bg-warning" data-toggle="tooltip" data-original-title="<?php echo e(__('Convert to Invoice')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm convert to invoice. Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('proposal-form-<?php echo e($proposal->id); ?>').submit();">
                                                        <i class="fas fa-exchange-alt"></i>
                                                        <?php echo Form::open(['method' => 'get', 'route' => ['proposal.convert', $proposal->id],'id'=>'proposal-form-'.$proposal->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert invoice')): ?>
                                                    <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($proposal->converted_invoice_id))); ?>" class="edit-icon bg-warning" data-toggle="tooltip" data-original-title="<?php echo e(__('Already convert to Invoice')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>">
                                                        <i class="fas fa-file"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate proposal')): ?>
                                                <a href="#" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm duplicate this invoice. Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($proposal->id); ?>').submit();">
                                                    <i class="fas fa-copy"></i>
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['proposal.duplicate', $proposal->id],'id'=>'duplicate-form-'.$proposal->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show proposal')): ?>
                                                <?php if(\Auth::guard('customer')->check()): ?>
                                                    <a href="<?php echo e(route('customer.proposal.show',\Crypt::encrypt($proposal->id))); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('proposal.show',\Crypt::encrypt($proposal->id))); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit proposal')): ?>
                                                <a href="<?php echo e(route('proposal.edit',\Crypt::encrypt($proposal->id))); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete proposal')): ?>
                                                <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($proposal->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['proposal.destroy', $proposal->id],'id'=>'delete-form-'.$proposal->id]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/proposal/index.blade.php ENDPATH**/ ?>