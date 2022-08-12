<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'payment'))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-calendar"></i></span>
                <?php echo e(Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                <?php echo e(Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="input-group">
                <?php echo e(Form::label('account_id', __('Account'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('account_id',$accounts,null, array('class' => 'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="input-group">
                <?php echo e(Form::label('vender_id', __('Vendor'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('vender_id', $venders,null, array('class' => 'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3))); ?>

        </div>
        <div class="form-group col-md-6">
            <div class="input-group">
                <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('category_id', $categories,null, array('class' => 'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-sticky-note"></i></span>
                <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/payment/create.blade.php ENDPATH**/ ?>