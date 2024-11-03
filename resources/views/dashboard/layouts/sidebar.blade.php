<div class="sidebar bg-dark" id="sidebar">
    <div class="text-center pt-2 pb-2 mt-2 mb-2">
        <a href="./index.html" class="brand-link">
            <img width="30px" src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Klinik Sehat</span>
        </a>
    </div>
    <hr class="my-0">
    <div class="scrollable-content">
        <nav class="nav flex-column ms-2 mt-2">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt icon"></i>
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('pasien.index') ? 'active' : '' }}" href="{{ route('pasien.index') }}">
                <i class="fas fa-users icon"></i>
                Daftar Pasien
            </a>
            <a class="nav-link {{ request()->routeIs('kunjungan.index') ? 'active' : '' }}" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-calendar icon"></i>
                Daftar Kunjungan
            </a>
            <a class="nav-link {{ request()->routeIs('antrian.index') ? 'active' : '' }}" href="{{ route('antrian.index') }}">
                <i class="fas fa-stethoscope icon"></i>
                Antrian Pemeriksaan
            </a>
            {{-- <a class="nav-link {{ request()->routeIs('farmasi.index') ? 'active' : '' }}" href="{{ route('farmasi.index') }}">
                <i class="fas fa-clipboard"></i>
                Farmasi
            </a>
            <a class="nav-link {{ request()->routeIs('kasir.index') ? 'active' : '' }}" href="{{ route('kasir.index') }}">
                <i class="fas fa-print"></i>
                Kasir
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-copy"></i>
                Rekam Medis
            </a> --}}
            <!-- Forms Dropdown -->
            <a href="#" class="nav-link" id="formsDropdownToggle">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-database icon"></i>
                        Data Master
                    </div>
                    <div>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
            </a>
            <ul class="nav nav-treeview {{ request()->is(['obat', 'poli', 'diagnosa', 'tindakan', 'alamat','practitioner','practitioner-group']) ? 'd-block' : '' }}" id="formsDropdown" style="display: none;">
                {{-- <li class="nav-item">
                    <a href="{{ route('obat.index') }}" class="nav-link {{ request()->routeIs('obat.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        Data Obat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('diagnosa.index') }}" class="nav-link {{ request()->routeIs('diagnosa.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        Data Diagnosa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tindakan.index') }}" class="nav-link {{ request()->routeIs('tindakan.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        Data Tindakan
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('poli.index') }}" class="nav-link {{ request()->routeIs('poli.index') ? 'active' : '' }}">
                        <i class="bi bi-circle icon"></i>
                        Data Poli
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('practitioner.index') }}" class="nav-link {{ request()->routeIs('practitioner.index') ? 'active' : '' }}">
                        <i class="bi bi-circle icon"></i>
                        Data Practitioner
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('practitioner-group.index') }}" class="nav-link {{ request()->routeIs('practitioner-group.index') ? 'active' : '' }}">
                        <i class="bi bi-circle icon"></i>
                        Data Practitioner Group
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('alamat.index') }}" class="nav-link {{ request()->routeIs('alamat.index') ? 'active' : '' }}">
                        <i class="bi bi-circle icon"></i>
                        Data Alamat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./forms/general.html" class="nav-link">
                        <i class="bi bi-circle icon"></i>
                        Data Pengguna
                    </a>
                </li>
            </ul>
            {{-- <a class="nav-link" href="#">
                <i class="fas fa-cog"></i>
                Setting Aplikasi
            </a> --}}
        </nav>
    </div>
</div>

<!-- CSS Styles -->
<style>
    .nav-link {
        align-items: center;
        color: #adb5bd;
        padding-left: 5px;
    }
    .nav-link i.icon{
        width: 25px;
        text-align: center;
        padding-right: 13px;
    }
</style>