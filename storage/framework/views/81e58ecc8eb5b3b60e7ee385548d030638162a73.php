<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Deals')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/libs/summernote/summernote-bs4.js')); ?>"></script>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("move deal")): ?>
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
                                    url: '<?php echo e(route('deals.order')); ?>',
                                    type: 'POST',
                                    data: {deal_id: id, stage_id: stage_id, order: order, new_status: new_status, old_status: old_status, pipeline_id: pipeline_id, "_token": $('meta[name="csrf-token"]').attr('content')},
                                    success: function (data) {
                                        // console.log(data);
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
        })
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create deal')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
                <div class="all-button-box">
                    <a href="#" data-url="<?php echo e(route('deals.create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Deal')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?></a>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-button-box">
                <a href="<?php echo e(route('deals.list')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-list"></i> <?php echo e(__('List View')); ?> </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($pipeline): ?>
        <div class="row">
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Deals')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e($cnt_deal['total']); ?></h5>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('This Month Total Deals')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e($cnt_deal['this_month']); ?></h5>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('This Week Total Deals')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e($cnt_deal['this_week']); ?></h5>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Last 30 Days Total Deals')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e($cnt_deal['last_30days']); ?></h5>
                </div>
            </div>
        </div>

        <div class="">
            <div class="col-12">
                <?php
                    $stages = $pipeline->stages;

                    $json = [];
                    foreach ($stages as $stage){
                        $json[] = 'task-list-'.$stage->id;
                    }
                ?>
                <div class="board" data-plugin="dragula" data-containers='<?php echo json_encode($json); ?>'>

                    <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php ($deals = $stage->deals()); ?>

                        <div class="tasks mb-2">
                            <h5 class="mt-0 mb-0 task-header"><?php echo e($stage->name); ?> (<span class="count"><?php echo e(count($deals)); ?></span>)</h5>
                            <div id="task-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>" class="task-list-items">
                                <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card mb-2 mt-0" data-id="<?php echo e($deal->id); ?>">
                                        <div class="card-body p-0 deal_title">
                                            <?php if(Auth::user()->type != 'Client'): ?>
                                                <div class="float-right">
                                                    <?php if(!$deal->is_active): ?>
                                                        <div class="dropdown">
                                                            <a href="#" class="action-item" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-lock"></i></a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="dropdown global-icon pr-1">
                                                            <a href="#" class="action-item" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                                    <a href="#" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/labels')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Labels')); ?>" class="dropdown-item"><?php echo e(__('Labels')); ?></a>
                                                                    <a href="#" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Deal')); ?>" class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete deal')): ?>
                                                                    <a href="#" data-title="<?php echo e(__('Delete Deal')); ?>" class="dropdown-item" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($deal->id); ?>').submit();"><?php echo e(__('Delete')); ?></a>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.destroy', $deal->id],'id'=>'delete-form-'.$deal->id]); ?>

                                                                    <?php echo Form::close(); ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="pl-2 pt-0 pr-2 pb-2">
                                                <h6>
                                                    <?php ($labels = $deal->labels()); ?>
                                                    <?php if($labels): ?>
                                                        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span class="badge badge-<?php echo e($label->color); ?> mr-1" data-toggle="tooltip" data-original-title="<?php echo e($label->name); ?>"> </span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </h6>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view deal')): ?> <?php if($deal->is_active): ?> <?php echo e(route('deals.show',$deal->id)); ?> <?php else: ?> # <?php endif; ?> <?php else: ?> # <?php endif; ?>" class="text-body"><?php echo e($deal->name); ?> <span class="deal_icon"><i class="fas fa-eye"></i></span></a>
                                                </h5>
                                                <p class="mb-0">
                                                    <span class="text-nowrap mb-2 d-inline-block text-xs">
                                                        <b><?php echo e(count($deal->tasks)); ?>/<?php echo e(count($deal->complete_tasks)); ?></b> <?php echo e(__('Tasks')); ?>

                                                    </span>
                                                </p>
                                                <div class="float-right font-weight-bold mt-1 text-sm"><?php echo e(\Auth::user()->priceFormat($deal->price)); ?></div>
                                                <p class="mb-0">
                                                    <?php $__currentLoopData = $deal->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">

                                                            <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($user->name); ?>" <?php if(!empty($user->avatar)): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> class="rounded-circle " width="25" height="25">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/deals/index.blade.php ENDPATH**/ ?>