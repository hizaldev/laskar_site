<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            
            <div class="col-md-6 col-sm-12">
                <h3>
                    <strong>
                        Ayo daftar dan bergabung<br> 
                        dengan serikat yang luar biasa
                    </strong>
                    
                </h3>
                <div class="card mb-4">
                    
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
                        <?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger mt-1 mb-3"><?php echo e($message); ?> wrong</div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <form action="<?php echo e(route('register_members.store')); ?>" id="formRegister" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" id="nama_lengkap" placeholder="Masukan Nama Lengkap">
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
                                <label for="nipeg">Nipeg <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['nipeg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nipeg" value="<?php echo e(old('nipeg')); ?>" id="nipeg" placeholder="Masukan Nipeg">
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
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" id="email" placeholder="Masukan Email">
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
                            <label for="email">Tempat & Tgl Lahir <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="form-group mb-3 col-md-6 col-sm-12">
                                    <select name="tempat_lahir" class="form-control <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tempat_lahir" required>
                                        <option value="">-- Pilih Tempat Lahir --</option>
                                        <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cities->kota); ?>" <?php echo e(old('tempat_lahir') == $cities->kota ? 'selected' : ''); ?>><?php echo e($cities->kota); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
                                <div class="form-group mb-3 col-md-6 sol-sm-12">
                                    <input type="date" class="form-control <?php $__errorArgs = ['tgl_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="tgl_lahir" value="<?php echo e(old('tgl_lahir')); ?>" id="tgl_lahir" placeholder="dd/mm/yyyy">
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
                            <div class="form-group mb-3">
                                <label for="no_telpon">No Whatsapp <span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?php $__errorArgs = ['no_telpon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="no_telpon" value="<?php echo e(old('no_telpon')); ?>" id="no_telpon" placeholder="081xxxxxxxxxxx">
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
                                <label for="unit_id">Unit <span class="text-danger">*</span></label>
                                <select name="unit_id" class="form-control <?php $__errorArgs = ['unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="unit_id" required>
                                    <option value="">-- Pilih Unit --</option>
                                    <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $units): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($units->id); ?>" <?php echo e(old('unit_id') == $units->id ? 'selected' : ''); ?>><?php echo e($units->unit); ?></option>
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
                                <label for="size_id">Ukuran Baju <span class="text-danger">*</span></label>
                                <select name="size_id" class="form-control <?php $__errorArgs = ['size_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="size_id" required>
                                    <option value="">-- Pilih Ukuran Baju --</option>
                                    <?php $__currentLoopData = $size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sizes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($sizes->id); ?>" <?php echo e(old('size_id') == $sizes->id ? 'selected' : ''); ?>><?php echo e($sizes->ukuran); ?></option>
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
                                <label for="grade">Grade <span class="text-danger">*</span></label>
                                <select name="grade" class="form-control <?php $__errorArgs = ['grade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="grade" required>
                                    <option value="">-- Pilih Grade --</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
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
                                <label for="no_telpon">Tanda Tangan Digital <span class="text-danger">*</span></label>
                                <br>
                                
                                <div id="signature-pad" class="signature-pad">
                                    <div class="signature-pad--body text-center" style="color:black;">
                                      <canvas style="border:1px solid black"></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                      <div class="signature-pad--actions text-center">
                                        <div>
                                          <button type="button" class="btn btn-danger btn-sm" data-action="clear">Hapus TTD</button>
                                          <button type="button" class="btn btn-success btn-sm" data-action="save-png" >Simpan TTD</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <br>
                                
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kode_refferal">NIPEG Pengajak</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['kode_refferal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="kode_refferal" id="kode_refferal" placeholder="Masukan NIPEG Yang mengajak jika ada">
                                <?php $__errorArgs = ['kode_refferal'];
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
                                <label for="captcha">Enter Captcha <span class="text-danger">*</span></label>
                                <div class="captcha mb-3">
                                    <span><?php echo captcha_img(); ?></span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    ↻
                                    </button>
                                </div>
                                <input id="captcha" type="number" class="form-control" placeholder="Enter Captcha" name="captcha">

                                <?php $__errorArgs = ['captcha'];
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
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary mr-2 mt-2" onclick="return cekform();">Lanjutkan Pendaftaran</button>
                            </div>
                            
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Condition !! Harap di baca terlebih dahulu !!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Terms and Conditions ini menjelaskan bagaimana Laskar PLN secara elektronis mengumpulkan, menggunakan, mengungkapkan, mengirimkan, menyimpan, mengolah dan melindungi informasi pribadi anda selalku pengelola data. Mohon baca terms and Conditions ini dengan seksama untuk memastikan bahwa anda memahami bagaimana proses pengolahan data kami. Kecuali didefinisikan lain, semua istilah dengan huruf kapital yang digunakan dalam Kebijakan Privasi ini memiliki arti yang sama dengan yang tercantum dalam Syarat dan Ketentuan.<br>
                                                Terms and Condition ini mencakup hal-hal sebagai berikut:
                                            </p>
                                            <p>
                                                Sesuai peraturan dan perundang-undangan yang berlalu saat ini:<br>
                                                <ol>
                                                    <li>Pasal 5 ayat (1) UU No. 21 Tahun 2000 tentang Serikat Pekerja (hak menjadi anggota serikat pekerja)</li>
                                                    <li>Pasal 28 Undang-Undang Nomor 21 Tahun 2000 tentang Serikat Pekerja/Serikat Buruh (UU SP/SB) (perlindungan hak berorganisasi; menjadi anggota atau tidak menjadi anggota)</li>
                                                    <li>Sesuai Pasal 104 ayat (1) Undang-Undang Nomor No.13 Tahun 2003 tentang Ketenagakerjaan (hak menjadi anggota serikat pekerja)</li> 
                                                </ol>
                                            </p>
                                            <p>
                                                Maka dengan ini saya menyatakan:<br>
                                                <ol>
                                                    <li>
                                                        <strong>PENGUNDURAN DIRI SEBAGAI KEANGGOTAAN ORGANISASI SERIKAT PEKERJA (JIKA PERNAH MENDAFTAR)</strong>
                                                        <p>
                                                            Dengan menyetujui pengisian formular ini maka pendaftar penuh kesadaran menyatakan mengundurkan diri dari keanggotaan Serikat Pekerja di lingkungan PT PLN (Persero) – (SP PLN/ SP PLN Indonesia/ Serikat Pegawai Perusahaan Listrik Negara dan serikat pekerja lainnya). Sehubungan dengan hal tersebut saya melepaskan segala hak dan kewajiban saya dari keanggotaan.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <strong>PENDAFTARAN ANGGOTA SERIKAT PEKERJA LASKAR PLN</strong>
                                                        <p>
                                                            Dengan menyetujui pengisian formular ini maka saya penuh kesadaran dan tanpa paksaan dari pihak manapun menyatakan Mendaftarkan Diri menjadi Anggota Organisasi Karyawan LASKAR PLN PT PLN (Persero) serta saya tidak terdaftar sebagai Anggota Organisasi sejenis dimanapun. Sehubungan dengan hal tersebut, pendaftar bersedia mentaati seluruh Peraturan Organisasi yang berlaku di dalamnya serta bersedia dipotong Iuran Anggota setiap bulannya.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <strong>SURAT KUASA PEMOTONGAN IURAN ANGGOTA LASKAR PLN</strong>
                                                        <p>
                                                            Dengan menyetujui pengisian formular ini maka saya memberikan Kuasa kepada Dewan Pengurus Pusat (DPP) LASKAR PLN PT PLN (Persero) untuk memotong Iuran Keanggotaan setiap bulan dari Payroll Penghasilan saya sebesar Rp 25.000 (Dua Puluh Lima Ribu Rupiah) atau sesuai Peraturan Organisasi yang berlaku serta tanda tangan digital yang dibubuhkan merupakan tanda tangan yang benar dan valid untuk dapat digunakan.
                                                        </p>
                                                    </li>
                                                </ol>
                                            </p>
                                            <p>
                                                Melalui pernyataan ini saya menyetujui dengan sungguh- sungguh dan tanpa ada paksaan dari pihak manapun agar dapat dipergunakan sebagaimana mestinya.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Saya Tidak Setuju</button>
                                        <button type="submit" onclick="this.disabled=true;this.form.submit();this.value='Submiting...';" class="btn btn-primary">Saya Setuju mendaftar sebagai anggota Laskar PLN</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            
                        </form>
                        
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
        $("#unit_id").select2({
            theme: "bootstrap-5",
        });
        $("#size_id").select2({
            theme: "bootstrap-5",
        });
        $("#grade").select2({
            theme: "bootstrap-5",
        });
        $("#tempat_lahir").select2({
            theme: "bootstrap-5",
        });
    </script>

    
    
    <script src="<?php echo e(asset('js/reload.captcha.js')); ?>"></script>       
    <script src="<?php echo e(asset('js/register.check.js')); ?>"></script>       
    
    <script src="<?php echo e(asset('js/signature_pad.js')); ?>"></script>       
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>       
    

    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/keanggotaan/register/register.blade.php ENDPATH**/ ?>