<?php $__env->startSection('title', 'My Profile - Alfawzan Driving School'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="ti ti-user-circle me-2 text-primary"></i>My Profile</h2>
                <p class="text-muted mb-0 mt-1">Manage your account information and settings</p>
            </div>
            <a href="<?php echo e(route('user.profile.edit')); ?>" class="btn btn-primary">
                <i class="ti ti-pencil me-2"></i>Edit Profile
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="ti ti-user me-2"></i>Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong class="text-muted">Full Name:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0"><?php echo e(auth()->user()->name); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong class="text-muted">Email Address:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0"><?php echo e(auth()->user()->email); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong class="text-muted">Phone Number:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0"><?php echo e(auth()->user()->phone ?? 'Not provided'); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong class="text-muted">Address:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0"><?php echo e(auth()->user()->address ?? 'Not provided'); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <strong class="text-muted">Account Type:</strong>
                    </div>
                    <div class="col-md-9">
                        <span class="badge bg-<?php echo e(auth()->user()->isAdmin() ? 'danger' : (auth()->user()->isAgent() ? 'warning' : 'primary')); ?>">
                            <?php echo e(ucfirst(auth()->user()->role)); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="ti ti-shield-check me-2"></i>Account Security</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong class="text-muted">Member Since:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0"><?php echo e(auth()->user()->created_at->format('F d, Y')); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <strong class="text-muted">Last Updated:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0"><?php echo e(auth()->user()->updated_at->format('F d, Y')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/profile/show.blade.php ENDPATH**/ ?>