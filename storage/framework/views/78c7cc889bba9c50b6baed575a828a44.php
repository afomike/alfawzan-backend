<?php $__env->startSection('title', 'Receipt Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Receipt Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Receipt Number:</dt>
            <dd class="col-sm-9"><code><?php echo e($receipt->receipt_number); ?></code></dd>

            <dt class="col-sm-3">Payment Reference:</dt>
            <dd class="col-sm-9"><?php echo e($receipt->payment->payment_reference); ?></dd>

            <dt class="col-sm-3">Amount:</dt>
            <dd class="col-sm-9">₦<?php echo e(number_format($receipt->payment->amount, 2)); ?></dd>

            <dt class="col-sm-3">Payment Method:</dt>
            <dd class="col-sm-9"><?php echo e(ucfirst($receipt->payment->payment_method)); ?></dd>

            <dt class="col-sm-3">Generated At:</dt>
            <dd class="col-sm-9"><?php echo e($receipt->generated_at->format('M d, Y H:i')); ?></dd>

            <?php if($receipt->signature_path): ?>
            <dt class="col-sm-3">Digital Signature:</dt>
            <dd class="col-sm-9">
                <img src="<?php echo e(Storage::url($receipt->signature_path)); ?>" alt="Digital Signature" style="max-width: 200px;">
            </dd>
            <?php endif; ?>
        </dl>

        <div class="mt-4">
            <a href="<?php echo e(route('user.receipts.download', $receipt)); ?>" class="btn btn-primary">Download PDF</a>
            <a href="<?php echo e(route('user.receipts.index')); ?>" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/user/receipts/show.blade.php ENDPATH**/ ?>