<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'bank-account'))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('holder_name', __('Bank Holder Name'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-address-card"></i></span>
                <?php echo e(Form::text('holder_name', '', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('bank_name', __('Bank Name'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-university"></i></span>
                <?php echo e(Form::text('bank_name', '', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('account_number', __('Account Number'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-notes-medical"></i></span>
                <?php echo e(Form::text('account_number', '', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('opening_balance', __('Opening Balance'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-dollar-sign"></i></span>
                <?php echo e(Form::number('opening_balance', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('contact_number', __('Contact Number'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-mobile-alt"></i></span>
                <?php echo e(Form::text('contact_number', '', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('bank_address', __('Bank Address'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('bank_address', '', array('class' => 'form-control','rows'=>3,'required'=>'required'))); ?>

        </div>
        <?php if(!$customFields->isEmpty()): ?>
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/bankAccount/create.blade.php ENDPATH**/ ?>