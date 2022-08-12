<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Projects')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">

        <div class="btn-white rounded-pill d-inline-block mr-2">
            <div class="input-group input-group-sm input-group-merge input-group-flush">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="project_keyword" class="form-control form-control-flush" placeholder="<?php echo e(__('Search by Name or tag')); ?>">
            </div>
        </div>
        <?php if($view == 'grid'): ?>
            <a href="<?php echo e(route('projects.list','list')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                <span class="btn-inner--icon"><i class="fas fa-list"></i><?php echo e(__('List View')); ?></span>
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                <span class="btn-inner--icon"><i class="fas fa-table"></i><?php echo e(__('Card View')); ?></span>
            </a>
        <?php endif; ?>
        <div class="dropdown">
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto mr-2 action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="btn-inner--icon"><i class="fas fa-filter"></i><?php echo e(__('Filter')); ?></span>
            </a>
            <div class="dropdown-menu  dropdown-steady" id="project_sort">
                <a class="dropdown-item active" href="#" data-val="created_at-desc">
                    <i class="fas fa-sort-amount-down"></i><?php echo e(__('Newest')); ?>

                </a>
                <a class="dropdown-item" href="#" data-val="created_at-asc">
                    <i class="fas fa-sort-amount-up"></i><?php echo e(__('Oldest')); ?>

                </a>

                <a class="dropdown-item" href="#" data-val="project_name-desc">
                    <i class="fas fa-sort-alpha-up"></i><?php echo e(__('From Z-A')); ?>

                </a>
                <a class="dropdown-item" href="#" data-val="project_name-asc">
                    <i class="fas fa-sort-alpha-down"></i><?php echo e(__('From A-Z')); ?>

                </a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto mr-2 action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="btn-inner--icon"><i class="fas fa-flag"></i><?php echo e(__('Status')); ?></span>
            </a>
            <div class="dropdown-menu  project-filter-actions dropdown-steady" id="project_status">
                <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#"><?php echo e(__('Show All')); ?></a>
                <?php $__currentLoopData = \App\Project::$project_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="dropdown-item filter-action pl-4" href="#" data-val="<?php echo e($key); ?>"><?php echo e(__($val)); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto ml-2" data-url="<?php echo e(route('projects.create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Project')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span><?php echo e(__('Create')); ?>

            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row min-750" id="project_view"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function () {
        var sort = 'created_at-desc';
        var status = '';
        ajaxFilterProjectView('created_at-desc');

         // when change status
        $(".project-filter-actions").on('click', '.filter-action', function (e) {
            if ($(this).hasClass('filter-show-all')) {
                $('.filter-action').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.filter-show-all').removeClass('active');
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).blur();
                } else {
                    $(this).addClass('active');
                }
            }

            var filterArray = [];
            var url = $(this).parents('.project-filter-actions').attr('data-url');
            $('div.project-filter-actions').find('.active').each(function () {
                filterArray.push($(this).attr('data-val'));
            });

            status = filterArray;

            ajaxFilterProjectView(sort, $('#project_keyword').val(), status);
        });

        // when change sorting order
        $('#project_sort').on('click', 'a', function () {
                sort = $(this).attr('data-val');
                ajaxFilterProjectView(sort, $('#project_keyword').val(), status);
                $('#project_sort a').removeClass('active');
                $(this).addClass('active');
            });

        // when searching by project name
        $(document).on('keyup', '#project_keyword', function () {
            ajaxFilterProjectView(sort, $(this).val(), status);
        });


        $(document).on('click', '.invite_usr', function () {
            var project_id = $('#project_id').val();
            var user_id = $(this).attr('data-id');

            $.ajax({
                url: '<?php echo e(route('invite.project.user.member')); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    'project_id': project_id,
                    'user_id': user_id,
                    "_token":"<?php echo e(csrf_token()); ?>"
                },
                success: function (data) {
                    if (data.code == '200') {
                        show_toastr(data.status, data.success, 'success')
                        setInterval('location.reload()', 5000);
                    } else if (data.code == '404') {
                        show_toastr(data.status, data.errors, 'error')
                    }
                }
            });
        });
    });

    var currentRequest = null;

        function ajaxFilterProjectView(project_sort, keyword = '', status = '') {
            var mainEle = $('#project_view');
            var view = '<?php echo e($view); ?>';
            var data = {
                view: view,
                sort: project_sort,
                keyword: keyword,
                status: status,
            }

            currentRequest = $.ajax({
                url: '<?php echo e(route('filter.project.view')); ?>',
                data: data,
                beforeSend: function () {
                    if (currentRequest != null) {
                        currentRequest.abort();
                    }
                },
                success: function (data) {
                    mainEle.html(data.html);
                    $('[id^=fire-modal]').remove();
                    loadConfirm();
                }
            });
        }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/projects/index.blade.php ENDPATH**/ ?>