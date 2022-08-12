<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'leads'))); ?>

    <div class="row">
        <div class="col-6 form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('subject', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('user_id', __('User'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select2','required'=>'required'))); ?>

            <?php if(count($users) == 1): ?>
                <div class="text-muted text-xs">
                    <?php echo e(__('Please create new users')); ?> <a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('here')); ?></a>.
                </div>
            <?php endif; ?>
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('email', __('Email'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('email', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>

        <div class="col-12 text-right">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/leads/create.blade.php ENDPATH**/ ?>