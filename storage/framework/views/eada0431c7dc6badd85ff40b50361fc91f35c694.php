<?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="card hover-shadow-lg pb-0">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 <?php echo e((strtotime($project->end_date) < time()) ? 'text-danger' : ''); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('End Date')); ?>"><?php echo e(\App\Utility::getDateFormated($project->end_date)); ?></h6>
                        </div>
                        
                        <div class="text-right">
                          <span class="clearfix"></span>
                          <span class="badge badge-pill badge-<?php echo e(\App\Project::$status_color[$project->status]); ?>"><?php echo e(__(\App\Project::$project_status[$project->status])); ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center p-0">
                    <a href="<?php echo e(route('projects.show',$project)); ?>" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                        <img class="hweb" <?php echo e($project->img_image); ?> >
                    </a>
                    <h5 class="h6 my-4">
                            <a href="<?php echo e(route('projects.show',$project)); ?>"><?php echo e($project->project_name); ?></a>
                        <br>
                    </h5>
                    <div class="avatar-group hover-avatar-ungroup mb-3" id="project_<?php echo e($project->id); ?>">
                        <?php if(isset($project->users) && !empty($project->users) && count($project->users) > 0): ?>
                            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key < 3): ?>
                                    <a href="#" class="avatar rounded-circle">
                                        <img   <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> title="<?php echo e($user->name); ?>" style="height:36px;width:36px;">
                                    </a>
                                <?php else: ?>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($project->users) > 3): ?>
                                <a href="#" class="avatar rounded-circle">
                                    <img  <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> style="height:36px;width:36px;">
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="progress w-100 height-2">
                    <div class="progress-bar bg-<?php echo e($project->project_progress()['color']); ?>" role="progressbar" aria-valuenow="<?php echo e($project->project_progress()['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                </div>
                <div class="card-footer">
                    <div class="actions d-flex justify-content-between px-4">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                        <a href="#" data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Invite Member')); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Invite Member')); ?>">
                            <i class="fas fa-paper-plane"></i>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                            <a href="#" class="action-item"
                                    data-url="<?php echo e(route('projects.edit', $project->id)); ?>" data-ajax-popup="true"
                                    data-title="<?php echo e(__('Edit Project')); ?>" data-toggle="tooltip"
                                    data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                                    <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete project')): ?>
                            <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-project-<?php echo e($project->id); ?>').submit();">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.destroy',$project->id],'id'=>'delete-project-'.$project->id]); ?>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center mb-0"><?php echo e(__('No Projects Found.')); ?></h6>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/projects/grid.blade.php ENDPATH**/ ?>