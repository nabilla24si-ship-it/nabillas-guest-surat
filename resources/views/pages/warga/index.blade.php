@extends('layouts.guest.app')

@section('title', 'Data Warga - Layanan Mandiri Desa')

@section('content')
<!-- Header Section -->
<div class="container-fluid py-5 bg-primary hero-header mb-5">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated slideInDown">Data Warga</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Data Warga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="container-xxl py-5">
    <div class="container">
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

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-primary mb-1">Data Warga Desa</h2>
                <p class="mb-0">Menampilkan {{ $warga->total() }} data warga</p>
            </div>
            <div>
                <a href="{{ route('warga.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Warga
                </a>
            </div>
        </div>

        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
            <div class="row g-3">
                <!-- Search Input -->
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama, alamat, no KTP..."
                               aria-label="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                               class="btn btn-outline-secondary" id="clear-search">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Filter Jenis Kelamin -->
                <div class="col-md-3">
                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Filter Agama -->
                <div class="col-md-3">
                    <select name="agama" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Agama</option>
                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <!-- Reset Filter -->
                <div class="col-md-2">
                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Info Filter Aktif -->
        @if(request()->anyFilled(['search', 'jenis_kelamin', 'agama']))
        <div class="alert alert-info mb-4">
            <small>
                <i class="fas fa-info-circle me-1"></i>
                Filter aktif:
                @if(request('search')) <span class="badge bg-primary me-1">Pencarian: "{{ request('search') }}"</span> @endif
                @if(request('jenis_kelamin')) <span class="badge bg-primary me-1">Jenis Kelamin: {{ request('jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan' }}</span> @endif
                @if(request('agama')) <span class="badge bg-primary me-1">Agama: {{ request('agama') }}</span> @endif
                <a href="{{ route('warga.index') }}" class="text-danger ms-2">
                    <i class="fas fa-times me-1"></i>Hapus semua filter
                </a>
            </small>
        </div>
        @endif

        <!-- Warga Cards -->
        <div class="row" id="wargaContainer">
            @forelse ($warga as $item)
                <div class="col-lg-6 col-xl-4 mb-4 warga-card">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="card-title text-primary mb-1">{{ $item->nama }}</h5>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-id-card me-2"></i>{{ $item->no_ktp }}
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                        <strong>{{ $item->alamat ?? 'Alamat belum diisi' }}</strong>
                                    </p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary border-0" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('warga.edit', $item->warga_id) }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('Yakin hapus data {{ $item->nama }}?')">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="mb-3">
                                @if($item->telp)
                                    <span class="badge bg-light text-dark me-2 mb-2">
                                        <i class="fas fa-phone me-1"></i>{{ $item->telp }}
                                    </span>
                                @endif
                                @if($item->email)
                                    <span class="badge bg-light text-dark me-2 mb-2">
                                        <i class="fas fa-envelope me-1"></i>{{ $item->email }}
                                    </span>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge {{ $item->jenis_kelamin == 'L' ? 'bg-info' : 'bg-warning text-dark' }}">
                                    <i class="fas fa-{{ $item->jenis_kelamin == 'L' ? 'male' : 'female' }} me-1"></i>
                                    {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>

                                @if($item->agama)
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-pray me-1"></i>{{ $item->agama }}
                                    </span>
                                @endif

                                @if($item->pekerjaan)
                                    <span class="badge bg-success">
                                        <i class="fas fa-briefcase me-1"></i>{{ $item->pekerjaan }}
                                    </span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('warga.edit', $item->warga_id) }}"
                                   class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Data
                                </a>
                                <div class="btn-group" role="group">
                                    <a href="tel:{{ $item->telp }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-phone me-1"></i>Telepon
                                    </a>
                                    @if($item->email)
                                        <a href="mailto:{{ $item->email }}" class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-envelope me-1"></i>Email
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada data warga</h4>
                            <p class="text-muted mb-4">
                                @if(request()->anyFilled(['search', 'jenis_kelamin', 'agama']))
                                    Data tidak ditemukan dengan filter yang dipilih
                                @else
                                    Belum ada data warga
                                @endif
                            </p>
                            @if(request()->anyFilled(['search', 'jenis_kelamin', 'agama']))
                                <a href="{{ route('warga.index') }}" class="btn btn-primary">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </a>
                            @else
                                <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Data Warga
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($warga->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $warga->firstItem() ?? 0 }} - {{ $warga->lastItem() ?? 0 }} dari {{ $warga->total() }} data
                    </div>
                    <div>
                        {{ $warga->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto submit form ketika input search berubah (dengan delay)
        let searchTimeout;
        $('input[name="search"]').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                $(this).closest('form').submit();
            }, 500);
        });

        // Tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>

<style>
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .card-title {
        font-weight: 600;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.75em;
    }

    .dropdown-toggle::after {
        display: none;
    }

    .pagination {
        margin-bottom: 0;
    }
</style>
@endsection
