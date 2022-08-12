<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Lead Stages')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/libs/jquery-ui/jquery-ui.js')); ?>"></script>
    <script>
        $(function () {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
            $(".sortable").sortable({
                stop: function () {
                    var order = [];
                    $(this).find('li').each(function (index, data) {
                        order[index] = $(data).attr('data-id');
                    });

                    $.ajax({
                        url: "<?php echo e(route('lead_stages.order')); ?>",
                        data: {order: order, _token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        success: function (data) {
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('Error', data.error, 'error')
                        }
                    })
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create lead stage')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(route('lead_stages.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Lead Stage')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?> </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs my-3">
                <?php ($i=0); ?>
                <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item ml-0 mr-0">
                        <a class="<?php if($i==0): ?> active <?php endif; ?>" data-toggle="tab" href="#tab<?php echo e($key); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e($pipeline['name']); ?></a>
                    </li>
                    <?php ($i++); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content tab-bordered">
                        <?php ($i=0); ?>
                        <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade show <?php if($i==0): ?> active <?php endif; ?>" id="tab<?php echo e($key); ?>" role="tabpanel">
                                <ul class="list-group sortable">
                                    <?php $__currentLoopData = $pipeline['lead_stages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_stages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item" data-id="<?php echo e($lead_stages->id); ?>">
                                            <span class="text-xs text-dark"><?php echo e($lead_stages->name); ?></span>
                                            <span class="float-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead stage')): ?>
                                                    <a href="#" data-url="<?php echo e(URL::to('lead_stages/'.$lead_stages->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Lead Stages')); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if(count($pipeline['lead_stages'])): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead stage')): ?>
                                                        <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($lead_stages->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead_stages.destroy', $lead_stages->id],'id'=>'delete-form-'.$lead_stages->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php ($i++); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="text-muted mt-4"><strong><?php echo e(__('Note')); ?> : </strong><?php echo e(__('You can easily change order of lead stage using drag & drop.')); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/lead_stages/index.blade.php ENDPATH**/ ?>