<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('assets/img/logo/Logo_SmartRack2.png') }}" width="180" alt="Logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="ti ti-layout-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Main</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/barang') }}">
                        <i class="ti ti-article"></i>
                        <span class="hide-menu">Barang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/penyimpanan') }}">
                        <i class="ti ti-cards"></i>
                        <span class="hide-menu">Penyimpanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/log-aktivitas') }}">
                        <i class="ti ti-file-description"></i>
                        <span class="hide-menu">Log Aktivitas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/user') }}">
                        <i class="ti ti-user"></i>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>