<?php $__env->startSection('title', 'Payment Reference Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Payment Reference Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Reference ID:</dt>
            <dd class="col-sm-9"><code><?php echo e($paymentReference->reference_id); ?></code></dd>

            <dt class="col-sm-3">User:</dt>
            <dd class="col-sm-9"><?php echo e($paymentReference->user ? $paymentReference->user->name : 'N/A'); ?></dd>

            <dt class="col-sm-3">Amount:</dt>
            <dd class="col-sm-9">₦<?php echo e(number_format($paymentReference->amount, 2)); ?></dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-<?php echo e($paymentReference->status === 'used' ? 'success' : ($paymentReference->status === 'expired' ? 'danger' : 'warning')); ?>"><?php echo e(ucfirst($paymentReference->status)); ?></span></dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9"><?php echo e($paymentReference->description ?? 'N/A'); ?></dd>

            <dt class="col-sm-3">Expires At:</dt>
            <dd class="col-sm-9"><?php echo e($paymentReference->expires_at ? $paymentReference->expires_at->format('M d, Y H:i') : 'Never'); ?></dd>

            <dt class="col-sm-3">Created By:</dt>
            <dd class="col-sm-9"><?php echo e($paymentReference->creator->name); ?></dd>

            <?php if($paymentReference->payment): ?>
            <dt class="col-sm-3">Payment:</dt>
            <dd class="col-sm-9">
                <a href="<?php echo e(route('admin.payments.show', $paymentReference->payment)); ?>"><?php echo e($paymentReference->payment->payment_reference); ?></a>
            </dd>
            <?php endif; ?>
        </dl>

        <a href="<?php echo e(route('admin.payment-references.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/admin/payment-references/show.blade.php ENDPATH**/ ?>