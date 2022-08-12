<div class="card bg-none card-box">

<?php echo e(Form::open(array('url' => 'contractType'))); ?>

<div class="form-group">
    <?php echo e(Form::label('name', __('Name'))); ?>

    <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

</div>
    <div class="col-12 text-right">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
    </div>

<?php echo e(Form::close()); ?>

</div>

<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/contractType/create.blade.php ENDPATH**/ ?>