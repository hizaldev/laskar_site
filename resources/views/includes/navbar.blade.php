<nav class="navbar navbar-expand-md navbar-light bg-primary bg-opacity-50 text-white shadow-sm">
    <div class="container-fluid">
        @guest
            
        @else
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        @endguest

        <div class="collapse navbar-collapse px-4" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @guest
                @else
                    <li>
                        <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-chart-line"></i> Beranda</a>
                    </li>
                    @canany([
                        'dashboard-dashboard_anggota_show',
                        'dashboard-dashboard_evote_show',
                    ])
                    <li class="nav-item dropdown">
                    
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-chart-simple"></i> Dashboard
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @can('dashboard-dashboard_anggota_show')
                                <a class="dropdown-item" href="{{ route('members.dashboard_laskar') }}">Dashboard Laskar</a>
                            @endcan
                            @can('dashboard-dashboard_evote_show')
                                <a class="dropdown-item" href="{{ route('evotes.dashboard_evote') }}">Dashboard Evote</a>
                            @endcan
                           
                        </div>
                    </li>
                    @endcan
                    @canany([
                        'settings_permissions-list',
                        'settings_role-list',
                        'settings-user-list',
                        'settings_whatsapp_group-list',
                    ])
                        <li class="nav-item dropdown">
                    
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-gear"></i> Settings
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('settings_role-list')
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">Role</a>
                                @endcan
                                @can('settings_permissions-list')
                                    <a class="dropdown-item" href="{{ route('permisions.index') }}">Permission</a>
                                @endcan
                                @can('settings-user-list')
                                    <a class="dropdown-item" href="{{ route('users.index') }}">User</a>
                                @endcan
                                @can('settings_whatsapp_group-list')
                                    <a class="dropdown-item" href="{{ route('whatsapp_groups.index') }}">Whatsapp Group</a>
                                @endcan
                               
                            </div>
                        </li>
                    @endcan
                    @canany([
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
                       
                    ])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-sitemap"></i> Master
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('master_dpd-list')
                                    <a class="dropdown-item" href="{{ route('dpd.index') }}">DPD</a>
                                @endcan
                                @can('master_dpc-list')
                                    <a class="dropdown-item" href="{{ route('dpc.index') }}">DPC</a>
                                @endcan
                                @can('master_agama-list')
                                    <a class="dropdown-item" href="{{ route('religions.index') }}">Agama</a>
                                @endcan
                                @can('master_kota-list')
                                    <a class="dropdown-item" href="{{ route('cities.index') }}">Kota</a>
                                @endcan
                                @can('master_ukuran-list')
                                    <a class="dropdown-item" href="{{ route('sizes.index') }}">Ukuran Baju</a>
                                @endcan
                                @can('master_golongan_darah-list')
                                    <a class="dropdown-item" href="{{ route('type_bloods.index') }}">Golongan Darah</a>
                                @endcan
                                @can('master_bank-list')
                                    <a class="dropdown-item" href="{{ route('banks.index') }}">Bank</a>
                                @endcan
                                @can('master_status_member-list')
                                    <a class="dropdown-item" href="{{ route('status_members.index') }}">Status Anggota</a>
                                @endcan
                                @can('master_unit-list')
                                    <a class="dropdown-item" href="{{ route('units.index') }}">Unit</a>
                                @endcan
                                @can('master_serikat_pekerja-list')
                                    <a class="dropdown-item" href="{{ route('unions.index') }}">Serikat Pekerja</a>
                                @endcan
                                @can('master_jenjang_jabatan-list')
                                    <a class="dropdown-item" href="{{ route('level_positions.index') }}">Jenjang Jabatan</a>
                                @endcan
                                @can('master_grade-list')
                                    <a class="dropdown-item" href="{{ route('grades.index') }}">Data Grade</a>
                                @endcan
                                @can('master_department-list')
                                    <a class="dropdown-item" href="{{ route('departments.index') }}">Department Laskar</a>
                                @endcan
                                @can('master_pendidikan_terakhir-list')
                                    <a class="dropdown-item" href="{{ route('last_educations.index') }}">Pendidikan Terakhir</a>
                                @endcan
                            </div>
                            
                        </li>
                    @endcan
                    @canany([
                        'content_management_links-list',
                        'content_management_news_category-list',
                        'content_management_news-list',
                    ])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-folder-open"></i> CMS
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('content_management_links-list')
                                    <a class="dropdown-item" href="{{ route('links.index') }}">Management Link</a>
                                @endcan
                                @can('content_management_news_category-list')
                                    <a class="dropdown-item" href="{{ route('news_category.index') }}">Kategori Berita</a>
                                @endcan
                                @can('content_management_news-list')
                                    <a class="dropdown-item" href="{{ route('news.index') }}">Berita Laskar</a>
                                @endcan
                            </div>

                        </li>
                    @endcan
                    @canany([
                        'aplikasi_absensi-list',
                        'aplikasi_absensi-list-user',
                    ])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-folder-open"></i> Aplikasi
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @canany([
                                    'aplikasi_absensi-list',
                                    'aplikasi_absensi-list-user',
                                ])
                                    <a class="dropdown-item" href="{{ route('attendances.index') }}">Absensi</a>
                                @endcan
                            </div>

                        </li>
                    @endcan
                    @canany([
                        'keanggotaan_anggota-list',
                        'keanggotaan_proses_daftar-list',
                    ])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-users"></i> Keanggotaan
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('keanggotaan_anggota-list')
                                    <a class="dropdown-item" href="{{ route('members.index') }}">Anggota Laskar</a>
                                @endcan
                                @can('keanggotaan_proses_daftar-list')
                                    <a class="dropdown-item" href="{{ route('process_members.index') }}">Prosess Permohonan Registrasi</a>
                                @endcan
                                
                            </div>
                        </li>
                    @endcan
                    @canany([
                        'pemilu_evote-list',
                    ])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user-check"></i> Evote
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('pemilu_evote-list')
                                    <a class="dropdown-item" href="{{ route('evotes.index') }}">Pemilu Laskar</a>
                                @endcan
                            </div>
                        </li>
                    @endcan
                    @canany([
                        'report-anggota',
                    ])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user-check"></i> Report Anggota
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('report-anggota')
                                    <a class="dropdown-item" href="{{ route('exportMember') }}">Export Anggota</a>
                                @endcan
                            </div>
                        </li>
                    @endcan
                @endguest
            </ul>
        </div>
    </div>
</nav>