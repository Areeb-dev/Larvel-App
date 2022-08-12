<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'deals'))); ?>

    <?php if(!$customFields->isEmpty()): ?>
      <ul class="nav nav-tabs my-3" role="tablist">
            <li>
                <a class="active" data-toggle="tab" href="#tab-1" role="tab" aria-selected="true"><?php echo e(__('Deal Detail')); ?></a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab-2" role="tab" aria-selected="true"><?php echo e(__('Custom Fields')); ?></a>
            </li>
      </ul>
      <?php endif; ?>
    <div class="tab-content tab-bordered">
        <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
            <div class="row">
                <div class="col-6 form-group">
                    <?php echo e(Form::label('name', __('Deal Name'),['class'=>'form-control-label'])); ?>

                    <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

                </div>
                <div class="col-6 form-group">
                    <?php echo e(Form::label('price', __('Price'),['class'=>'form-control-label'])); ?>

                    <?php echo e(Form::number('price', 0, array('class' => 'form-control','min'=>0))); ?>

                </div>
                <div class="col-12 form-group">
                    <?php echo e(Form::label('company_id', __('Clients'),['class'=>'form-control-label'])); ?>

                    <?php echo e(Form::select('clients[]', $clients,null, array('class' => 'form-control select2','multiple'=>'','required'=>'required'))); ?>

                    <?php if(count($clients) <= 0 && Auth::user()->type == 'Owner'): ?>
                        <div class="text-muted text-xs">
                            <?php echo e(__('Please create new clients')); ?> <a href="<?php echo e(route('clients.index')); ?>"><?php echo e(__('here')); ?></a>.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if(!$customFields->isEmpty()): ?>
            <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                <div class="row">
                    <?php echo $__env->make('custom_fields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-12 text-right">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/deals/create.blade.php ENDPATH**/ ?>