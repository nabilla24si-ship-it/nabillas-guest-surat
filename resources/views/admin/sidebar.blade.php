<!-- resources/views/admin/sidebar.blade.php -->
<nav class="sidebar navbar navbar-vertical navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand mt-2" href="{{ route('admin.dashboard') }}">
            ⚡ Volt Overview
        </a>

        <ul class="navbar-nav mt-4">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.warga.index') }}" class="nav-link">
                    <i class="fas fa-users me-2"></i> Data Warga
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.jenis-surat.index') }}" class="nav-link">
                    <i class="fas fa-envelope me-2"></i> Jenis Surat
                </a>
            </li>
        </ul>
    </div>
</nav>
