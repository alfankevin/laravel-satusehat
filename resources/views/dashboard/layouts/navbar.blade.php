<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <i class="fas fa-bars mx-3" id="sidebarToggle"></i>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            {{-- <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li> --}}
        </ul>
        <ul class="navbar-nav ms-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-comments"></i></a>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="togleNotifikasi" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-bell"></i> 
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="togleNotifikasi">
                    <div class="text-center">
                        <h6 class="dropdown-header">15 Notifications</h6>
                        <hr class="dropdown-divider">
                    </div>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" id="fullscreenToggle"><i class="fas fa-th-large"></i></a>
            </li>
            <!-- User Image with Dropdown -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link d-flex align-items-center" id="userDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/img/user2-160x160.jpg') }}" width="30px" class="rounded-circle shadow ms-3"
                        alt="User Image">
                    <span class="me-3 ms-2">
                        Alexander Pierce
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#"> <i><i class="fas fa-user"></i></i>
                            Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i><i class="fas fa-cog"></i></i>
                            Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"><i><i class="fas fa-sign-out-alt"></i></i>
                            Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>