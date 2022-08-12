<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profit & Loss Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var year = '<?php echo e($currentYear); ?>';
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            <?php echo e(Form::open(array('route' => array('report.profit.loss.summary'),'method' => 'GET','id'=>'report_profit_loss_summary'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('year', __('Year'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_profit_loss_summary').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('report.profit.loss.summary')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Profit && Loss Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e(__('Profit && Loss Summary')); ?></h5>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="pb-3"><?php echo e(__('Income')); ?></h5>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th width="25%"><?php echo e(__('Category')); ?></th>
                                            <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th width="15%"><?php echo e($m); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Revenue : ')); ?></span></td>
                                        </tr>
                                        <?php if(!empty($revenueIncomeArray)): ?>
                                            <?php $__currentLoopData = $revenueIncomeArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($revenue['category']); ?></td>
                                                    <?php $__currentLoopData = $revenue['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <tr>
                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Invoice : ')); ?></span></td>
                                        </tr>
                                        <?php if(!empty($invoiceIncomeArray)): ?>
                                            <?php $__currentLoopData = $invoiceIncomeArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($invoice['category']); ?></td>
                                                    <?php $__currentLoopData = $invoice['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush border">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="13" class="text-dark"><span><?php echo e(__('Total Income =  Revenue + Invoice ')); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%" class="text-dark"><?php echo e(__('Total Income')); ?></td>
                                                        <?php $__currentLoopData = $totalIncome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td width="15%"><?php echo e(\Auth::user()->priceFormat($income)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <h5 class="pb-3"><?php echo e(__('Expense')); ?></h5>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="dataTable-manual">
                                        <thead>
                                        <tr>
                                            <th width="25%"><?php echo e(__('Category')); ?></th>
                                            <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th width="15%"><?php echo e($m); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Payment : ')); ?></span></td>
                                        </tr>
                                        <?php if(!empty($expenseArray)): ?>
                                            <?php $__currentLoopData = $expenseArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($expense['category']); ?></td>
                                                    <?php $__currentLoopData = $expense['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Bill : ')); ?></span></td>
                                        </tr>
                                        <?php if(!empty($billExpenseArray)): ?>
                                            <?php $__currentLoopData = $billExpenseArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($bill['category']); ?></td>
                                                    <?php $__currentLoopData = $bill['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush border" id="dataTable-manual">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="13" class="text-dark"><span><?php echo e(__('Total Expense =  Payment + Bill ')); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark"><?php echo e(__('Total Expenses')); ?></td>
                                                        <?php $__currentLoopData = $totalExpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td width="15%"><?php echo e(\Auth::user()->priceFormat($expense)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush border" id="dataTable-manual">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="13" class="text-dark"><span><?php echo e(__('Net Profit = Total Income - Total Expense ')); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%" class="text-dark"><?php echo e(__('Net Profit')); ?></td>
                                                        <?php $__currentLoopData = $netProfitArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td width="15%"> <?php echo e(\Auth::user()->priceFormat($profit)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/report/profit_loss_summary.blade.php ENDPATH**/ ?>