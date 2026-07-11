<?php $__env->startSection('title', 'Payment References'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="ti ti-receipt me-2"></i>Payment References</h2>
        <p class="text-muted mb-0">Generate and manage payment reference IDs for users</p>
    </div>
    <a href="<?php echo e(route('admin.payment-references.create')); ?>" class="btn btn-primary">
        <i class="ti ti-plus me-2"></i>Generate New Reference
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Reference ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Expires At</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <code class="bg-light px-2 py-1 rounded"><?php echo e($reference->reference_id); ?></code>
                        </td>
                        <td>
                            <?php if($reference->user): ?>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                        <?php echo e(strtoupper(substr($reference->user->name, 0, 1))); ?>

                                    </div>
                                    <?php echo e($reference->user->name); ?>

                                </div>
                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>₦<?php echo e(number_format($reference->amount, 2)); ?></strong></td>
                        <td>
                            <span class="badge bg-<?php echo e($reference->status === 'used' ? 'success' : ($reference->status === 'expired' ? 'danger' : 'warning')); ?>">
                                <?php echo e(ucfirst($reference->status)); ?>

                            </span>
                        </td>
                        <td><?php echo e($reference->expires_at ? $reference->expires_at->format('M d, Y') : 'Never'); ?></td>
                        <td><?php echo e($reference->creator->name); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('admin.payment-references.show', $reference)); ?>" class="btn btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php if(!$reference->isUsed()): ?>
                                <form action="<?php echo e(route('admin.payment-references.destroy', $reference)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this reference?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #cbd5e1;"></i>
                            <p class="text-muted mt-3">No payment references found. Generate your first reference to get started!</p>
                            <a href="<?php echo e(route('admin.payment-references.create')); ?>" class="btn btn-primary mt-2">
                                <i class="ti ti-plus me-2"></i>Generate Reference
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($references->hasPages()): ?>
    <div class="card-footer bg-white">
        <?php echo e($references->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/admin/payment-references/index.blade.php ENDPATH**/ ?>