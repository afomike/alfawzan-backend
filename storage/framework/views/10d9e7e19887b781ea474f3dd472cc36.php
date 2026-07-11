<?php $__env->startSection('title', 'Agent Payment Link'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><?php echo e($agentLink->name); ?></h4>
            </div>
            <div class="card-body">
                <?php if($agentLink->description): ?>
                <p><?php echo e($agentLink->description); ?></p>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                <div class="alert alert-info">
                    <p>You are logged in. You can proceed to make a payment.</p>
                    <a href="<?php echo e(route('user.payments.create')); ?>" class="btn btn-primary">Make Payment</a>
                </div>
                <?php else: ?>
                <div class="alert alert-warning">
                    <p>Please login to make a payment using this agent link.</p>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Login</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/agent/link.blade.php ENDPATH**/ ?>