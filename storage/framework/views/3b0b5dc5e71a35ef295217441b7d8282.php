<?php $__env->startSection('title', 'Admin Dashboard - Alfawzan Driving School'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-2">Dashboard Overview</h2>
        <p class="text-muted mb-0" style="font-size: 1.1rem;">Welcome back, <strong style="color: var(--primary);"><?php echo e(auth()->user()->name); ?></strong>! Here's your comprehensive system analytics.</p>
    </div>
    <div class="mt-3 mt-md-0">
        <span class="badge bg-success px-4 py-2" style="font-size: 0.9rem;"><i class="ti ti-circle-check me-2"></i>System Active</span>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Users</p>
                    <h3><?php echo e($stats['total_users']); ?></h3>
                    <p class="mb-0 mt-2"><i class="bi bi-arrow-up text-success me-1"></i><small class="text-muted">All registered users</small></p>
                </div>
                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-users text-primary icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-users"></i>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Revenue</p>
                    <h3>₦<?php echo e(number_format($stats['total_revenue'] / 1000, 1)); ?>K</h3>
                    <p class="mb-0 mt-2"><i class="bi bi-graph-up text-success me-1"></i><small class="text-muted">All time earnings</small></p>
                </div>
                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-currency-naira text-success icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-currency-naira"></i>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Pending Payments</p>
                    <h3><?php echo e($stats['pending_payments']); ?></h3>
                    <p class="mb-0 mt-2"><i class="bi bi-hourglass-split text-warning me-1"></i><small class="text-muted">Awaiting processing</small></p>
                </div>
                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-clock-hour-4 text-warning icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-clock-hour-4"></i>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Documents</p>
                    <h3><?php echo e($stats['total_documents']); ?></h3>
                    <p class="mb-0 mt-2"><i class="bi bi-folder text-info me-1"></i><small class="text-muted">Available files</small></p>
                </div>
                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-file-type-pdf text-info icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-file-type-pdf"></i>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold"><i class="ti ti-chart-line me-2 text-primary"></i>Revenue Analytics</h5>
                    <small class="text-muted">Monthly revenue performance over the last 12 months</small>
                </div>
                <span class="badge bg-primary px-3 py-2">Monthly View</span>
            </div>
            <div class="card-body p-4">
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                    <h5 class="mb-1 fw-bold"><i class="ti ti-chart-pie me-2 text-success"></i>Payment Status</h5>
                <small class="text-muted">Current payment distribution</small>
            </div>
            <div class="card-body p-4">
                <canvas id="paymentStatusChart"></canvas>
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
                        <div>
                            <div class="fw-bold text-success" style="font-size: 1.5rem;"><?php echo e($paidPayments); ?></div>
                            <small class="text-muted fw-semibold">Paid Transactions</small>
                        </div>
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ti ti-check text-white icon-lg"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);">
                        <div>
                            <div class="fw-bold text-warning" style="font-size: 1.5rem;"><?php echo e($stats['pending_payments']); ?></div>
                            <small class="text-muted fw-semibold">Pending Transactions</small>
                        </div>
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ti ti-hourglass text-white icon-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold"><i class="ti ti-credit-card me-2 text-primary"></i>Recent Payments</h5>
                    <small class="text-muted">Latest transaction activities</small>
                </div>
                <a href="<?php echo e(route('admin.payments.index')); ?>" class="btn btn-sm btn-outline-primary">
                    View All <i class="ti ti-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded small"><?php echo e(Str::limit($payment->payment_reference, 10)); ?></code>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-size: 0.85rem; font-weight: 700;">
                                            <?php echo e(strtoupper(substr($payment->user->name, 0, 1))); ?>

                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?php echo e(Str::limit($payment->user->name, 18)); ?></div>
                                            <small class="text-muted"><?php echo e(Str::limit($payment->user->email, 20)); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong class="text-success" style="font-size: 1.1rem;">₦<?php echo e(number_format($payment->amount, 2)); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo e($payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning')); ?>">
                                        <?php echo e(ucfirst($payment->status)); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-inbox text-muted" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <p class="text-muted mb-0 fw-semibold">No payments yet</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold"><i class="ti ti-users-group me-2 text-info"></i>Recent Users</h5>
                    <small class="text-muted">New user registrations</small>
                </div>
                <span class="badge bg-primary px-3 py-2"><?php echo e($stats['total_users']); ?> Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 42px; height: 42px; font-size: 0.9rem; font-weight: 700;">
                                            <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                        </div>
                                        <div class="fw-semibold"><?php echo e(Str::limit($user->name, 22)); ?></div>
                                    </div>
                                </td>
                                <td><small class="text-muted"><?php echo e(Str::limit($user->email, 28)); ?></small></td>
                                <td><small class="text-muted fw-semibold"><?php echo e($user->created_at->diffForHumans()); ?></small></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-people text-muted" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <p class="text-muted mb-0 fw-semibold">No users yet</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue (₦)',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?php echo e($stats['total_revenue']); ?>],
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.5,
                fill: true,
                borderWidth: 4,
                pointRadius: 7,
                pointHoverRadius: 10,
                pointBackgroundColor: 'rgb(99, 102, 241)',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointHoverBackgroundColor: 'rgb(99, 102, 241)',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.95)',
                    padding: 16,
                    titleFont: { family: 'Poppins', size: 14, weight: 'bold' },
                    bodyFont: { family: 'Inter', size: 13, weight: '500' },
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '₦' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { 
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return '₦' + value.toLocaleString();
                        },
                        font: { family: 'Poppins', weight: '600', size: 11 },
                        color: '#64748b'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { 
                        font: { family: 'Poppins', weight: '600', size: 11 },
                        color: '#64748b'
                    }
                }
            }
        }
    });

    const statusCtx = document.getElementById('paymentStatusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Pending'],
            datasets: [{
                data: [<?php echo e($paidPayments); ?>, <?php echo e($stats['pending_payments']); ?>],
                backgroundColor: ['rgb(16, 185, 129)', 'rgb(245, 158, 11)'],
                borderWidth: 0,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 25,
                        font: { family: 'Poppins', size: 12, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle',
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.95)',
                    padding: 12,
                    cornerRadius: 10,
                    font: { family: 'Inter', size: 12 },
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed;
                        }
                    }
                }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>