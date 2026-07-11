<?php $__env->startSection('title', 'Agent Dashboard - Alfawzan Driving School'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-2">Agent Dashboard</h2>
        <p class="text-muted mb-0" style="font-size: 1.1rem;">Welcome back, <strong style="color: var(--primary);"><?php echo e(auth()->user()->name); ?></strong>! Track your agent links and performance.</p>
    </div>
    <div class="mt-3 mt-md-0">
        <span class="badge bg-success px-4 py-2" style="font-size: 0.9rem;"><i class="ti ti-circle-check me-2"></i>Active Agent</span>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Revenue</p>
                    <h3>₦<?php echo e(number_format($totalPayments, 2)); ?></h3>
                    <p class="mb-0 mt-2"><i class="ti ti-trending-up text-success me-1"></i><small class="text-muted">From all payments</small></p>
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
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Active Links</p>
                    <h3><?php echo e($agentLinks->where('is_active', true)->count()); ?></h3>
                    <p class="mb-0 mt-2"><i class="ti ti-link text-info me-1"></i><small class="text-muted">Currently active</small></p>
                </div>
                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-link text-info icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-link"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <p class="text-muted small mb-2" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Links</p>
                    <h3><?php echo e($agentLinks->count()); ?></h3>
                    <p class="mb-0 mt-2"><i class="ti ti-list-check text-primary me-1"></i><small class="text-muted">All assigned links</small></p>
                </div>
                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                    <i class="ti ti-list text-primary icon-lg"></i>
                </div>
            </div>
            <i class="ti ti-list"></i>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1 fw-bold"><i class="ti ti-link me-2 text-primary"></i>My Agent Links</h5>
            <small class="text-muted">Manage and track your agent referral links</small>
        </div>
        <span class="badge bg-primary px-3 py-2"><?php echo e($agentLinks->count()); ?> Total</span>
    </div>
    <div class="card-body p-0">
        <?php if($agentLinks->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Link Name</th>
                        <th>Unique Link</th>
                        <th>Status</th>
                        <th>Payments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $agentLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="ti ti-link text-primary"></i>
                                </div>
                                <div>
                                    <strong class="fw-semibold"><?php echo e($link->name); ?></strong>
                                    <?php if($link->description): ?>
                                        <br><small class="text-muted"><?php echo e(Str::limit($link->description, 50)); ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <code class="bg-light px-2 py-1 rounded small"><?php echo e(Str::limit($link->full_url, 40)); ?></code>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($link->is_active ? 'success' : 'danger'); ?>">
                                <i class="ti ti-<?php echo e($link->is_active ? 'check' : 'x'); ?> me-1"></i><?php echo e($link->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info">
                                <i class="ti ti-credit-card me-1"></i><?php echo e($link->payments->count()); ?> payments
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('<?php echo e($link->full_url); ?>')" title="Copy Link">
                                <i class="ti ti-copy me-1"></i> Copy
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                <i class="ti ti-inbox text-muted icon-3xl"></i>
            </div>
            <h5 class="text-muted mb-2 fw-bold">No agent links assigned yet</h5>
            <p class="text-muted mb-0">Contact admin to create links for you.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show a nice toast notification instead of alert
        const toast = document.createElement('div');
        toast.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3';
        toast.style.zIndex = '9999';
        toast.innerHTML = '<i class="ti ti-check me-2"></i>Link copied to clipboard!';
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }, function(err) {
        console.error('Failed to copy: ', err);
        alert('Failed to copy link. Please try again.');
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/agent/dashboard.blade.php ENDPATH**/ ?>