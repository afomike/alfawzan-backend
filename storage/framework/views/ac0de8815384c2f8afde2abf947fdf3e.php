<?php $__env->startSection('title', 'Agent Link Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Agent Link Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Name:</dt>
            <dd class="col-sm-9"><?php echo e($agentLink->name); ?></dd>

            <dt class="col-sm-3">Agent:</dt>
            <dd class="col-sm-9"><?php echo e($agentLink->agent ? $agentLink->agent->name : 'N/A'); ?></dd>

            <dt class="col-sm-3">Unique Link:</dt>
            <dd class="col-sm-9"><a href="<?php echo e($agentLink->full_url); ?>" target="_blank"><?php echo e($agentLink->full_url); ?></a></dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-<?php echo e($agentLink->is_active ? 'success' : 'danger'); ?>"><?php echo e($agentLink->is_active ? 'Active' : 'Inactive'); ?></span></dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9"><?php echo e($agentLink->description ?? 'N/A'); ?></dd>

            <dt class="col-sm-3">Created By:</dt>
            <dd class="col-sm-9"><?php echo e($agentLink->creator->name); ?></dd>

            <dt class="col-sm-3">Total Payments:</dt>
            <dd class="col-sm-9"><?php echo e($agentLink->payments->count()); ?></dd>
        </dl>

        <h5 class="mt-4">Payments</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $agentLink->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($payment->payment_reference); ?></td>
                    <td><?php echo e($payment->user->name); ?></td>
                    <td>₦<?php echo e(number_format($payment->amount, 2)); ?></td>
                    <td><span class="badge bg-<?php echo e($payment->status === 'paid' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($payment->status)); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <a href="<?php echo e(route('admin.agent-links.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/admin/agent-links/show.blade.php ENDPATH**/ ?>