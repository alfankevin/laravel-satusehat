<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'bg-info' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kunjungan*') ? 'bg-info' : '' }}"
                    href="{{ route('kunjungan.index') }}">
                    <i class="nav-icon fas fa-calendar icon"></i>
                    <p>Pendaftaran</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('antrian*') ? 'bg-info' : '' }}"
                    href="{{ route('antrian.index') }}">
                    <i class="nav-icon fas fa-stethoscope icon"></i>
                    <p>Pemeriksaan</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kasir*') ? 'bg-info' : '' }}"
                    href="{{ route('kasir.index') }}">
                    <i class="nav-icon fas fa-credit-card icon"></i>
                    <p>Pembayaran</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('rekam-medis*') ? 'bg-info' : '' }}"
                    href="{{ route('rekam-medis.index') }}">
                    <i class="nav-icon fas fa-clipboard icon"></i>
                    <p> Rekam Medis</p>
                </a>
            </li>

            <li
                class="nav-item has-treeview {{ request()->is(['pasien', 'obat', 'poli', 'diagnosa', 'tindakan', 'alamat', 'practitioner', 'practitioner-group','users']) ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link  {{ request()->is(['pasien', 'obat', 'poli', 'diagnosa', 'tindakan', 'alamat', 'practitioner', 'practitioner-group','users']) ? 'bg-info' : '' }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Pengaturan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users*') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User & Hak Akses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['pasien*','obat*','poli*','diagnosa*','tindakan*','alamat*','practitioner*','practitioner-group*']) ? 'active' : '' }}"
                            href="{{ route('pasien.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Data</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('modul*') ? 'active' : '' }}"
                            href="{{ route('modul.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Modul Aplikasi</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
