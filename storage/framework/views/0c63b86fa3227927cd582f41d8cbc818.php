<?php $__env->startSection('title', 'My Dashboard - Alfawzan Driving School'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-2">My Dashboard</h2>
        <p class="text-muted mb-0" style="font-size: 1.1rem;">Welcome back, <strong style="color: var(--primary);"><?php echo e(auth()->user()->name); ?></strong>! Here's your activity summary.</p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="<?php echo e(route('user.payments.create')); ?>" class="btn btn-primary btn-lg">
            <i class="ti ti-plus me-2"></i>Make Payment
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Payments</p>
                    <h3><?php echo e($payments->count()); ?></h3>
                    <p class="mb-0 mt-2"><i class="bi bi-list-check text-primary me-1"></i><small class="text-muted">All transactions</small></p>
                </div>
                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-credit-card text-primary icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-credit-card"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Spent</p>
                    <h3>₦<?php echo e(number_format($payments->where('status', 'paid')->sum('amount') / 1000, 1)); ?>K</h3>
                    <p class="mb-0 mt-2"><i class="bi bi-check-circle text-success me-1"></i><small class="text-muted">Successful payments</small></p>
                </div>
                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-currency-naira text-success icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-currency-naira"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Receipts</p>
                    <h3><?php echo e($receipts->count()); ?></h3>
                    <p class="mb-0 mt-2"><i class="bi bi-file-earmark text-info me-1"></i><small class="text-muted">Available receipts</small></p>
                </div>
                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-receipt text-info icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-receipt"></i>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold"><i class="ti ti-credit-card me-2 text-primary"></i>Recent Payments</h5>
                    <small class="text-muted">Your latest transaction activities</small>
                </div>
                <a href="<?php echo e(route('user.payments.index')); ?>" class="btn btn-sm btn-outline-primary">
                    View All <i class="ti ti-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <?php if($payments->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><code class="bg-light px-2 py-1 rounded small"><?php echo e(Str::limit($payment->payment_reference, 12)); ?></code></td>
                                <td><strong class="text-success" style="font-size: 1.1rem;">₦<?php echo e(number_format($payment->amount, 2)); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo e($payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning')); ?>">
                                        <?php echo e(ucfirst($payment->status)); ?>

                                    </span>
                                </td>
                                <td><small class="text-muted fw-semibold"><?php echo e($payment->created_at->format('M d, Y')); ?></small></td>
                                <td>
                                    <a href="<?php echo e(route('user.payments.show', $payment)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="text-center py-5">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted mb-2 fw-bold">No payments yet</h5>
                    <p class="text-muted mb-4">Make your first payment to get started!</p>
                    <a href="<?php echo e(route('user.payments.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Make Payment
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold"><i class="ti ti-receipt me-2 text-success"></i>Recent Receipts</h5>
                    <small class="text-muted">Latest receipt downloads</small>
                </div>
                <a href="<?php echo e(route('user.receipts.index')); ?>" class="btn btn-sm btn-outline-success">View All</a>
            </div>
            <div class="card-body p-0">
                <?php if($receipts->count() > 0): ?>
                <div class="list-group list-group-flush">
                    <?php $__currentLoopData = $receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="list-group-item border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 fw-semibold"><?php echo e($receipt->receipt_number); ?></h6>
                                <small class="text-muted"><?php echo e($receipt->generated_at->format('M d, Y')); ?></small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-success mb-2">₦<?php echo e(number_format($receipt->payment->amount, 2)); ?></div>
                                <br>
                                <a href="<?php echo e(route('user.receipts.show', $receipt)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-5">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-receipt text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-muted mb-0 fw-semibold">No receipts yet</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/user/dashboard.blade.php ENDPATH**/ ?>