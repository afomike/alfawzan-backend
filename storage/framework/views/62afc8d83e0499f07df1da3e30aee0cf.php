<?php $__env->startSection('title', 'Generate Payment Reference'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom">
                <h4 class="mb-0"><i class="ti ti-plus me-2"></i>Generate Payment Reference ID</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('admin.payment-references.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-semibold">
                            <i class="ti ti-user me-2"></i>User (Optional)
                        </label>
                        <select class="form-select <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="user_id" name="user_id">
                            <option value="">Select User (Optional)</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id') == $user->id ? 'selected' : ''); ?>>
                                    <?php echo e($user->name); ?> (<?php echo e($user->email); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="form-text text-muted">Leave empty to create a general reference ID</small>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="form-label fw-semibold">
                            <i class="ti ti-currency-naira me-2"></i>Amount <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₦</span>
                            <input type="number" step="0.01" class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="amount" name="amount" value="<?php echo e(old('amount')); ?>" required>
                        </div>
                        <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">
                            <i class="ti ti-file-text me-2"></i>Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3" 
                                  placeholder="Payment description (optional)"><?php echo e(old('description')); ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="expires_at" class="form-label fw-semibold">
                            <i class="ti ti-calendar me-2"></i>Expires At (Optional)
                        </label>
                        <input type="datetime-local" class="form-control" id="expires_at" name="expires_at" 
                               value="<?php echo e(old('expires_at')); ?>">
                        <small class="form-text text-muted">Leave empty for no expiration</small>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo e(route('admin.payment-references.index')); ?>" class="btn btn-outline-secondary">
                            <i class="ti ti-x me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-check me-2"></i>Generate Reference
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/admin/payment-references/create.blade.php ENDPATH**/ ?>