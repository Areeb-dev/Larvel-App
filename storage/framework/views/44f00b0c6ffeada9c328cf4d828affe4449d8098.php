<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Bank Balance Transfer')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
<div class="row d-flex justify-content-end mt-2">
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create transfer')): ?>
    <div class="col-auto">
      <?php echo e(Form::open(array('route' => array('bank-transfer.index'),'method' => 'GET','id'=>'transfer_form'))); ?>

    </div>
    <div class="col-auto">
      <div class="btn-box">
          <?php echo e(Form::label('date', __('Date'),['class'=>'text-type'])); ?>

          <?php echo e(Form::text('date', isset($_GET['date'])?$_GET['date']:'', array('class' => 'form-control month-btn datepicker-range'))); ?>

      </div>
    </div>
    <div class="col-auto">
      <div class="btn-box">
          <?php echo e(Form::label('f_account', __('From Account'),['class'=>'text-type'])); ?>

          <?php echo e(Form::select('f_account',$account,isset($_GET['f_account'])?$_GET['f_account']:'', array('class' => 'form-control select2'))); ?>

      </div>
    </div>
    <div class="col-auto">
      <div class="btn-box">
          <?php echo e(Form::label('t_account', __('To Account'),['class'=>'text-type'])); ?>

          <?php echo e(Form::select('t_account', $account,isset($_GET['t_account'])?$_GET['t_account']:'', array('class' => 'form-control select2'))); ?>

      </div>
    </div>
    <div class="col-auto my-custom">
          <a href="#" class="apply-btn" onclick="document.getElementById('bank-transfer_form').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
              <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
          </a>
          <a href="<?php echo e(route('bank-transfer.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
              <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
          </a>
    </div>
    <div class="col-2 my-custom-btn">
        <div class="all-button-box">
            <a href="#" data-url="<?php echo e(route('bank-transfer.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Transfer Amount')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

            </a>
        </div>
    </div>
      <?php echo e(Form::close()); ?>

<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Date')); ?></th>
                                <th> <?php echo e(__('From Account')); ?></th>
                                <th> <?php echo e(__('To Account')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Reference')); ?></th>
                                <th> <?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('edit transfer') || Gate::check('delete transfer')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e(\Auth::user()->dateFormat( $transfer->date)); ?></td>
                                    <td><?php echo e(!empty($transfer->fromBankAccount())? $transfer->fromBankAccount()->bank_name.' '.$transfer->fromBankAccount()->holder_name:''); ?></td>
                                    <td><?php echo e(!empty( $transfer->toBankAccount())? $transfer->toBankAccount()->bank_name.' '. $transfer->toBankAccount()->holder_name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat( $transfer->amount)); ?></td>
                                    <td><?php echo e($transfer->reference); ?></td>
                                    <td><?php echo e($transfer->description); ?></td>
                                    <?php if(Gate::check('edit transfer') || Gate::check('delete transfer')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit transfer')): ?>
                                                    <a href="#" class="edit-icon" data-url="<?php echo e(route('bank-transfer.edit',$transfer->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Transfer Amount')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete transfer')): ?>
                                                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($transfer->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['transfer.destroy', $transfer->id],'id'=>'delete-form-'.$transfer->id]); ?>

                                                    <?php echo Form::close(); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/bank-transfer/index.blade.php ENDPATH**/ ?>