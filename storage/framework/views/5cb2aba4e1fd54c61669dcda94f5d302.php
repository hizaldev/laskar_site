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
                        'dashboard-dashboard_anggota_show',
                        'dashboard-dashboard_evote_show',
                    ])): ?>
                    <li class="nav-item dropdown">
                    
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-chart-simple"></i> Dashboard
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard-dashboard_anggota_show')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('members.dashboard_laskar')); ?>">Dashboard Laskar</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard-dashboard_evote_show')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('evotes.dashboard_evote')); ?>">Dashboard Evote</a>
                            <?php endif; ?>
                           
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'settings_permissions-list',
                        'settings_role-list',
                        'settings-user-list',
                        'settings_whatsapp_group-list',
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
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings_whatsapp_group-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('whatsapp_groups.index')); ?>">Whatsapp Group</a>
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
                        'master_serikat_pekerja-list',
                        'master_jenjang_jabatan-list',
                        'master_grade-list',
                        'master_department-list',
                        'master_jenis_document-list',
                        'master_properties_document-list',
                       
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
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_serikat_pekerja-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('unions.index')); ?>">Serikat Pekerja</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_jenjang_jabatan-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('level_positions.index')); ?>">Jenjang Jabatan</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_grade-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('grades.index')); ?>">Data Grade</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_department-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('departments.index')); ?>">Department Laskar</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_pendidikan_terakhir-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('last_educations.index')); ?>">Pendidikan Terakhir</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_jenis_document-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('jenis_documents.index')); ?>">Jenis Dokumen</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_properties_document-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('properties_documents.index')); ?>">Sifat Dokumen</a>
                                <?php endif; ?>
                            </div>
                            
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'content_management_links-list',
                        'content_management_news_category-list',
                        'content_management_news-list',
                    ])): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-folder-open"></i> CMS
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_management_links-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('links.index')); ?>">Management Link</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_management_news_category-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('news_category.index')); ?>">Kategori Berita</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_management_news-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('news.index')); ?>">Berita Laskar</a>
                                <?php endif; ?>
                            </div>

                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'aplikasi_absensi-list',
                        'aplikasi_absensi-list-user',
                        'aplikasi_dokumen-list',
                        'aplikasi_dokumen-list-user',
                        'aplikasi_pencarian_dokumen-list',
                    ])): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-folder-open"></i> Aplikasi
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                                    'aplikasi_absensi-list',
                                    'aplikasi_absensi-list-user',
                                ])): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('attendances.index')); ?>">Absensi</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                                    'aplikasi_dokumen-list',
                                    'aplikasi_dokumen-list-user',
                                ])): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('documents.index')); ?>">Management Dokumen Laskar</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('aplikasi_pencarian_dokumen-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('search_documents.index')); ?>">Pencarian Dokumen Laskar</a>
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                        'report-anggota',
                    ])): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user-check"></i> Report Anggota
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report-anggota')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('exportMember')); ?>">Export Anggota</a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/includes/navbar.blade.php ENDPATH**/ ?>