<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="fw-bold"> Hallo, Alf Briatna</h1>
            <h5 class="fw-regular text-black-50">Selamat datang kembali ke Aplikasi Laskar PLN</h5>
            <div class="card rounded-4 border-0 bg-primary bg-opacity-25">

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <p class="text-dark">
                        Data anggotanya apakah sudah sesuai? cek terlebih dahulu yuk!! jangan lupa untuk mengupdatenya <br>
                    </p>
                    <button class="btn btn-primary bg-opacity-75">Update Data Keanggotaan User</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
            <div class="card">

                <div class="card-body">
                    <h4>Data anggotanya apakah sudah sesuai? cek terlebih dahulu yuk!! jangan lupa untuk mengupdatenya</h4>
                    <h4>Klik disini untuk memperbarui</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-script'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/home.blade.php ENDPATH**/ ?>