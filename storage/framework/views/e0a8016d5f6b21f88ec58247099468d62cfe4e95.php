<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manege Bills')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
  <div class="row d-flex justify-content-end">
    <div class="col-auto">
      <?php if(!\Auth::guard('vender')->check()): ?>
          <?php echo e(Form::open(array('route' => array('bill.index'),'method' => 'GET','id'=>'frm_submit'))); ?>

      <?php else: ?>
          <?php echo e(Form::open(array('route' => array('vender.bill'),'method' => 'GET','id'=>'frm_submit'))); ?>

      <?php endif; ?>
    </div>
    <div class="col-auto">
      <div class="all-select-box">
          <div class="btn-box">
              <?php echo e(Form::label('bill_date', __('Date'),['class'=>'text-type'])); ?>

              <?php echo e(Form::text('bill_date', isset($_GET['bill_date'])?$_GET['bill_date']:null, array('class' => 'month-btn form-control datepicker-range'))); ?>

          </div>
      </div>
    </div>
    <?php if(!\Auth::guard('vender')->check()): ?>
    <div class="col-auto">
      <div class="all-select-box">
          <div class="btn-box">
              <?php echo e(Form::label('vender', __('Vender'),['class'=>'text-type'])); ?>

              <?php echo e(Form::select('vender',$vender,isset($_GET['vender'])?$_GET['vender']:'', array('class' => 'form-control select2'))); ?>

          </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="col-auto">
        <div class="all-select-box">
            <div class="btn-box">
                <?php echo e(Form::label('status', __('Status'),['class'=>'text-type'])); ?>

                <?php echo e(Form::select('status', [''=>'All'] + $status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select2'))); ?>

            </div>
        </div>
    </div>
    <div class="col-auto my-custom">
        <a href="#" class="apply-btn" onclick="document.getElementById('frm_submit').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
        </a>
        <?php if(!\Auth::guard('vender')->check()): ?>
            <a href="<?php echo e(route('bill.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('vender.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
        <?php endif; ?>
    </div>
    <div class="col-auto">
      <?php echo e(Form::close()); ?>

    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bill')): ?>
        <div class="col-2 my-custom-btn">
            <div class="all-button-box">
                <a href="<?php echo e(route('bill.create',0)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

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
                <div class="card-body py-0 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Bill')); ?></th>
                                <?php if(!\Auth::guard('vender')->check()): ?>
                                    <th> <?php echo e(__('Vendor')); ?></th>
                                <?php endif; ?>
                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Bill Date')); ?></th>
                                <th> <?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit bill') || Gate::check('delete bill') || Gate::check('show bill')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">
                                        <?php if(\Auth::guard('vender')->check()): ?>
                                            <a href="<?php echo e(route('vender.bill.show',\Crypt::encrypt($bill->id))); ?>"><?php echo e(AUth::user()->billNumberFormat($bill->bill_id)); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('bill.show',\Crypt::encrypt($bill->id))); ?>"><?php echo e(AUth::user()->billNumberFormat($bill->bill_id)); ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(!\Auth::guard('vender')->check()): ?>
                                        <td> <?php echo e((!empty( $bill->vender)?$bill->vender->name:'')); ?> </td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($bill->category)?$bill->category->name:''); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($bill->bill_date)); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($bill->due_date)); ?></td>
                                    <td>
                                        <?php if($bill->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit bill') || Gate::check('delete bill') || Gate::check('show bill')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate bill')): ?>
                                                    <a href="#" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($bill->id); ?>').submit();">
                                                    <i class="fas fa-copy"></i>
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['bill.duplicate', $bill->id],'id'=>'duplicate-form-'.$bill->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show bill')): ?>
                                                    <?php if(\Auth::guard('vender')->check()): ?>
                                                        <a href="<?php echo e(route('vender.bill.show',\Crypt::encrypt($bill->id))); ?>" class="edit-icon bg-warning" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('bill.show',\Crypt::encrypt($bill->id))); ?>" class="edit-icon bg-warning" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit bill')): ?>
                                                    <a href="<?php echo e(route('bill.edit',\Crypt::encrypt($bill->id))); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete bill')): ?>
                                                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($bill->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['bill.destroy', $bill->id],'id'=>'delete-form-'.$bill->id]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/bill/index.blade.php ENDPATH**/ ?>