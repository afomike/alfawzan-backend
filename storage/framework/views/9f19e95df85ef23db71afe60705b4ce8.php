<?php $__env->startSection('title', 'Register - Alfawzan Driving School'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px;">
                        <i class="ti ti-user-plus text-white icon-xl"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Student Registration</h2>
                    <p class="text-muted">Fill in your details to enroll at Alfawzan Driving School</p>
                </div>

                <form method="POST" action="<?php echo e(route('driving-school.register')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">
                                <i class="ti ti-user me-1 text-primary"></i>Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="full_name" name="full_name" value="<?php echo e(old('full_name')); ?>"
                                   placeholder="Enter your full name" required>
                            <?php $__errorArgs = ['full_name'];
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

                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                <i class="ti ti-mail me-1 text-primary"></i>Email Address <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="email" name="email" value="<?php echo e(old('email')); ?>"
                                   placeholder="Enter your email" required>
                            <?php $__errorArgs = ['email'];
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

                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                <i class="ti ti-phone me-1 text-primary"></i>Phone Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="phone" name="phone" value="<?php echo e(old('phone')); ?>"
                                   placeholder="+234 800 000 0000" required>
                            <?php $__errorArgs = ['phone'];
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

                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">
                                <i class="ti ti-calendar me-1 text-primary"></i>Date of Birth <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="date_of_birth" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" required>
                            <?php $__errorArgs = ['date_of_birth'];
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

                        <div class="col-12">
                            <label for="address" class="form-label">
                                <i class="ti ti-map-pin me-1 text-primary"></i>Home Address <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      id="address" name="address" rows="3"
                                      placeholder="Enter your full address" required><?php echo e(old('address')); ?></textarea>
                            <?php $__errorArgs = ['address'];
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

                        <div class="col-12">
                            <label for="license_type" class="form-label">
                                <i class="ti ti-id-badge me-1 text-primary"></i>License Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select <?php $__errorArgs = ['license_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="license_type" name="license_type" required>
                                <option value="">Select License Type</option>
                                <option value="Class A" <?php echo e(old('license_type') == 'Class A' ? 'selected' : ''); ?>>Class A — Motorcycle</option>
                                <option value="Class B" <?php echo e(old('license_type') == 'Class B' ? 'selected' : ''); ?>>Class B — Car</option>
                                <option value="Class C" <?php echo e(old('license_type') == 'Class C' ? 'selected' : ''); ?>>Class C — Truck</option>
                                <option value="Class D" <?php echo e(old('license_type') == 'Class D' ? 'selected' : ''); ?>>Class D — Bus</option>
                            </select>
                            <?php $__errorArgs = ['license_type'];
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

                        <div class="col-12">
                            <label for="additional_info" class="form-label">
                                <i class="ti ti-notes me-1 text-primary"></i>Additional Information
                            </label>
                            <textarea class="form-control" id="additional_info" name="additional_info" rows="3"
                                      placeholder="Any additional notes or information (optional)"><?php echo e(old('additional_info')); ?></textarea>
                        </div>

                        <div class="col-12">
                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="ti ti-send me-2"></i>Submit Registration
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted mb-0">Already have an account?
                        <a href="<?php echo e(route('login')); ?>" class="text-primary text-decoration-none fw-semibold">Login here</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="ti ti-shield-check text-success icon-lg"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">FRSC Accredited</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Licensed institution</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="ti ti-award text-primary icon-lg"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">KASTLEA Certified</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Quality assured</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm">
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="ti ti-lock text-info icon-lg"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Secure & Private</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Your data is safe</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/driving-school/register.blade.php ENDPATH**/ ?>