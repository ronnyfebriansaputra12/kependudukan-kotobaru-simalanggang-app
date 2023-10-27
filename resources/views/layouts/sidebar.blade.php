<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-warning">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link" style="text-decoration: none">
        <img src="{{ asset('AdminLTE') }}/dist/img/50kota.png" width="70px" alt="AdminLTE Logo"
            class="brand-image img-circle">
        <span class="brand-text font-weight-light">Kependudukan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- @if (Auth::user()->avatar == '')
                    <img class="img-circle elevation-2" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}"
                        alt="User profile picture">
                @else
                    <img class="img-circle elevation-2" src="{{ Auth::user()->avatar }}" alt="User profile picture">
                @endif --}}
                <img class="img-circle elevation-2" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}"
                    alt="User profile picture">
            </div>
            <div class="info">
                @if (session()->has('penduduk'))
                    @php
                        $penduduk = session('penduduk');
                    @endphp
                    <a href="/profilePenduduk" style="text-decoration: none;">{{ $penduduk->nama }}</a>
                @endif
                @if (session()->has('admin'))
                    @php
                        $admin = session('admin');
                        // dd($admin)
                    @endphp
                    <a href="/profile" style="text-decoration: none;">{{ $admin->name }}</a>
                @endif
            </div>


        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @if (session()->has('penduduk'))
                    <li hidden class="nav-item {{ Request::is('penduduk') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('penduduk') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('penduduk') }}"
                                    class="nav-link {{ Request::is('penduduk') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Penduduk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/user') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleActive(this)">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Surat
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/pengajuan') }}" class="nav-link">
                                    <i class="fa fa-tasks" style="margin-left: 19px; margin-right: 9px;"></i>
                                    <p>Pengajuan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li hidden class="nav-item">
                        <a href="{{ url('/laporan') }}" class="nav-link {{ Request::is('laporan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Laporan
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @elseif (session()->has('admin'))
                    <li class="nav-item {{ Request::is('penduduk') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('penduduk') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('penduduk') }}"
                                    class="nav-link {{ Request::is('penduduk') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Penduduk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/user') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/jenis-surat') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Surat
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/pengajuan') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        Pengajuan
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/laporan') }}" class="nav-link {{ Request::is('laporan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Laporan
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link">
                        <i class="fa-regular fas fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
