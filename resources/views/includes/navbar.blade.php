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
                        'settings_permissions-list',
                        'settings_role-list',
                        'settings-user-list',
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
                @endguest
            </ul>
        </div>
    </div>
</nav>