<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Payments')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
<div class="row d-flex justify-content-end">
  <div class="col-auto">
    <?php echo e(Form::open(array('route' => array('payment.index'),'method' => 'GET','id'=>'payment_form'))); ?>

  </div>
  <div class="col-auto">
      <div class="all-select-box">
          <div class="btn-box">
              <?php echo e(Form::label('date', __('Date'),['class'=>'text-type'])); ?>

              <?php echo e(Form::text('date', isset($_GET['date'])?$_GET['date']:null, array('class' => 'form-control month-btn datepicker-range'))); ?>

          </div>
      </div>
  </div>
  <div class="col-auto">
      <div class="all-select-box">
          <div class="btn-box">
              <?php echo e(Form::label('account', __('Account'),['class'=>'text-type'])); ?>

              <?php echo e(Form::select('account',$account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2'))); ?>

          </div>
      </div>
  </div>
  <div class="col-auto">
      <div class="all-select-box">
          <div class="btn-box">
              <?php echo e(Form::label('vender', __('Vendor'),['class'=>'text-type'])); ?>

              <?php echo e(Form::select('vender',$vender,isset($_GET['vender'])?$_GET['vender']:'', array('class' => 'form-control select2'))); ?>

          </div>
      </div>
  </div>
  <div class="col-auto">
      <div class="all-select-box">
          <div class="btn-box">
              <?php echo e(Form::label('category', __('Category'),['class'=>'text-type'])); ?>

              <?php echo e(Form::select('category',$category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select2'))); ?>

          </div>
      </div>
  </div>
  <div class="col-auto">
    <?php echo e(Form::close()); ?>

  </div>
  <div class="col-auto my-custom-btn">
      <a href="#" class="apply-btn" onclick="document.getElementById('payment_form').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
          <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
      </a>
      <a href="<?php echo e(route('payment.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
          <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
      </a>
  </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create payment')): ?>
        <div class="col-2 my-custom-btn">
            <div class="all-button-box">
                <a href="#" data-url="<?php echo e(route('payment.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Payment')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-0 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Account')); ?></th>
                                <th><?php echo e(__('Vendor')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Reference')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('edit payment') || Gate::check('delete payment')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e(Auth::user()->dateFormat($payment->date)); ?></td>
                                    <td><?php echo e(Auth::user()->priceFormat($payment->amount)); ?></td>
                                    <td><?php echo e(!empty($payment->bankAccount)?$payment->bankAccount->bank_name.' '.$payment->bankAccount->holder_name:''); ?></td>
                                    <td><?php echo e(!empty($payment->vender)?$payment->vender->name:'-'); ?></td>
                                    <td><?php echo e(!empty($payment->category)?$payment->category->name:'-'); ?></td>
                                    <td><?php echo e(!empty($payment->reference)?$payment->reference:'-'); ?></td>
                                    <td><?php echo e(!empty($payment->description)?$payment->description:'-'); ?></td>
                                    <?php if(Gate::check('edit revenue') || Gate::check('delete revenue')): ?>
                                        <td class="action text-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit payment')): ?>
                                                <a href="#" class="edit-icon" data-url="<?php echo e(route('payment.edit',$payment->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Payment')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete payment')): ?>
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($payment->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['payment.destroy', $payment->id],'id'=>'delete-form-'.$payment->id]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/payment/index.blade.php ENDPATH**/ ?>