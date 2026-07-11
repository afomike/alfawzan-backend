<?php $__env->startSection('title', 'Document Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Document Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Title:</dt>
            <dd class="col-sm-9"><?php echo e($document->title); ?></dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9"><?php echo e($document->description ?? 'N/A'); ?></dd>

            <dt class="col-sm-3">File Name:</dt>
            <dd class="col-sm-9"><?php echo e($document->file_name); ?></dd>

            <dt class="col-sm-3">File Size:</dt>
            <dd class="col-sm-9"><?php echo e(number_format($document->file_size / 1024, 2)); ?> KB</dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-<?php echo e($document->is_active ? 'success' : 'danger'); ?>"><?php echo e($document->is_active ? 'Active' : 'Inactive'); ?></span></dd>

            <dt class="col-sm-3">Uploaded By:</dt>
            <dd class="col-sm-9"><?php echo e($document->uploader->name); ?></dd>

            <dt class="col-sm-3">Uploaded At:</dt>
            <dd class="col-sm-9"><?php echo e($document->created_at->format('M d, Y H:i')); ?></dd>
        </dl>

        <a href="<?php echo e(Storage::url($document->file_path)); ?>" target="_blank" class="btn btn-primary">View Document</a>
        <a href="<?php echo e(route('admin.documents.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/admin/documents/show.blade.php ENDPATH**/ ?>