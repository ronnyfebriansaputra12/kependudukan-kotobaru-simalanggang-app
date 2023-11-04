<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-warning navbar-badge">
                    {{ Auth::user()->unreadNotifications->count() }}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ Auth::user()->unreadNotifications->count() }} Notifications</span>
                @foreach(Auth::user()->unreadNotifications as $notification)
                    <a href="#" class="dropdown-item">
                        {{ $notification->data['nik_penduduk'] }} - {{ $notification->data['id_jenis_surat'] }}
                    </a>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
