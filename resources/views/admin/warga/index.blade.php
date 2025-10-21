<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Data Warga - Volt Dashboard</title>
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
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="{{ asset('assets-admin/img/team/profile-picture-3.jpg') }}"
                            class="card-img-top rounded-circle border-white" alt="User Avatar">
                    </div>
                    <div class="d-block">
                        <h2 class="h6">Hi, Admin</h2>
                        <a href="#" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
                </div>
            </div>

            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('assets-admin/img/brand/light.svg') }}" height="20" width="20"
                                alt="Volt Logo">
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
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
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
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Data Warga</a></li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Data Warga</h1>
                    <p class="mb-0">Daftar seluruh data warga</p>
                </div>
                <div>
                    <a href="{{ route('admin.warga.create') }}" class="btn btn-success text-white">
                        <i class="fas fa-plus me-1"></i> Tambah Warga
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-warga" class="table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0">#</th>
                                        <th class="border-0">NO KTP</th>
                                        <th class="border-0">NAMA</th>
                                        <th class="border-0">ALAMAT</th>
                                        <th class="border-0">NO. TELEPON</th>
                                        <th class="border-0">JENIS KELAMIN</th>
                                        <th class="border-0">AGAMA</th>
                                        <th class="border-0">PEKERJAAN</th>
                                        <th class="border-0">EMAIL</th>
                                        <th class="border-0 rounded-end">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($warga as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_ktp }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat ?? '-' }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>
                                                @if ($item->jenis_kelamin == 'L')
                                                    Laki-laki
                                                @elseif($item->jenis_kelamin == 'P')
                                                    Perempuan
                                                @else
                                                    {{ $item->jenis_kelamin }}
                                                @endif
                                            </td>
                                            <td>{{ $item->agama ?? '-' }}</td>
                                            <td>{{ $item->pekerjaan ?? '-' }}</td>
                                            <td>{{ $item->email ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.warga.edit', $item->warga_id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.warga.destroy', $item->warga_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-3">
                                                <em>Tidak ada data warga.</em>
                                                <br>
                                                <a href="{{ route('admin.warga.create') }}"
                                                    class="btn btn-sm btn-success mt-2">Tambah Data Warga</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white rounded shadow p-5 mb-4 mt-4">
            <div class="row">
                <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
                    <p class="mb-0 text-center text-lg-start">
                        © 2019-<span class="current-year"></span>
                        <a class="text-primary fw-normal" href="https://themesberg.com"
                            target="_blank">Themesberg</a>
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

    <!-- Core JS -->
    <script src="{{ asset('assets-admin/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('assets-admin/js/volt.js') }}"></script>
</body>

</html>