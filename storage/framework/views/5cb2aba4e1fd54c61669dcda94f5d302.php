<nav class="navbar navbar-expand-md navbar-light bg-primary bg-opacity-50 text-white shadow-sm">
    <div class="container-fluid">
        <?php if(auth()->guard()->guest()): ?>
            
        <?php else: ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
        <?php endif; ?>

        <div class="collapse navbar-collapse px-4" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                <?php else: ?>
                    <li>
                        <a class="nav-link" href="<?php echo e(route('home')); ?>"><i class="fa-solid fa-chart-line"></i> Beranda</a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'settings_permissions-list',
                        'settings_role-list',
                        'settings-user-list',
                    ])): ?>
                        <li class="nav-item dropdown">
                    
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-gear"></i> Settings
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings_role-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('roles.index')); ?>">Role</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings_permissions-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('permisions.index')); ?>">Permission</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings-user-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('users.index')); ?>">User</a>
                                <?php endif; ?>
                               
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'master_dpd-list',
                        'master_dpc-list',
                        'master_agama-list',
                        'master_kota-list',
                        'master_ukuran-list',
                        'master_golongan_darah-list',
                        'master_bank-list',
                        'master_unit-list',
                       
                    ])): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-sitemap"></i> Master
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_dpd-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('dpd.index')); ?>">DPD</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_dpc-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('dpc.index')); ?>">DPC</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_agama-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('religions.index')); ?>">Agama</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_kota-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('cities.index')); ?>">Kota</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_ukuran-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('sizes.index')); ?>">Ukuran Baju</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('type_bloods.index')); ?>">Golongan Darah</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_bank-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('banks.index')); ?>">Bank</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_status_member-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('status_members.index')); ?>">Status Anggota</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_unit-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('units.index')); ?>">Unit</a>
                                <?php endif; ?>
                            </div>
                            
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'keanggotaan_anggota-list',
                        'keanggotaan_proses_daftar-list',
                    ])): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-users"></i> Keanggotaan
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('keanggotaan_anggota-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('members.index')); ?>">Anggota Laskar</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('keanggotaan_proses_daftar-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('process_members.index')); ?>">Prosess Permohonan Registrasi</a>
                                <?php endif; ?>
                                
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'pemilu_evote-list',
                    ])): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user-check"></i> Evote
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pemilu_evote-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('evotes.index')); ?>">Pemilu Laskar</a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/includes/navbar.blade.php ENDPATH**/ ?>