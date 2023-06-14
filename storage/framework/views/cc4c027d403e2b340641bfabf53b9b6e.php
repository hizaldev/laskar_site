<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Manage Role User</strong></div>
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
                        <form action="<?php echo e(route('roles.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Enter Role Name">
                            </div>
                            <div class="row">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                <?php
                                    $before = 'first';
                                ?>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $data = explode('-', $permision->name);
                                      
                                        ?>
                                        <?php if( $before != $data[0]): ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo e($permision->id); ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne<?php echo e($permision->id); ?>">
                                                    <?php echo e($data[0]); ?>

                                                </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne<?php echo e($permision->id); ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $filter = explode('-', $permit->name)
                                                            ?>
                                                            <?php if($data[0] == $filter[0]): ?>
                                                                <div class="col-3">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked<?php echo e($permit->id); ?>" name="permission[]" value="<?php echo e($permit->id); ?>">
                                                                        <label class="form-check-label" for="flexCheckChecked<?php echo e($permit->id); ?>">
                                                                            <?php echo e($permit->name); ?>

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                        
                                                            <?php endif; ?>
                                                                
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            
                                        <?php endif; ?>
                                        <?php
                                            $before = $data[0];
                                        ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-2">Submit</button>
                            <a href="#" class="btn btn-dark mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Batal</a>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/settings/roles/create.blade.php ENDPATH**/ ?>