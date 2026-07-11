<?php $__env->startSection('title', 'Payment Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Payment Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Payment Reference:</dt>
            <dd class="col-sm-9"><code><?php echo e($payment->payment_reference); ?></code></dd>

            <dt class="col-sm-3">Amount:</dt>
            <dd class="col-sm-9">₦<?php echo e(number_format($payment->amount, 2)); ?></dd>

            <dt class="col-sm-3">Payment Method:</dt>
            <dd class="col-sm-9"><?php echo e(ucfirst($payment->payment_method)); ?></dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-<?php echo e($payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning')); ?>"><?php echo e(ucfirst($payment->status)); ?></span></dd>

            <?php if($payment->reference_id): ?>
            <dt class="col-sm-3">Reference ID:</dt>
            <dd class="col-sm-9"><code><?php echo e($payment->reference_id); ?></code></dd>
            <?php endif; ?>

            <?php if($payment->paystack_reference): ?>
            <dt class="col-sm-3">Paystack Reference:</dt>
            <dd class="col-sm-9"><?php echo e($payment->paystack_reference); ?></dd>
            <?php endif; ?>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9"><?php echo e($payment->description ?? 'N/A'); ?></dd>

            <dt class="col-sm-3">Date:</dt>
            <dd class="col-sm-9"><?php echo e($payment->created_at->format('M d, Y H:i')); ?></dd>

            <?php if($payment->receipt): ?>
            <dt class="col-sm-3">Receipt:</dt>
            <dd class="col-sm-9">
                <a href="<?php echo e(route('user.receipts.show', $payment->receipt)); ?>" class="btn btn-primary">View Receipt</a>
                <a href="<?php echo e(route('user.receipts.download', $payment->receipt)); ?>" class="btn btn-success">Download Receipt</a>
            </dd>
            <?php endif; ?>
        </dl>

        <a href="<?php echo e(route('user.payments.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/user/payments/show.blade.php ENDPATH**/ ?>