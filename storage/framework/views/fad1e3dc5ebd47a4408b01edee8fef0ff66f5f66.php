<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
            <?php if(\Auth::user()->can('show account dashboard')): ?>
        var options = {
                series: [
                    {
                        name: "<?php echo e(__('Income')); ?>",
                        data: <?php echo json_encode($incExpLineChartData['income']); ?>

                    },
                    {
                        name: "<?php echo e(__('Expense')); ?>",
                        data: <?php echo json_encode($incExpLineChartData['expense']); ?>

                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#77B6EA', '#545454'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: <?php echo json_encode($incExpLineChartData['day']); ?>,
                    title: {
                        text: 'Days'
                    }
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__('Amount')); ?>'
                    },

                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };
        var chart = new ApexCharts(document.querySelector("#cash-flow"), options);
        chart.render();


        var SalesChart = {
            series: [
                {
                    name: "<?php echo e(__('Income')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                },
                {
                    name: "<?php echo e(__('Expense')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }
            ],
            colors: ['#77B6EA', '#545454'],
            chart: {
                type: 'bar',
                height: 430
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                offsetX: -6,
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                }
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
            },
        };
        var sales = new ApexCharts(document.querySelector("#incExpBarChart"), SalesChart);
        sales.render();


            var incomeCategories = {
                // series: [10,20],
                series:<?php echo json_encode($incomeCatAmount); ?>,

                chart: {
                    width: '400px',
                    type: 'pie',
                },
                colors: <?php echo json_encode($incomeCategoryColor); ?>,
                labels: <?php echo json_encode($incomeCategory); ?>,

                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                title: {
                    text: ""
                },
                dataLabels: {},
                legend: {
                    position: 'top',
                    align: 'end',
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }

            };
            var incomeCategory = new ApexCharts(document.querySelector("#incomeByCategory"), incomeCategories);
            incomeCategory.render();


            var expenseCategories = {
                // series: [10,20],
                series: <?php echo json_encode($expenseCatAmount); ?>,

                chart: {
                    width: '400px',
                    type: 'pie',
                },
                colors: <?php echo json_encode($expenseCategoryColor); ?>,
                labels: <?php echo json_encode($expenseCategory); ?>,

                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                title: {
                    text: ""
                },
                dataLabels: {},
                legend: {
                    position: 'top',
                    align: 'end',
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            };
            var expenseCategory = new ApexCharts(document.querySelector("#expenseByCategory"), expenseCategories);
            expenseCategory.render();

        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(\Auth::user()->can('show account dashboard')): ?>
        <?php if(\Auth::user()->type=='company'): ?>
            <div class="row">
                <?php if($constant['taxes'] <= 0): ?>
                    <div class="col-3">
                        <div class="alert alert-danger text-xs">
                            <?php echo e(__('Please add constant taxes. ')); ?><a href="<?php echo e(route('taxes.index')); ?>"><b><?php echo e(__('click here')); ?></b></a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($constant['category'] <= 0): ?>
                    <div class="col-3">
                        <div class="alert alert-danger text-xs">
                            <?php echo e(__('Please add constant category. ')); ?><a href="<?php echo e(route('product-category.index')); ?>"><b><?php echo e(__('click here')); ?></b></a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($constant['units'] <= 0): ?>
                    <div class="col-3">
                        <div class="alert alert-danger text-xs">
                            <?php echo e(__('Please add constant unit. ')); ?><a href="<?php echo e(route('product-unit.index')); ?>"><b><?php echo e(__('click here')); ?></b></a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($constant['bankAccount'] <= 0): ?>
                    <div class="col-3">
                        <div class="alert alert-danger text-xs">
                            <?php echo e(__('Please create bank account. ')); ?><a href="<?php echo e(route('bank-account.index')); ?>"><b><?php echo e(__('click here')); ?></b></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box bg-success"><i class="fas fa-users"></i></div>
                        <h4><?php echo e(__('Total Customers')); ?></h4>
                    </div>
                    <div class="number-icon"><?php echo e(\Auth::user()->countCustomers()); ?></div>
                </div>
                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box bg-warning"><i class="fas fa-user"></i></div>
                        <h4><?php echo e(__('Total Vendors')); ?></h4>
                    </div>
                    <div class="number-icon"><?php echo e(\Auth::user()->countVenders()); ?></div>
                </div>
                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box bg-primary"><i class="fas fa-money-bill"></i></div>
                        <h4><?php echo e(__('Total Invoices')); ?></h4>
                    </div>
                    <div class="number-icon"><?php echo e(\Auth::user()->countInvoices()); ?></div>
                </div>
                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box bg-dagner"><i class="fas fa-database"></i></div>
                        <h4><?php echo e(__('Total Bills')); ?></h4>
                    </div>
                    <div class="number-icon"><?php echo e(\Auth::user()->countBills()); ?></div>
                </div>
                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Cashflow')); ?></h4>
                    <h6 class="last-day-text"><?php echo e(__('Last')); ?> <span><?php echo e(__('15 days')); ?></span></h6>
                </div>
                <div class="card bg-none">
                    <div id="cash-flow" class="chartjs-render-monitor custom-scroll"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4">
                <h4 class="h4 font-weight-400"><?php echo e(__('Income Vs Expense')); ?></h4>
                <div class="card bg-none dashboard-box-1">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <tbody class="list">
                            <tr>
                                <td>
                                    <h4 class="mb-0"><?php echo e(__('Income')); ?></h4>
                                    <h5 class="mb-0"><?php echo e(__('Today')); ?></h5>
                                </td>
                                <td>
                                    <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayIncome())); ?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="mb-0"><?php echo e(__('Expense')); ?></h4>
                                    <h5 class="mb-0"><?php echo e(__('Today')); ?></h5>
                                </td>
                                <td>
                                    <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayExpense())); ?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="mb-0"><?php echo e(__('Income This')); ?></h4>
                                    <h5 class="mb-0"><?php echo e(__('Month')); ?></h5>
                                </td>
                                <td>
                                    <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->incomeCurrentMonth())); ?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="mb-0"><?php echo e(__('Expense This')); ?></h4>
                                    <h5 class="mb-0"><?php echo e(__('Month')); ?></h5>
                                </td>
                                <td>
                                    <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->expenseCurrentMonth())); ?></h3>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Account Balance')); ?></h4>
                </div>
                <div class="card bg-none dashboard-box-1">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Bank')); ?></th>
                                <th><?php echo e(__('Holder Name')); ?></th>
                                <th><?php echo e(__('Balance')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $bankAccountDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="font-style">
                                    <td><?php echo e($bankAccount->bank_name); ?></td>
                                    <td><?php echo e($bankAccount->holder_name); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($bankAccount->opening_balance)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center">
                                            <h6><?php echo e(__('there is no account balance')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Income & Expense')); ?></h4>
                    <h6 class="last-day-text"><?php echo e(__('Current Year').' - '.$currentYear); ?></h6>
                </div>
                <div class="card bg-none">
                    <div class="custom-scroll">
                        <div id="incExpBarChart" height="250"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div>
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Income By Category')); ?></h4>
                    <h6 class="last-day-text"><?php echo e(__('Current Year').' - '.$currentYear); ?></h6>
                </div>
                <div class="card bg-none">
                    <div class="card-body align-self-center height-440">
                        <div id="incomeByCategory"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div>
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Expense By Category')); ?></h4>
                    <h6 class="last-day-text"><?php echo e(__('Current Year').' - '.$currentYear); ?></h6>
                </div>
                <div class="card bg-none">
                    <div class="card-body align-self-center height-440">
                        <div id="expenseByCategory"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Latest Income')); ?></h4>
                    <a href="<?php echo e(route('revenue.index')); ?>" class="more-text history-text float-right"><?php echo e(__('View All')); ?></a>
                </div>
                <div class="card bg-none dashboard-box-1">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Customer')); ?></th>
                                <th><?php echo e(__('Amount Due')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $latestIncome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($income->date)); ?></td>
                                    <td><?php echo e(!empty($income->customer)?$income->customer->name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($income->amount)); ?></td>
                                    <td><?php echo e($income->description); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center">
                                            <h6><?php echo e(__('there is no latest income')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Latest Expense')); ?></h4>
                    <a href="<?php echo e(route('payment.index')); ?>" class="more-text history-text float-right"><?php echo e(__('View All')); ?></a>
                </div>
                <div class="card bg-none dashboard-box-1">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Customer')); ?></th>
                                <th><?php echo e(__('Amount Due')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $latestExpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($expense->date)); ?></td>
                                    <td><?php echo e(!empty($expense->customer)?$expense->customer->name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($expense->amount)); ?></td>
                                    <td><?php echo e($expense->description); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center">
                                            <h6><?php echo e(__('there is no latest expense')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Invoices')); ?></h4>
                </div>
                <div class="card bg-none invo-tab dashboard-box-2">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#weekly_statistics" class="active"><?php echo e(__('Weekly Statistics')); ?></a>
                        </li>
                        <li class="annual-billing">
                            <a data-toggle="tab" href="#monthly_statistics" class=""><?php echo e(__('Monthly Statistics')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="weekly_statistics" class="tab-pane in active">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Invoice Generated')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoiceTotal'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoicePaid'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoiceDue'])); ?></h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="monthly_statistics" class="tab-pane">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0 ">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Invoice Generated')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoiceTotal'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoicePaid'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoiceDue'])); ?></h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Recent Invoices')); ?></h4>
                </div>
                <div class="card bg-none dashboard-box-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Customer')); ?></th>
                                <th><?php echo e(__('Issue Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $recentInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></td>
                                    <td><?php echo e(!empty($invoice->customer)? $invoice->customer->name:''); ?> </td>
                                    <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($invoice->due_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                    <td>
                                        <?php if($invoice->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                            <h6><?php echo e(__('there is no recent invoice')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Recent Bills')); ?></h4>
                </div>
                <div class="card bg-none dashboard-box-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Vendor')); ?></th>
                                <th><?php echo e(__('Bill Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $recentBill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->billNumberFormat($bill->bill_id)); ?></td>
                                    <td><?php echo e(!empty($bill->vender)? $bill->vender->name:''); ?> </td>
                                    <td><?php echo e(Auth::user()->dateFormat($bill->bill_date)); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($bill->due_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($bill->getTotal())); ?></td>
                                    <td>
                                        <?php if($bill->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                            <h6><?php echo e(__('there is no recent bill')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Bills')); ?></h4>
                </div>
                <div class="card bg-none invo-tab dashboard-box-2">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#bill_weekly_statistics" class="active"><?php echo e(__('Weekly Statistics')); ?></a>
                        </li>
                        <li class="annual-billing">
                            <a data-toggle="tab" href="#bill_monthly_statistics" class=""><?php echo e(__('Monthly Statistics')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="bill_weekly_statistics" class="tab-pane in active">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Bill Generated')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billTotal'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billPaid'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billDue'])); ?></h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="bill_monthly_statistics" class="tab-pane">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Bill Generated')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billTotal'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billPaid'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billDue'])); ?></h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div>
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Goal')); ?></h4>
                    <?php $__empty_1 = true; $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $total= $goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['total'];
                            $percentage=$goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'];
                        ?>
                        <div class="card pb-0 mb-4">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <div class="p-4">
                                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Name')); ?></h5>
                                        <h5 class="report-text mb-0"><?php echo e($goal->name); ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="p-4">
                                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Type')); ?></h5>
                                        <h5 class="report-text mb-0"><?php echo e(__(\App\Goal::$goalType[$goal->type])); ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-4">
                                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?></h5>
                                        <h5 class="report-text mb-0"><?php echo e($goal->from .' To '.$goal->to); ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-4">
                                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Target')); ?></h5>
                                        <h5 class="report-text mb-0"><?php echo e(\Auth::user()->priceFormat($total).' of '. \Auth::user()->priceFormat($goal->amount)); ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="p-4">
                                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Progress')); ?></h5>
                                        <h5 class="report-text mb-0"><?php echo e(number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '')); ?>%</h5>
                                    </div>
                                </div>
                                <div class="col-12 px-4">
                                    <div class="progress-wrapper pt-0">
                                        <div class="progress progress-xs mb-0 w-100">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo e(number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '')); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '')); ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="card pb-0">
                            <div class="card-body text-center">
                                <h6><?php echo e(__('There is no goal.')); ?></h6>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="text-danger"><?php echo e(__('Permission Denied')); ?></h4>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/dashboard/account-dashboard.blade.php ENDPATH**/ ?>