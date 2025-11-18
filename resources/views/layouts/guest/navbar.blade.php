<nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="#" class="navbar-brand ms-3 d-lg-none">MENU</a>
    <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav me-auto p-3 p-lg-0">
            <!-- Home/Beranda menuju ke dashboard -->
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

            <!-- Data Warga -->
            <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">Data Warga</a>

            <!-- Jenis Surat -->
            <a href="{{ route('jenis-surat.index') }}" class="nav-item nav-link {{ request()->routeIs('jenis-surat.*') ? 'active' : '' }}">Jenis Surat</a>

            <!-- Layanan -->
            <a href="{{ route('service') }}" class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">Layanan</a>

            <!-- Data User -->
            <a href="{{ route('user.index') }}" class="nav-item nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">Data User</a>

            <!-- Dropdown untuk menu lainnya -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('about') || request()->routeIs('project') || request()->routeIs('contact') ? 'active' : '' }}" data-bs-toggle="dropdown">Lainnya</a>
                <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0">
                    <a href="{{ route('about') }}" class="dropdown-item {{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>
                    <a href="{{ route('project') }}" class="dropdown-item {{ request()->routeIs('project') ? 'active' : '' }}">Proyek</a>
                    <a href="{{ route('contact') }}" class="dropdown-item {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block">Ajukan Surat</a>
    </div>
</nav>
