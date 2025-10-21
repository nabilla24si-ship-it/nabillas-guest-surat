<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tambah Jenis Surat | Volt Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-admin/img/favicon/favicon-32x32.png') }}">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
</head>

<body>

    {{-- ===== Sidebar ===== --}}
    <nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('assets-admin/img/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">Volt Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <span class="sidebar-icon"><i class="fas fa-home"></i></span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/warga*') ? 'active' : '' }}">
                    <a href="{{ route('admin.warga.index') }}" class="nav-link">
                        <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                        <span class="sidebar-text">Data Warga</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/jenis-surat*') ? 'active' : '' }}">
                    <a href="{{ route('admin.jenis-surat.index') }}" class="nav-link">
                        <span class="sidebar-icon"><i class="fas fa-envelope"></i></span>
                        <span class="sidebar-text">Jenis Surat</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    {{-- ===== End Sidebar ===== --}}

    <main class="content">
        {{-- ===== Navbar ===== --}}
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-icon-only d-md-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder"
                                        src="{{ asset('assets-admin/img/team/profile-picture-3.jpg') }}">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span class="mb-0 font-small fw-bold text-gray-900">Admin</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- ===== End Navbar ===== --}}

        {{-- ===== Content Section ===== --}}
        <div class="py-4">
            <div class="container mt-4">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.jenis-surat.index') }}">Jenis Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Surat</li>
                    </ol>
                </nav>

                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Jenis Surat</h5>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.jenis-surat.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Kode Jenis Surat</label>
                                    <input type="text" name="kode" class="form-control" 
                                        value="{{ old('kode') }}" required>
                                    @error('kode')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Jenis Surat</label>
                                    <input type="text" name="nama_jenis" class="form-control" 
                                        value="{{ old('nama_jenis') }}" required>
                                    @error('nama_jenis')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Syarat (Format JSON)</label>
                                <textarea name="syarat_json" class="form-control" rows="4" 
                                    placeholder='Contoh: ["KTP", "KK", "Surat Pengantar RT"]'>{{ old('syarat_json') }}</textarea>
                                @error('syarat_json')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Masukkan syarat dalam format JSON array. Contoh: <code>["KTP", "KK", "Surat Pengantar RT"]</code>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white rounded shadow p-5 mb-4 mt-4">
            <div class="row">
                <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
                    <p class="mb-0 text-center text-lg-start">
                        © 2019-<span class="current-year"></span>
                        <a class="text-primary fw-normal" href="https://themesberg.com" target="_blank">Themesberg</a>
                    </p>
                </div>
                <div class="col-12 col-md-8 col-xl-6 text-center text-lg-start">
                    <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">
                        <li class="list-inline-item px-0 px-sm-2"><a href="#">About</a></li>
                        <li class="list-inline-item px-0 px-sm-2"><a href="#">Themes</a></li>
                        <li class="list-inline-item px-0 px-sm-2"><a href="#">Blog</a></li>
                        <li class="list-inline-item px-0 px-sm-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>

    <!-- Scripts -->
    <script src="{{ asset('assets-admin/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/volt.js') }}"></script>
</body>
</html>