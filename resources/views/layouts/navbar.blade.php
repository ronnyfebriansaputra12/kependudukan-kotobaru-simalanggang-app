<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    @if (session()->has('admin'))
        <div class="navbar-nav ml-auto d-flex align-items-center">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <span class="badge badge-danger navbar-badge " style="position: relative; top: -1px;">
                        <span
                            style="position: absolute; top: -8px; left: -11px; background-color: red; padding: 4px 8px; border-radius: 50%;">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                        <i class="fas fa-bell"></i>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right mx-3">
                    <span class="dropdown-item dropdown-header bg-warning">
                        {{ Auth::user()->unreadNotifications->count() }} Notifikasi Baru
                    </span>
                    @forelse (Auth::user()->unreadNotifications as $notification)
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('mark-as-read/' . $notification->id) }}" class="dropdown-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $notification->data['nik_penduduk'] }}</strong>
                                    <div>{{ $notification->data['id_jenis_surat'] }}</div>
                                    <div class="text-muted">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <a href="#" class="dropdown-item text-center text-muted">
                            Tidak Ada Notifikasi Baru
                        </a>
                    @endforelse

                    <div class="dropdown-divider"></div>
                    <a href="{{ url('mark-as-all-read/') }}" class="dropdown-item dropdown-footer">
                        Baca Semua Pesan
                    </a>
                </div>
            </li>
        </div>
    @endif
</nav>
