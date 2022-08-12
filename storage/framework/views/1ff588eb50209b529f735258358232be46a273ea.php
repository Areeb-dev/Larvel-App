<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Invoices')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>

        $('.copy_link').click(function (e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('Success', 'Url copied to clipboard', 'success');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
        <div class="row d-flex justify-content-end">
          <div class="col-2">
            <?php if(!\Auth::guard('customer')->check()): ?>
                <?php echo e(Form::open(array('route' => array('invoice.index'),'method' => 'GET','id'=>'customer_submit'))); ?>

            <?php else: ?>
                <?php echo e(Form::open(array('route' => array('customer.invoice'),'method' => 'GET','id'=>'customer_submit'))); ?>

            <?php endif; ?>
          </div>
          <div class="col-2">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('issue_date', __('Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::text('issue_date', isset($_GET['issue_date'])?$_GET['issue_date']:null, array('class' => 'form-control month-btn datepicker-range'))); ?>

                </div>
            </div>
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
                      <?php echo e(Form::label('status', __('Status'),['class'=>'text-type'])); ?>

                      <?php echo e(Form::select('status', [''=>'All']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select2'))); ?>

                  </div>
              </div>
          </div>
          <div class="col-auto my-custom">
              <a href="#" class="apply-btn" onclick="document.getElementById('customer_submit').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                  <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
              </a>
              <?php if(!\Auth::guard('customer')->check()): ?>
                  <a href="<?php echo e(route('invoice.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                      <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                  </a>
              <?php else: ?>
                  <a href="<?php echo e(route('customer.index')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                      <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                  </a>
              <?php endif; ?>
          </div>
          <?php echo e(Form::close()); ?>

          <div class="col-2 my-custom-btn">
              <div class="all-button-box">
                  <a href="<?php echo e(route('invoice.create',0)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                      <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                  </a>
              </div>
          </div>
      </div>
    <?php endif; ?>
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
                                <th> <?php echo e(__('Invoice')); ?></th>
                                <?php if(!\Auth::guard('customer')->check()): ?>
                                    <th><?php echo e(__('Customer')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Issue Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Due Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">
                                        <?php if(\Auth::guard('customer')->check()): ?>
                                            <a href="<?php echo e(route('customer.invoice.show',\Crypt::encrypt($invoice->id))); ?>"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($invoice->id))); ?>"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(!\Auth::guard('customer')->check()): ?>
                                        <td> <?php echo e(!empty($invoice->customer)? $invoice->customer->name:''); ?> </td>
                                    <?php endif; ?>
                                    <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                    <td>
                                        <?php if(($invoice->due_date < date('Y-m-d'))): ?>
                                            <p class="text-danger"> <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?></p>
                                        <?php else: ?>
                                            <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                    <td>
                                        <?php if($invoice->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                        <td class="Action">
                                          <span><?php $invoiceID= Crypt::encrypt($invoice->id); ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('copy invoice')): ?>
                                            <a href="<?php echo e(route('invoice.link.copy',[$invoiceID])); ?>" class="edit-icon bg-info copy_link" data-toggle="tooltip" data-original-title="<?php echo e(__('Click to copy')); ?>"><i class="fas fa-link"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate invoice')): ?>
                                                    <a href="#" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($invoice->id); ?>').submit();">
                                                    <i class="fas fa-copy"></i>
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id],'id'=>'duplicate-form-'.$invoice->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>
                                                    <?php if(\Auth::guard('customer')->check()): ?>

                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($invoice->id))); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                    <a href="<?php echo e(route('invoice.edit',Crypt::encrypt($invoice->id))); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($invoice->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id],'id'=>'delete-form-'.$invoice->id]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/invoice/index.blade.php ENDPATH**/ ?>