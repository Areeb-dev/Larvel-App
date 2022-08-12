<div class="card bg-none card-box">
    <?php echo e(Form::model($employee, array('route' => array('employee.salary.update', $employee->id), 'method' => 'POST'))); ?>

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('salary_type', __('Payslip Type'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('salary_type',$payslip_type,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('salary', __('Salary'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::number('salary',null, array('class' => 'form-control ','required'=>'required'))); ?>

        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Save Change')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/setsalary/basic_salary.blade.php ENDPATH**/ ?>