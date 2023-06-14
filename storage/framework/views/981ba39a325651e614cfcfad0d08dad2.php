<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <div class="row">
            <h5>Informasi Data Anggota</h5>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" class="img-thumbnail" width="100" height="100" alt="...">
                            </div>
                            <div class="p-4 d-flex flex-column mb-3">
                                <strong><?php echo e($item->nama_lengkap); ?></strong>
                                <span class="text-muted"><?php echo e($item->nipeg); ?></span>
                                <span class="text-muted"><?php echo e($item->email); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Informasi Personal</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">Nama Lengkap</div>
                                    <strong><?php echo e($item->nama_lengkap); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Nipeg</div>
                                    <strong><?php echo e($item->nipeg); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Email</div>
                                    <strong><?php echo e($item->email); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Tempat & Tanggal Lahir</div>
                                    <strong><?php echo e($item->tempat_lahir); ?>, <?php echo e($item->tgl_lahir); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">No Telpon / Wa</div>
                                    <strong><?php echo e($item->no_telpon); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Agama</div>
                                    <strong><?php echo e($item->agama); ?></strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">Unit</div>
                                    <strong><?php echo e($item->unit->unit); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Grade</div>
                                    <strong><?php echo e($item->grade); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Golongan Darah</div>
                                    <strong><?php echo e($item->golongan_darah); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Jenis Kelamin</div>
                                    <strong><?php echo e($item->jenis_kelamin); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Informasi Bank</div>
                                    <strong><?php echo e($item->bank->bank); ?> No Rek. <?php echo e($item->no_rekening); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">alamat</div>
                                    <strong><?php echo e($item->alamat); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Informasi Keanggotaan</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">Nomor Anggota Laskar</div>
                                    <strong><?php echo e($item->no_anggota); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Tanggal Masuk Laskar</div>
                                    <strong><?php echo e($item->created_at); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Nomor Pendaftaran Anggota Laskar</div>
                                    <strong><?php echo e($item->no_pendaftaran); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Tanggal Pendaftaran Laskar</div>
                                    <strong><?php echo e($item->tgl_pendaftaran); ?></strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">DPD</div>
                                    <strong><?php echo e($item->dpd->dpd); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">DPC</div>
                                    <strong><?php echo e($item->dpc == null ? '-' : $item->dpc->dpc); ?></strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Ukuran Baju</div>
                                    <strong><?php echo e($item->size->ukuran); ?></strong>
                                </div>
                            </div>
                        </div>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/keanggotaan/anggota/show.blade.php ENDPATH**/ ?>