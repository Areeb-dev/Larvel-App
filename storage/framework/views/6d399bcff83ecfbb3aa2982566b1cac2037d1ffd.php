<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');
?>

<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')); ?>" class="navbar-brand-img"/>
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <?php if(\Auth::user()->type != 'client'): ?>
                <ul class="navbar-nav navbar-nav-docs">
                    <?php if( Gate::check('show hrm dashboard') || Gate::check('show project dashboard') || Gate::check('show account dashboard')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'project-dashboard' || Request::segment(1) == 'hrm-dashboard')?' active':'collapsed'); ?>" href="#navbar-dashboard" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'project-dashboard' || Request::segment(1) == 'hrm-dashboard')?'true':'false'); ?>" aria-controls="navbar-dashboard">
                                <i class="fa fa-fire"></i><?php echo e(__('Dashboard')); ?>

                                <i class="fas fa-sort-up"></i>
                            </a>
                            <div class="collapse <?php echo e((Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'project-dashboard' || Request::segment(1) == 'hrm-dashboard')?'show':''); ?>" id="navbar-dashboard">
                                <ul class="nav flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show account dashboard')): ?>
                                        <li class="nav-item <?php echo e((Request::route()->getName() == 'dashboard') ? ' active' : ''); ?>">
                                            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link"><?php echo e(__("Account Dashboard")); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show hrm dashboard')): ?>
                                        <li class="nav-item <?php echo e((Request::route()->getName() == 'hrm.dashboard') ? ' active' : ''); ?>">
                                            <a href="<?php echo e(route('hrm.dashboard')); ?>" class="nav-link"><?php echo e(__("HRM Dashboard")); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show project dashboard')): ?>
                                        <li class="nav-item <?php echo e((Request::route()->getName() == 'project.dashboard') ? ' active' : ''); ?>">
                                            <a href="<?php echo e(route('project.dashboard')); ?>" class="nav-link"><?php echo e(__("Project Dashboard")); ?></a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer proposal')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('customer.proposal')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : ''); ?>">
                                <i class="fas fa-file"></i><?php echo e(__('Proposal')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer invoice')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('customer.invoice')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'customer.invoice' || Request::route()->getName() == 'customer.invoice.show') ? ' active' : ''); ?> ">
                                <i class="fas fa-file"></i><?php echo e(__('Invoice')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer payment')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('customer.payment')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'customer.payment') ? ' active' : ''); ?> ">
                                <i class="fas fa-money-bill-alt"></i><?php echo e(__('Payment')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer transaction')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('customer.transaction')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'customer.transaction') ? ' active' : ''); ?>">
                                <i class="fas fa-history"></i><?php echo e(__('Transaction')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender bill')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('vender.bill')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'vender.bill' || Request::route()->getName() == 'vender.bill.show') ? ' active' : ''); ?> ">
                                <i class="fas fa-file"></i><?php echo e(__('Bill')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender payment')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('vender.payment')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'vender.payment') ? ' active' : ''); ?> ">
                                <i class="fas fa-money-bill-alt"></i><?php echo e(__('Payment')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender transaction')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('vender.transaction')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'vender.transaction') ? ' active' : ''); ?>">
                                <i class="fas fa-history"></i><?php echo e(__('Transaction')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(\Auth::user()->type=='super admin'): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                    <i class="fas fa-columns"></i><?php echo e(__('User')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if( Gate::check('manage user') || Gate::check('manage role')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'clients')?' active':'collapsed'); ?>" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'clients')?'true':'false'); ?>" aria-controls="navbar-staff">
                                    <i class="fa fa-users"></i><?php echo e(__('Staff')); ?>

                                    <i class="fas fa-sort-up"></i>
                                </a>
                                <div class="collapse <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'clients')?'show':''); ?>" id="navbar-staff">
                                    <ul class="nav flex-column">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                                <a href="<?php echo e(route('users.index')); ?>" class="nav-link"><?php echo e(__('User')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : ''); ?>">
                                                <a href="<?php echo e(route('roles.index')); ?>" class="nav-link"><?php echo e(__('Role')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage client')): ?>
                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : ''); ?>">
                                                <a href="<?php echo e(route('clients.index')); ?>" class="nav-link"><?php echo e(__('Client')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if(Gate::check('manage product & service')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('productservice.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'productservice')?'active':''); ?>">
                                    <i class="fas fa-shopping-cart"></i><?php echo e(__('Product & Service')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if( Gate::check('manage lead') || Gate::check('manage deal') || Gate::check('manage form builder')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response')?' active':'collapsed'); ?>" href="#navbar-crm" data-toggle="collapse" role="button"
                                   aria-expanded="<?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'true':'false'); ?>" aria-controls="navbar-crm">
                                    <i class="fa fa-filter"></i><?php echo e(__('CRM')); ?>

                                    <i class="fas fa-sort-up"></i>
                                </a>
                                <div class="collapse <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''); ?>" id="navbar-crm">
                                    <ul class="nav flex-column">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead')): ?>
                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show') ? ' active' : ''); ?>">
                                                <a href="<?php echo e(route('leads.index')); ?>" class="nav-link"><?php echo e(__('Leads')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage deal')): ?>
                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'deals.list' || Request::route()->getName() == 'deals.index' || Request::route()->getName() == 'deals.show') ? ' active' : ''); ?>">
                                                <a href="<?php echo e(route('deals.index')); ?>" class="nav-link"><?php echo e(__('Deals')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage form builder')): ?>
                                            <li class="nav-item <?php echo e((Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response')?'active open':''); ?>">
                                                <a href="<?php echo e(route('form_builder.index')); ?>" class="nav-link"><?php echo e(__('Form Builder')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                            <?php if(\Auth::user()->type=='company' || \Auth::user()->type=='client'): ?>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('contract.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'contract')?'active':''); ?>">
                                                        <?php echo e(__('Contract')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php if(Gate::check('manage lead stage') || Gate::check('manage pipeline') ||Gate::check('manage source') ||Gate::check('manage label') || Gate::check('manage stage')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="crm-setup-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'active' :'collapsed'); ?>"
                                                                   href="#crm-setup-nav" data-toggle="collapse" role="button"
                                                                   aria-expanded="<?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'true' :'false'); ?>"
                                                                   aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Setup')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div
                                                                    class="submenu-ul <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'show' :'collapse'); ?>"
                                                                    id="crm-setup-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pipeline')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'pipelines.index' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('pipelines.index')); ?>" class="nav-link"><?php echo e(__('Pipeline')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead stage')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'lead_stages.index' ) ? 'active' : ''); ?>">
                                                                                <a href="<?php echo e(route('lead_stages.index')); ?>" class="nav-link"><?php echo e(__('Lead Stages')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage stage')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'stages.index' ) ? 'active' : ''); ?>">
                                                                                <a href="<?php echo e(route('stages.index')); ?>" class="nav-link"><?php echo e(__('Deal Stages')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage source')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'sources.index' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('sources.index')); ?>" class="nav-link"><?php echo e(__('Sources')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage label')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'labels.index' ) ? 'active' : ''); ?>">
                                                                                <a href="<?php echo e(route('labels.index')); ?>" class="nav-link"><?php echo e(__('Labels')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                            <li class="nav-item <?php echo e((Request::segment(1) == 'contractType')?'active open':''); ?>">
                                                                                <a href="<?php echo e(route('contractType.index')); ?>" class="nav-link"><?php echo e(__('Contract Type')); ?></a>
                                                                            </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if( Gate::check('manage project')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'project' || Request::segment(1) == 'projects') ? 'active' : 'collapsed'); ?>" href="#taskGo"
                                   data-toggle="collapse" role="button"
                                   aria-expanded="<?php echo e((Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskBoard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'projects' || Request::segment(1) == 'project' || Request::segment(1) == 'project-task-stages') ? 'true' : 'false'); ?>" aria-controls="user">
                                    <i class="fa fa-project-diagram"></i><?php echo e(__('Project')); ?>

                                    <i class="fas fa-sort-up"></i>
                                </a>
                                <div
                                    class="collapse <?php echo e((Request::segment(1) == 'bugs-report' || Request::segment(1) == 'project' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'project' || Request::segment(1) == 'projects') ? 'show' : ''); ?>"
                                    id="taskGo" style="">
                                    <ul class="nav flex-column">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
                                            <li class="nav-item  <?php echo e(Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('projects.index')); ?>" class="nav-link">
                                                    <?php echo e(__('Projects')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                                            <li class="nav-item <?php echo e((request()->is('taskboard*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="nav-link"><?php echo e(__('Tasks')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage timesheet')): ?>

                                            <li class="nav-item <?php echo e((request()->is('timesheet-list*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('timesheet.list')); ?>" class="nav-link"><?php echo e(__('Timesheet')); ?></a>
                                            </li>
                                            <?php if(\Auth::user()->type =='company'): ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
                                            <li class="nav-item <?php echo e((request()->is('bugs-report*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('bugs.view','list')); ?>" class="nav-link"><?php echo e(__('Bug')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                                            <li class="nav-item <?php echo e((request()->is('calendar*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('task.calendar',['all'])); ?>" class="nav-link"><?php echo e(__('Task Calender')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage project task stage') || Gate::check('manage bug status')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="taskgo_constants" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages') ? 'active' : 'collapsed'); ?>" href="#taskgo_navbar_constants" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'project-task-stages') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Setup')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e((Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages') ? 'show' : 'collapse'); ?>" id="taskgo_navbar_constants" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task stage')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'project-task-stages.index') ? 'active' : ''); ?>">
                                                                                <a class="nav-link" href="<?php echo e(route('project-task-stages.index')); ?>"><?php echo e(__('Project Task Stages')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug status')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'bugstatus.index') ? 'active' : ''); ?>">
                                                                                <a class="nav-link" href="<?php echo e(route('bugstatus.index')); ?>"><?php echo e(__('Bug Status')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    <!-- For Hrm -->
                        <?php if( Gate::check('manage employee') || Gate::check('manage setsalary')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'leavetype' || Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee' || Request::segment(1) == 'document-upload' || Request::segment(1) == 'document' || Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'employee' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career' || Request::segment(1) == 'holiday' || Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'company-policy' || Request::segment(1) == 'job-stage' || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption')?'active':'collapsed'); ?>"
                                   href="#hrm" data-toggle="collapse" role="button"
                                   aria-expanded="<?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'leavetype' || Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee' || Request::segment(1) == 'document-upload' || Request::segment(1) == 'document' || Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'employee' || Request::segment(1) == 'trainer' || Request::segment(1) == 'training' || Request::segment(1) == 'meeting' || Request::segment(1) == 'event' || Request::segment(1) == 'account-assets' || Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking' || Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip' || Request::segment(1) == 'company-policy' || Request::segment(1) == 'job-stage' || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption')?'true':'false'); ?>"
                                   aria-controls="fleet">
                                    <i class="fas fa-user"></i><?php echo e(__('HRM')); ?>

                                    <i class="fas fa-sort-up"></i>
                                </a>
                                <div
                                    class="collapse <?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'leavetype' || Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee' || Request::segment(1) == 'document-upload' || Request::segment(1) == 'document' || Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'employee' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career' || Request::segment(1) == 'holiday' || Request::segment(1) == 'trainer' || Request::segment(1) == 'training' || Request::segment(1) == 'meeting' || Request::segment(1) == 'event' || Request::segment(1) == 'account-assets' || Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking' || Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip' || Request::segment(1) == 'company-policy' || Request::segment(1) == 'job-stage' || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption')?'show':''); ?>"
                                    id="hrm" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <div class="collapse show" id="navbar-accounting8" style="">
                                                <ul class="nav flex-column">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item  <?php echo e((Request::segment(1) == 'employee' ? 'active' : '')); ?>">
                                                            <?php if(\Auth::user()->type =='Employee'): ?>
                                                                <?php
                                                                    $employee=App\Employee::where('user_id',\Auth::user()->id)->first();
                                                                ?>
                                                                <a href="<?php echo e(route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt(\Auth::user()->id))); ?>" class="nav-link   <?php echo e((request()->is('employee*') ? 'active' : '')); ?>">

                                                                    <?php echo e(__('Employee')); ?>

                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?php echo e(route('employee.index')); ?>" class="nav-link">

                                                                    <?php echo e(__('Employee')); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                        <li class="nav-item submenu-li ">
                                                            <a class="nav-link <?php echo e((Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip') ? 'active' : 'collapsed'); ?>" href="#navbar-accounting8-users" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                                <?php echo e(__('Payroll')); ?>

                                                                <i class="fas fa-sort-up"></i>
                                                            </a>
                                                            <div class="submenu-ul <?php echo e((Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip') ? 'show' : 'collapse'); ?>" id="navbar-accounting8-users" style="">
                                                                <ul class="nav flex-column">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage set salary')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('setsalary*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('setsalary.index')); ?>" class="nav-link"><?php echo e(__('Set salary')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pay slip')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('payslip*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('payslip.index')); ?>" class="nav-link"><?php echo e(__('Payslip')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <div class="collapse show" id="navbar-hr" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee') ? 'active' :'collapsed'); ?>" href="#navbar-hr-leave_management" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee') ? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Leave Management')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee') ? 'show' :'collapse'); ?>" id="navbar-hr-leave_management" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'leave.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('leave.index')); ?>" class="nav-link"><?php echo e(__('Manage Leave')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage attendance')): ?>
                                                                    <li class="nav-item">
                                                                        <div class="collapse show" id="attendance-navbar" style="">
                                                                            <ul class="nav flex-column">
                                                                                <ul class="nav flex-column">
                                                                                    <li class="nav-item submenu-li ">
                                                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'attendanceemployee') ? 'active' : 'collapsed'); ?>" href="#navbar-attendance" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'attendanceemployee') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                                                            <?php echo e(__('Attendance')); ?>

                                                                                            <i class="fas fa-sort-up"></i>
                                                                                        </a>
                                                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'attendanceemployee') ? 'show' : 'collapse'); ?>" id="navbar-attendance" style="">
                                                                                            <ul class="nav flex-column">
                                                                                                <li class="nav-item <?php echo e((Request::route()->getName() == 'attendanceemployee.index' ? 'active' : '')); ?>">
                                                                                                    <a href="<?php echo e(route('attendanceemployee.index')); ?>" class="nav-link"><?php echo e(__('Marked Attendance')); ?></a>
                                                                                                </li>
                                                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create attendance')): ?>
                                                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'attendanceemployee.bulkattendance' ? 'active' : '')); ?>">
                                                                                                        <a href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>" class="nav-link"><?php echo e(__('Bulk Attendance')); ?></a>
                                                                                                    </li>
                                                                                                <?php endif; ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <div class="collapse show" id="performance-navbar" style="">
                                                <ul class="nav flex-column">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item submenu-li ">
                                                            <a class="nav-link <?php echo e((Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'active' : 'collapsed'); ?>" href="#navbar-performance" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                                <?php echo e(__('Performance')); ?>

                                                                <i class="fas fa-sort-up"></i>
                                                            </a>
                                                            <div class="submenu-ul <?php echo e((Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'show' : 'collapse'); ?>" id="navbar-performance" style="">
                                                                <ul class="nav flex-column">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage indicator')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('indicator*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('indicator.index')); ?>" class="nav-link"><?php echo e(__('Indicator')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage appraisal')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('appraisal*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('appraisal.index')); ?>" class="nav-link"><?php echo e(__('Appraisal')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage goal tracking')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('goaltracking*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('goaltracking.index')); ?>" class="nav-link"><?php echo e(__('Goal Tracking')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <div class="collapse show" id="training-navbar" style="">
                                                <ul class="nav flex-column">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item submenu-li ">
                                                            <a class="nav-link <?php echo e((Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'active' : 'collapsed'); ?>" href="#navbar-training" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                                <?php echo e(__('Training')); ?>

                                                                <i class="fas fa-sort-up"></i>
                                                            </a>
                                                            <div class="submenu-ul <?php echo e((Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'show' : 'collapse'); ?>" id="navbar-training" style="">
                                                                <ul class="nav flex-column">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage training')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('training*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('training.index')); ?>" class="nav-link"><?php echo e(__('Training List')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage trainer')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('trainer*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('trainer.index')); ?>" class="nav-link"><?php echo e(__('Trainer')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="collapse show" id="recruitment-navbar" style="">
                                                <ul class="nav flex-column">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item submenu-li">
                                                            <a class="nav-link <?php echo e((Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career') ? 'active' : 'collapsed'); ?>" href="#navbar-recruitment" data-toggle="collapse" role="button"
                                                               aria-expanded="<?php echo e((Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                                <?php echo e(__('Recruitment')); ?>

                                                                <i class="fas fa-sort-up"></i>
                                                            </a>
                                                            <div class="submenu-ul <?php echo e((Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career') ? 'show' : 'collapse'); ?>" id="navbar-recruitment" style="">
                                                                <ul class="nav flex-column">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job')): ?>
                                                                        <li class="nav-item <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('job.index')); ?>" class="nav-link"><?php echo e(__('Jobs')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('job-application*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('job-application.index')); ?>" class="nav-link"><?php echo e(__('Job Application')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('candidates-job-applications') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('job.application.candidate')); ?>" class="nav-link"><?php echo e(__('Job Candidate')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('job-onboard*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('job.on.board')); ?>" class="nav-link"><?php echo e(__('Job OnBoard')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage custom question')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('custom-question*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('custom-question.index')); ?>" class="nav-link"><?php echo e(__('Custom Question')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show interview schedule')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('interview-schedule*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('interview-schedule.index')); ?>" class="nav-link"><?php echo e(__('Interview Schedule')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show career')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('career*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('career',[2,'en'])); ?>" target="_blank" class="nav-link"><?php echo e(__('Career')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="collapse show" id="hrm-hr-navbar" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'holiday' || Request::segment(1) == 'policies' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement') ? 'active' : 'collapsed'); ?>"
                                                           href="#hrm-hr" data-toggle="collapse" role="button"
                                                           aria-expanded="<?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'holiday' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'policies') ? 'true' : 'false'); ?>"
                                                           aria-controls="user">
                                                            <?php echo e(__('HR')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div
                                                            class="submenu-ul collapse<?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'holiday' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'policies') ? 'show' : ''); ?>"
                                                            id="hrm-hr" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage award')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('award*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('award.index')); ?>" class="nav-link"><?php echo e(__('Award')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transfer')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('transfer*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('transfer.index')); ?>" class="nav-link"><?php echo e(__('Transfer')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage resignation')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('resignation*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('resignation.index')); ?>" class="nav-link"><?php echo e(__('Resignation')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage travel')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('travel*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('travel.index')); ?>" class="nav-link"><?php echo e(__('Trip')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage promotion')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('promotion*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('promotion.index')); ?>" class="nav-link"><?php echo e(__('Promotion')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage complaint')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('complaint*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('complaint.index')); ?>" class="nav-link"><?php echo e(__('Complaints')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage warning')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('warning*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('warning.index')); ?>" class="nav-link"><?php echo e(__('Warning')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage termination')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('termination*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('termination.index')); ?>" class="nav-link"><?php echo e(__('Termination')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage announcement')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('announcement*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('announcement.index')); ?>" class="nav-link"><?php echo e(__('Announcement')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage holiday')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('holiday*') || request()->is('holiday-calender') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('holiday.index')); ?>" class="nav-link"><?php echo e(__('Holidays')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>


                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage event')): ?>
                                            <li class="nav-item <?php echo e((request()->is('event*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('event.index')); ?>" class="nav-link"><?php echo e(__('Event')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage meeting')): ?>
                                            <li class="nav-item <?php echo e((request()->is('meeting*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('meeting.index')); ?>" class="nav-link"><?php echo e(__('Meeting')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage assets')): ?>
                                            <li class="nav-item <?php echo e((request()->is('account-assets*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('account-assets.index')); ?>" class="nav-link"><?php echo e(__('Asset')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage document')): ?>
                                            <li class="nav-item <?php echo e((request()->is('document-upload*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('document-upload.index')); ?>" class="nav-link"><?php echo e(__('Document')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage company policy')): ?>
                                            <li class="nav-item <?php echo e((request()->is('company-policy*') ? 'active' : '')); ?>">
                                                <a href="<?php echo e(route('company-policy.index')); ?>" class="nav-link"><?php echo e(__('Company policy')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage report')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="hr-report-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll') ? 'active' : 'collapsed'); ?>" href="#hr-report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll') ? 'true' : 'false'); ?>"
                                                                   aria-controls="user">
                                                                    <?php echo e(__('Report')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul collapse<?php echo e((Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll') ? 'show' : ''); ?>" id="hr-report" style="">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item <?php echo e(request()->is('reports-monthly-attendance') ? 'active' : ''); ?>">
                                                                            <a class="nav-link" href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                                                        </li>
                                                                        <li class="nav-item <?php echo e(request()->is('reports-leave') ? 'active' : ''); ?>">
                                                                            <a class="nav-link" href="<?php echo e(route('report.leave')); ?>"><?php echo e(__('Leave')); ?></a>
                                                                        </li>
                                                                        <li class="nav-item <?php echo e(request()->is('reports-payroll') ? 'active' : ''); ?>">
                                                                            <a class="nav-link" href="<?php echo e(route('report.payroll')); ?>"><?php echo e(__('Payroll')); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>

                                        <li class="nav-item">
                                            <div class="collapse show" id="hrmgo_constants" style="">
                                                <ul class="nav flex-column">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item submenu-li">
                                                            <a class="nav-link <?php echo e((Request::segment(1) == 'leavetype' || Request::segment(1) == 'document' || Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'job-stage' || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption') ? 'active' : 'collapsed'); ?>"
                                                               href="#hrmgo_navbar_constants" data-toggle="collapse" role="button"
                                                               aria-expanded="<?php echo e((Request::segment(1) == 'leavetype' || Request::segment(1) == 'document' || Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'job-stage' || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption') ? 'true' : 'false'); ?>"
                                                               aria-controls="navbar-getting-started1">
                                                                <?php echo e(__('Setup')); ?>

                                                                <i class="fas fa-sort-up"></i>
                                                            </a>
                                                            <div
                                                                class="submenu-ul <?php echo e((Request::segment(1) == 'leavetype' || Request::segment(1) == 'document' || Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'job-stage' || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption') ? 'show' : 'collapse'); ?>"
                                                                id="hrmgo_navbar_constants" style="">
                                                                <ul class="nav flex-column">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage branch')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('branch*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('branch.index')); ?>" class="nav-link"><?php echo e(__('Branch')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage department')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('department*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('department.index')); ?>" class="nav-link"><?php echo e(__('Department')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage designation')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('designation*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('designation.index')); ?>" class="nav-link"><?php echo e(__('Designation')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave type')): ?>
                                                                        <li class="nav-item <?php echo e((Request::route()->getName() == 'leavetype.index' ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('leavetype.index')); ?>" class="nav-link"><?php echo e(__('Leave Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage document type')): ?>
                                                                        <li class="nav-item <?php echo e((Request::route()->getName() == 'document.index' ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('document.index')); ?>" class="nav-link"><?php echo e(__('Document Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payslip type')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('paysliptype*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('paysliptype.index')); ?>" class="nav-link"><?php echo e(__('Payslip Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage allowance option')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('allowanceoption*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('allowanceoption.index')); ?>" class="nav-link"><?php echo e(__('Allowance Option')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage loan option')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('loanoption*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('loanoption.index')); ?>" class="nav-link"><?php echo e(__('Loan Option')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage deduction option')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('deductionoption*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('deductionoption.index')); ?>" class="nav-link"><?php echo e(__('Deduction Option')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage goal type')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('goaltype*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('goaltype.index')); ?>" class="nav-link"><?php echo e(__('Goal Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage training type')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('trainingtype*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('trainingtype.index')); ?>" class="nav-link"><?php echo e(__('Training Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage award type')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('awardtype*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('awardtype.index')); ?>" class="nav-link"><?php echo e(__('Award Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage termination type')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('terminationtype*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('terminationtype.index')); ?>" class="nav-link"><?php echo e(__('Termination Type')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job category')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('job-category*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('job-category.index')); ?>" class="nav-link"><?php echo e(__('Job Category')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job stage')): ?>
                                                                        <li class="nav-item <?php echo e((request()->is('job-stage*') ? 'active' : '')); ?>">
                                                                            <a href="<?php echo e(route('job-stage.index')); ?>" class="nav-link"><?php echo e(__('Job Stage')); ?></a>
                                                                        </li>
                                                                    <?php endif; ?>


                                                                            <li class="nav-item <?php echo e(request()->is('competencies*') ? 'active' : ''); ?>">
                                                                                <a class="nav-link" href="<?php echo e(route('competencies.index')); ?>"><?php echo e(__('Competencies')); ?></a>
                                                                            </li>

                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    <!-- end Hrm -->
                        <?php if( Gate::check('manage customer') || Gate::check('manage vender')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::segment(1) == 'print-setting' || Request::segment(1) == 'customer' || Request::segment(1) == 'vender' || Request::segment(1) == 'proposal' || Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer' || Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note' || Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' || (Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance' || Request::segment(1) == 'goal' || Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance' || Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')?' active':'collapsed'); ?>"
                                   href="#navbar-account" data-toggle="collapse" role="button"
                                   aria-expanded="<?php echo e((Request::segment(1) == 'customer' || Request::segment(1) == 'vender' || Request::segment(1) == 'proposal' || Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer' || Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note' || Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' || (Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance' || Request::segment(1) == 'goal' || Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance' || Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note' || Request::segment(1) == 'print-setting')?'true':'false'); ?>"
                                   aria-controls="navbar-account">
                                    <i class="fa fa-briefcase"></i><?php echo e(__('Account')); ?>

                                    <i class="fas fa-sort-up"></i>
                                </a>
                                <div
                                    class="collapse <?php echo e((Request::segment(1) == 'print-setting' || Request::segment(1) == 'customer' || Request::segment(1) == 'vender' || Request::segment(1) == 'proposal' || Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer' || Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note' || Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' || (Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance' || Request::segment(1) == 'goal' || Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance' || Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')?'show':''); ?>"
                                    id="navbar-account">
                                    <ul class="nav flex-column">
                                        <?php if(Gate::check('manage customer')): ?>
                                            <li class="nav-item <?php echo e((Request::segment(1) == 'customer')?'active':''); ?>">
                                                <a href="<?php echo e(route('customer.index')); ?>" class="nav-link">
                                                    <!-- <i class="fas fa-user-ninja"></i> -->
                                                    <?php echo e(__('Customer')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage vender')): ?>
                                            <li class="nav-item <?php echo e((Request::segment(1) == 'vender')?'active':''); ?>">
                                                <a href="<?php echo e(route('vender.index')); ?>" class="nav-link">
                                                    <!-- <i class="fas fa-sticky-note"></i> -->
                                                    <?php echo e(__('Vendor')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage proposal')): ?>
                                            <li class="nav-item <?php echo e((Request::segment(1) == 'proposal')?'active':''); ?>">
                                                <a href="<?php echo e(route('proposal.index')); ?>" class="nav-link">
                                                    <!-- <i class="fas fa-receipt"></i> -->
                                                    <?php echo e(__('Proposal')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if( Gate::check('manage bank account') ||  Gate::check('manage bank transfer')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="banking-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer')? 'active' :'collapsed'); ?>" href="#banking-nav" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Banking')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer')? 'show' :'collapse'); ?>" id="banking-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bank account')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('bank-account.index')); ?>" class="nav-link"><?php echo e(__('Account')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bank transfer')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'bank-transfer.index' || Request::route()->getName() == 'bank-transfer.create' || Request::route()->getName() == 'bank-transfer.edit') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('bank-transfer.index')); ?>" class="nav-link"><?php echo e(__('Transfer')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if( Gate::check('manage invoice') ||  Gate::check('manage revenue') ||  Gate::check('manage credit note')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="income-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')? 'active' :'collapsed'); ?>" href="#income-nav" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Income')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')? 'show' :'collapse'); ?>" id="income-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage invoice')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('invoice.index')); ?>" class="nav-link"><?php echo e(__('Invoice')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage revenue')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('revenue.index')); ?>" class="nav-link"><?php echo e(__('Revenue')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage credit note')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'credit.note' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('credit.note')); ?>" class="nav-link"><?php echo e(__('Credit Note')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if( Gate::check('manage bill')  ||  Gate::check('manage payment') ||  Gate::check('manage debit note')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="expense-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')? 'active' :'collapsed'); ?>" href="#expense-nav" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Expense')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')? 'show' :'collapse'); ?>" id="expense-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bill')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'bill.index' || Request::route()->getName() == 'bill.create' || Request::route()->getName() == 'bill.edit' || Request::route()->getName() == 'bill.show') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('bill.index')); ?>" class="nav-link"><?php echo e(__('Bill')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payment')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'payment.index' || Request::route()->getName() == 'payment.create' || Request::route()->getName() == 'payment.edit') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('payment.index')); ?>" class="nav-link"><?php echo e(__('Payment')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage debit note')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'debit.note' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('debit.note')); ?>" class="nav-link"><?php echo e(__('Debit Note')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if( Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report') ||  Gate::check('ledger report') ||  Gate::check('trial balance report')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="double-enrty-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')? 'active' :'collapsed'); ?>" href="#double-enrty-nav" data-toggle="collapse" role="button"
                                                                   aria-expanded="<?php echo e((Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Double Entry')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e((Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')? 'show' :'collapse'); ?>" id="double-enrty-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage chart of account')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'chart-of-account.index') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('chart-of-account.index')); ?>" class="nav-link"><?php echo e(__('Chart of Accounts')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage journal entry')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'journal-entry.index' || Request::route()->getName() == 'journal-entry.show') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('journal-entry.index')); ?>" class="nav-link"><?php echo e(__('Journal Account')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ledger report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.ledger' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.ledger')); ?>" class="nav-link"><?php echo e(__('Ledger Summary')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('balance sheet report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.balance.sheet' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.balance.sheet')); ?>" class="nav-link"><?php echo e(__('Balance Sheet')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>

                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('trial balance report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'trial.balance' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('trial.balance')); ?>" class="nav-link"><?php echo e(__('Trial Balance')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage goal')): ?>
                                            <li class="nav-item  <?php echo e((Request::segment(1) == 'goal')?'active':''); ?>">
                                                <a href="<?php echo e(route('goal.index')); ?>" class="nav-link">
                                                    <!-- <i class="fas fa-bullseye"></i> -->
                                                    <?php echo e(__('Goal')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if( Gate::check('income report') || Gate::check('expense report') || Gate::check('income vs expense report') || Gate::check('tax report')  || Gate::check('loss & profit report') || Gate::check('invoice report') || Gate::check('bill report') || Gate::check('invoice report') ||  Gate::check('manage transaction')||  Gate::check('statement report')): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="report-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')? 'active' :'collapsed'); ?>" href="#report-nav" data-toggle="collapse" role="button"
                                                                   aria-expanded="<?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Report')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')? 'show' :'collapse'); ?>" id="report-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transaction')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'transaction.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transaction.edit') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('transaction.index')); ?>" class="nav-link"><?php echo e(__('Transaction')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('statement report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.account.statement') ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.account.statement')); ?>" class="nav-link"><?php echo e(__('Account Statement')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.income.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.income.summary')); ?>" class="nav-link"><?php echo e(__('Income Summary')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.expense.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.expense.summary')); ?>" class="nav-link"><?php echo e(__('Expense Summary')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income vs expense report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.income.vs.expense.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.income.vs.expense.summary')); ?>" class="nav-link"><?php echo e(__('Income VS Expense')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.tax.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.tax.summary')); ?>" class="nav-link"><?php echo e(__('Tax Summary')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loss & profit report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.profit.loss.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.profit.loss.summary')); ?>" class="nav-link"><?php echo e(__('Profit & Loss')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.invoice.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.invoice.summary')); ?>" class="nav-link"><?php echo e(__('Invoice Summary')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bill report')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'report.bill.summary' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('report.bill.summary')); ?>" class="nav-link"><?php echo e(__('Bill Summary')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage constant tax') || Gate::check('manage constant category') ||Gate::check('manage constant unit') ||Gate::check('manage constant payment method') ||Gate::check('manage constant custom field') ): ?>
                                            <li class="nav-item">
                                                <div class="collapse show" id="account-setup-navbar" style="">
                                                    <ul class="nav flex-column">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item submenu-li ">
                                                                <a class="nav-link <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'active' :'collapsed'); ?>" href="#account-setup-nav" data-toggle="collapse" role="button"
                                                                   aria-expanded="<?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                                    <?php echo e(__('Setup')); ?>

                                                                    <i class="fas fa-sort-up"></i>
                                                                </a>
                                                                <div class="submenu-ul <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'show' :'collapse'); ?>" id="account-setup-nav" style="">
                                                                    <ul class="nav flex-column">
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant tax')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'taxes.index' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('taxes.index')); ?>" class="nav-link"><?php echo e(__('Taxes')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant category')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'product-category.index' ) ? 'active' : ''); ?>">
                                                                                <a href="<?php echo e(route('product-category.index')); ?>" class="nav-link"><?php echo e(__('Category')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant unit')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'product-unit.index' ) ? ' active' : ''); ?>">
                                                                                <a href="<?php echo e(route('product-unit.index')); ?>" class="nav-link"><?php echo e(__('Unit')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant custom field')): ?>
                                                                            <li class="nav-item <?php echo e((Request::route()->getName() == 'custom-field.index' ) ? 'active' : ''); ?>">
                                                                                <a href="<?php echo e(route('custom-field.index')); ?>" class="nav-link"><?php echo e(__('Custom Field')); ?></a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage print settings')): ?>
                                            <li class="nav-item <?php echo e((Request::segment(1) == 'print-setting') ? ' active' : ''); ?>">
                                                <a href="<?php echo e(route('print.setting')); ?>" class="nav-link">
                                                    <!-- <i class="fas fa-sliders-h"></i> -->
                                                    <?php echo e(__('Print Settings')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('support.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'support')?'active':''); ?>">
                            <i class="fas fa-ticket-alt"></i><?php echo e(__('Support')); ?>

                        </a>
                    </li>
                    <?php if(\Auth::user()->type!='client'): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(url('messages')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'messages')?'active':''); ?>">
                                <i class="fab fa-facebook-messenger"></i><?php echo e(__('Messenger')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Auth::user()->type == 'company'): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('custom_landing_page.index')); ?>" class="nav-link">
                                <i class="fas fa-clipboard"></i><?php echo e(__('Landing page')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage company settings')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('company.setting')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'company-setting') ? ' active' : ''); ?>">
                                <i class="fas fa-sliders-h"></i>
                                <?php echo e(__('Settings')); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            <?php endif; ?>
            <?php if((\Auth::user()->type == 'client')): ?>
                <ul class="navbar-nav navbar-nav-docs">
                    <?php if(Gate::check('manage client dashboard')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('client.dashboard.view')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'dashboard') ? ' active' : ''); ?>">
                                <i class="fas fa-fire"></i>
                                <?php echo e(__('Dashboard')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage deal')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('deals.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'deals') ? ' active' : ''); ?>">
                                <i class="fas fa-rocket"></i>
                                <?php echo e(__('Deals')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage project')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('projects.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'projects') ? ' active' : ''); ?>">
                                <i class="fa fa-project-diagram"></i>
                                <?php echo e(__('Project')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage project task')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'taskboard') ? ' active' : ''); ?>">
                                <i class="fas fa-tasks"></i>
                                <?php echo e(__('Tasks')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage bug report')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('bugs.view','list')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'bugs-report') ? ' active' : ''); ?>">
                                <i class="fas fa-bug"></i>
                                <?php echo e(__('Bugs')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage timesheet')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('timesheet.list')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'timesheet-list') ? ' active' : ''); ?>">
                                <i class="fas fa-clock"></i>
                                <?php echo e(__('Timesheet')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage project task')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('task.calendar',['all'])); ?>" class="nav-link <?php echo e((Request::segment(1) == 'calendar') ? ' active' : ''); ?>">
                                <i class="fas fa-calendar"></i>
                                <?php echo e(__('Task Calender')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('support.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'support')?'active':''); ?>">
                            <i class="fas fa-ticket-alt"></i><?php echo e(__('Support')); ?>

                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/partials/admin/menu.blade.php ENDPATH**/ ?>