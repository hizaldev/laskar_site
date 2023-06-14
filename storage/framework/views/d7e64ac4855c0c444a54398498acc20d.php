<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <div class="row">
            <h5>My Profile</h5>
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
                        <div class="d-flex justify-content-between">
                            <h6>Informasi Personal</h6>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pencil"></i> edit</button>
                            <!-- Start Modal Informasi Personal-->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-6" id="exampleModalLabel">Edit Informasi Profile</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?php echo e(route('users.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
                                                <?php echo method_field('PUT'); ?>
                                                <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="nama_lengkap">Nama Anggota</label>
                                                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->nama_lengkap); ?>" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama Anggota">
                                                                <input type="hidden" value="personal" name="type">
                                                                <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="nipeg">Nipeg Anggota</label>
                                                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['nipeg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->nipeg); ?>" name="nipeg" id="nipeg" placeholder="Masukan Nipeg Anggota">
                                                                <?php $__errorArgs = ['nipeg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="email">Email Anggota</label>
                                                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->email); ?>" name="email" id="email" placeholder="Masukan Email Anggota">
                                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="tempat_lahir">Tempat & Tgl Lahir Anggota</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->tempat_lahir); ?>" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir Anggota">
                                                                        <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="date" class="form-control form-control-sm <?php $__errorArgs = ['tgl_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->tgl_lahir); ?>" name="tgl_lahir" id="tgl_lahir" placeholder="tgl lahir">
                                                                        <?php $__errorArgs = ['tgl_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="tempat_lahir">Jenis Kelamin</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" <?php echo e($item->jenis_kelamin == 'Laki-Laki' ? 'checked' : ''); ?>>
                                                                    <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" <?php echo e($item->jenis_kelamin == 'Perempuan' ? 'checked' : ''); ?>>
                                                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="no_telpon">No HP/WA Anggota</label>
                                                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['no_telpon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->no_telpon); ?>" name="no_telpon" id="no_telpon" placeholder="Masukan No Telpon / WA Anggota">
                                                                <?php $__errorArgs = ['no_telpon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="description">Alamat</label>
                                                            
                                                                <textarea class="form-control form-control-sm <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="alamat" id="alamat" placeholder="Alamat" rows="5"><?php echo e($item->alamat); ?></textarea>
                                                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="unit_id">Unit Anggota <span class="text-danger">*</span></label>
                                                                <select name="unit_id" class="form-control form-select-sm <?php $__errorArgs = ['unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="unit_id" required>
                                                                    <option value="">-- Pilih Unit --</option>
                                                                    <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $units): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($units->id); ?>" <?php echo e($units->id == $item->unit_id ? 'selected' : ''); ?>><?php echo e($units->unit); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php $__errorArgs = ['unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="grade">Grade <span class="text-danger">*</span></label>
                                                                <select name="grade" class="form-control form-select-sm <?php $__errorArgs = ['grade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="grade" required>
                                                                    <option value="">-- Pilih Grade --</option>
                                                                    <option value="8" <?php echo e($item->grade == '8' ? 'selected' : ''); ?>>8</option>
                                                                    <option value="9" <?php echo e($item->grade == '9' ? 'selected' : ''); ?>>9</option>
                                                                    <option value="10" <?php echo e($item->grade == '10' ? 'selected' : ''); ?>>10</option>
                                                                    <option value="11" <?php echo e($item->grade == '11' ? 'selected' : ''); ?>>11</option>
                                                                    <option value="12" <?php echo e($item->grade == '12' ? 'selected' : ''); ?>>12</option>
                                                                    <option value="13" <?php echo e($item->grade == '13' ? 'selected' : ''); ?>>13</option>
                                                                    <option value="14" <?php echo e($item->grade == '14' ? 'selected' : ''); ?>>14</option>
                                                                    <option value="15" <?php echo e($item->grade == '15' ? 'selected' : ''); ?>>15</option>
                                                                    <option value="16" <?php echo e($item->grade == '16' ? 'selected' : ''); ?>>16</option>
                                                                </select>
                                                                <?php $__errorArgs = ['size_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="agama">Agama Anggota <span class="text-danger">*</span></label><br>
                                                                <select name="agama" class="form-control <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="agama" required>
                                                                    <option value="">-- Pilih Agama --</option>
                                                                    <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($religions->agama); ?>" <?php echo e($religions->agama == $item->agama ? 'selected' : ''); ?>><?php echo e($religions->agama); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php $__errorArgs = ['size_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="type_blood_id">Golongan Darah Anggota <span class="text-danger">*</span></label>
                                                                <select name="golongan_darah" class="form-control form-select-sm <?php $__errorArgs = ['golongan_darah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="golongan_darah" required>
                                                                    <option value="">-- Pilih Golongan Darah --</option>
                                                                    <?php $__currentLoopData = $type_blood; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_bloods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($type_bloods->golongan_darah); ?>" <?php echo e($item->golongan_darah == $type_bloods->golongan_darah ? 'selected' : ''); ?>><?php echo e($type_bloods->golongan_darah); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php $__errorArgs = ['golongan_darah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="tempat_lahir">Bank & No Rekening Anggota</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <select name="bank_id" class="form-control <?php $__errorArgs = ['bank_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="bank_id" required>
                                                                            <option value="">-- Pilih Bank --</option>
                                                                            <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($banks->id); ?>" <?php echo e($item->bank_id == $banks->id ? 'selected' : ''); ?>><?php echo e($banks->bank); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <?php $__errorArgs = ['bank_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="number" class="form-control form-control-sm <?php $__errorArgs = ['no_rekening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($item->no_rekening); ?>" name="no_rekening" id="no_rekening" placeholder="Masukan No Rekening  ">
                                                                        <?php $__errorArgs = ['no_rekening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        

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
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card mb-3 h-100">
                            <div class="card-body">
                                
                                <div class="d-flex justify-content-between">
                                    <h6>Informasi Keanggotaan</h6>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#keanggotaanModal"><i class="fa-solid fa-pencil"></i> edit</button>
                                </div>
        
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
                                        <div class="mb-3">
                                            <div class="text-muted">Masuk dalam kepengurusan DPP?</div>
                                            <strong><?php echo e($item->is_dpp == 'NO' ? "Tidak" : "Ya"); ?></strong>
                                        </div>
                                        <!-- Start Modal Informasi Personal-->
                                            <div class="modal fade" id="keanggotaanModal" tabindex="-1" aria-labelledby="keanggotaanModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-6" id="exampleModalLabel">Edit Informasi Keanggotaan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?php echo e(route('users.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
                                                            <?php echo method_field('PUT'); ?>
                                                            <?php echo csrf_field(); ?>
                                                        <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-3">
                                                                            <label for="dpd_id">DPD Anggota <span class="text-danger">*</span></label><br>
                                                                            <select name="dpd_id" class="form-control <?php $__errorArgs = ['dpd_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="dpd_id" required><br>
                                                                                <option value="">-- Pilih DPD --</option>
                                                                                <?php $__currentLoopData = $dpd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($dpds->id); ?>" <?php echo e($item->dpd_id == $dpds->id ? 'selected' : ''); ?>><?php echo e($dpds->dpd); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                            <?php $__errorArgs = ['dpd_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label for="dpc_id">DPC Anggota <span class="text-danger">*</span></label><br>
                                                                            <select name="dpc_id" class="form-control <?php $__errorArgs = ['dpc_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="dpc_id">
                                                                                <option value="">-- Pilih DPC --</option>
                                                                                <?php $__currentLoopData = $dpc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpcs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($dpcs->id); ?>" <?php echo e($item->dpc_id == $dpcs->id ? 'selected' : ''); ?>><?php echo e($dpcs->dpc); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                            <?php $__errorArgs = ['dpc_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label for="size_id">Ukuran Baju Anggota <span class="text-danger">*</span></label><br>
                                                                            <select name="size_id" class="form-control form-select-sm <?php $__errorArgs = ['size_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="size_id" required>
                                                                                <option value="">-- Pilih Ukuran Baju --</option>
                                                                                <?php $__currentLoopData = $size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sizes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($sizes->id); ?>" <?php echo e($sizes->id == $item->size_id ? 'selected' : ''); ?>><?php echo e($sizes->ukuran); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                            <?php $__errorArgs = ['size_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card mb-3 h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6>Informasi Minat</h6>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pencil"></i> edit</button>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="text-muted">Hobby</div>
                                            <strong>Fitur Ini Segera Haidr</strong>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted">Skills</div>
                                            <strong>Fitur Ini Segera Haidr</strong>
                                        </div>
                                        
                                    </div>
                                   
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('addon-script'); ?>
    <script src="<?php echo e(asset('js/jquery-3.5.1.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $("#agama").select2({
            theme: "bootstrap-5",
            width: '100%',
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#size_id").select2({
            theme: "bootstrap-5",
            width: '100%',
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#dpd_id").select2({
            theme: "bootstrap-5",
            width: '100%',
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#dpc_id").select2({
            theme: "bootstrap-5",
            width: '100%',
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#bank_id").select2({
            theme: "bootstrap-5",
            width: '100%',
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/settings/user/show.blade.php ENDPATH**/ ?>