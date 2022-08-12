<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leads')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/libs/summernote/summernote-bs4.js')); ?>"></script>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("move lead")): ?>
        <?php if($pipeline): ?>
            <script src="<?php echo e(asset('assets/libs/dragula/dist/dragula.min.js')); ?>"></script>
            <script>
                !function (a) {
                    "use strict";
                    var t = function () {
                        this.$body = a("body")
                    };
                    t.prototype.init = function () {
                        a('[data-plugin="dragula"]').each(function () {
                            var t = a(this).data("containers"), n = [];
                            if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                            var r = a(this).data("handleclass");
                            r ? dragula(n, {
                                moves: function (a, t, n) {
                                    return n.classList.contains(r)
                                }
                            }) : dragula(n).on('drop', function (el, target, source, sibling) {

                                var order = [];
                                $("#" + target.id + " > div").each(function () {
                                    order[$(this).index()] = $(this).attr('data-id');
                                });

                                var id = $(el).attr('data-id');

                                var old_status = $("#" + source.id).data('status');
                                var new_status = $("#" + target.id).data('status');
                                var stage_id = $(target).attr('data-id');
                                var pipeline_id = '<?php echo e($pipeline->id); ?>';

                                $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                                $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);
                                $.ajax({
                                    url: '<?php echo e(route('leads.order')); ?>',
                                    type: 'POST',
                                    data: {lead_id: id, stage_id: stage_id, order: order, new_status: new_status, old_status: old_status, pipeline_id: pipeline_id, "_token": $('meta[name="csrf-token"]').attr('content')},
                                    success: function (data) {
                                    },
                                    error: function (data) {
                                        data = data.responseJSON;
                                        show_toastr('Error', data.error, 'error')
                                    }
                                });
                            });
                        })
                    }, a.Dragula = new t, a.Dragula.Constructor = t
                }(window.jQuery), function (a) {
                    "use strict";

                    a.Dragula.init()

                }(window.jQuery);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <script>
        $(document).on("change", "#change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <?php if($pipeline): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
                <div class="all-select-box">
                    <div class="btn-box">
                        <?php echo e(Form::open(array('route' => 'deals.change.pipeline','id'=>'change-pipeline','class'=>'mr-2'))); ?>

                        <?php echo e(Form::select('default_pipeline_id', $pipelines,$pipeline->id, array('class' => 'form-control select2','id'=>'default_pipeline_id'))); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create lead')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
                <div class="all-button-box">
                    <a href="#" data-url="<?php echo e(route('leads.create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Lead')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?> </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-button-box">
                <a href="<?php echo e(route('leads.list')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-list"></i> <?php echo e(__('List View')); ?> </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($pipeline): ?>
        <div class="row">
            <div class="col-12">
                <?php
                    $lead_stages = $pipeline->leadStages;
                    $json = [];
                    foreach ($lead_stages as $lead_stage){
                        $json[] = 'task-list-'.$lead_stage->id;
                    }
                ?>
                <div class="board" data-plugin="dragula" data-containers='<?php echo json_encode($json); ?>'>
                    <?php $__currentLoopData = $lead_stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($leads = $lead_stage->lead()); ?>
                        <div class="tasks mb-2">
                            <h5 class="mt-0 mb-0 task-header"><?php echo e($lead_stage->name); ?> (<span class="count"><?php echo e(count($leads)); ?></span>)</h5>
                            <div id="task-list-<?php echo e($lead_stage->id); ?>" data-id="<?php echo e($lead_stage->id); ?>" class="task-list-items for-leads">
                                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card mb-2 mt-0" data-id="<?php echo e($lead->id); ?>">
                                        <div class="card-body p-0 deal_title">
                                            <?php if(Auth::user()->type != 'Client'): ?>
                                                <div class="float-right">
                                                    <?php if(!$lead->is_active): ?>
                                                        <div class="dropdown global-icon lead-dropdown pr-1">
                                                            <a href="#" class="action-item" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-lock"></i></a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="dropdown global-icon lead-dropdown pr-1">
                                                            <a href="#" class="action-item" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
                                                                    <a href="#" data-url="<?php echo e(URL::to('leads/'.$lead->id.'/labels')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Labels')); ?>" class="dropdown-item"><?php echo e(__('Labels')); ?></a>
                                                                    <a href="#" data-url="<?php echo e(URL::to('leads/'.$lead->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Lead')); ?>" class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead')): ?>
                                                                    <a href="#" data-title="<?php echo e(__('Delete Lead')); ?>" class="dropdown-item" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($lead->id); ?>').submit();"><?php echo e(__('Delete')); ?></a>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]); ?>

                                                                    <?php echo Form::close(); ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="pl-2 pt-0 pr-2 pb-2">
                                                <?php ($labels = $lead->labels()); ?>
                                                <?php if($labels): ?>
                                                    <h6>
                                                        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span class="badge badge-pill badge-xs badge-<?php echo e($label->color); ?> mr-1" data-toggle="tooltip" data-original-title="<?php echo e($label->name); ?>"> </span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </h6>
                                                <?php endif; ?>
                                                <h5 class="mt-2 mb-4">
                                                    <a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view lead')): ?><?php if($lead->is_active): ?><?php echo e(route('leads.show',$lead->id)); ?><?php else: ?>#<?php endif; ?> <?php else: ?>#<?php endif; ?>" class="text-body"><?php echo e($lead->name); ?> <span class="deal_icon"><i class="fas fa-eye"></i></span></a>
                                                </h5>
                                                <p class="mb-0">
                                                    <?php $__currentLoopData = $lead->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                            <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> class="rounded-circle " width="25" height="25">
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/leads/index.blade.php ENDPATH**/ ?>