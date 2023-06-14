<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header"><strong>Pengaturan Role</strong></div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('permisions.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo e($item->name); ?>" id="exampleInputName1" placeholder="Enter Role Name">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mr-2 mt-2">Submit</button>
                            <a href="#" class="btn btn-secondary btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.c  ontent-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-style'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('addon-script'); ?>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/settings/permission/edit.blade.php ENDPATH**/ ?>