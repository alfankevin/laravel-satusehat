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
                <a class="nav-link {{ request()->routeIs('rekam-medis*') ? 'bg-info' : '' }}"
                    href="{{ route('rekam-medis.index') }}">
                    <i class="nav-icon fas fa-clipboard icon"></i>
                    <p> Rekam Medis</p>
                </a>
            </li>

            <li
                class="nav-item has-treeview {{ request()->is(['pasien', 'obat', 'poli', 'diagnosa', 'tindakan', 'alamat', 'practitioner', 'practitioner-group']) ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link  {{ request()->is(['pasien', 'obat', 'poli', 'diagnosa', 'tindakan', 'alamat', 'practitioner', 'practitioner-group']) ? 'bg-info' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Master Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pasien*') ? 'active' : '' }}"
                            href="{{ route('pasien.index') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('poli.index') }}"
                            class="nav-link {{ request()->routeIs('poli.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('practitioner.index') }}"
                            class="nav-link {{ request()->routeIs('practitioner.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Practitioner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('practitioner-group.index') }}"
                            class="nav-link {{ request()->routeIs('practitioner-group.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Practitioner Group</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
