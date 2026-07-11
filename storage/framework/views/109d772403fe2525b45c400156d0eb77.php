<?php $__env->startSection('title', 'My Receipts'); ?>

<?php $__env->startSection('content'); ?>
<h2>My Receipts</h2>

<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>Receipt Number</th>
            <th>Payment Reference</th>
            <th>Amount</th>
            <th>Generated At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($receipt->receipt_number); ?></td>
            <td><?php echo e($receipt->payment->payment_reference); ?></td>
            <td>₦<?php echo e(number_format($receipt->payment->amount, 2)); ?></td>
            <td><?php echo e($receipt->generated_at->format('M d, Y H:i')); ?></td>
            <td>
                <a href="<?php echo e(route('user.receipts.show', $receipt)); ?>" class="btn btn-sm btn-info">View</a>
                <a href="<?php echo e(route('user.receipts.download', $receipt)); ?>" class="btn btn-sm btn-success">Download</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo e($receipts->links()); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/user/receipts/index.blade.php ENDPATH**/ ?>