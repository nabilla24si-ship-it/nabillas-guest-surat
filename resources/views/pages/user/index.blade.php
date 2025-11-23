@extends('layouts.guest.app')

@section('title', 'Data User - Layanan Mandiri Desa')

@section('content')
<!-- Header Section -->
<div class="container-fluid py-5 bg-primary hero-header mb-5">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated slideInDown">Data User</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Data User</li>
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
                <h2 class="text-primary mb-1">Data User Sistem</h2>
                <p class="mb-0">Menampilkan {{ $dataUser->total() }} user terdaftar</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah User
                </a>
            </div>
        </div>

        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('user.index') }}" class="mb-4">
            <div class="row g-3">
                <!-- Search Input -->
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama atau email..."
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

                <!-- Filter Status -->
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="recent" {{ request('status') == 'recent' ? 'selected' : '' }}>User Baru (7 hari)</option>
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Belum Verifikasi</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div class="col-md-3">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>

                <!-- Reset Filter -->
                <div class="col-md-2">
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Info Filter Aktif -->
        @if(request()->anyFilled(['search', 'status', 'sort']))
        <div class="alert alert-info mb-4">
            <small>
                <i class="fas fa-info-circle me-1"></i>
                Filter aktif:
                @if(request('search')) <span class="badge bg-primary me-1">Pencarian: "{{ request('search') }}"</span> @endif
                @if(request('status') == 'recent') <span class="badge bg-primary me-1">User Baru</span> @endif
                @if(request('status') == 'verified') <span class="badge bg-primary me-1">Terverifikasi</span> @endif
                @if(request('status') == 'unverified') <span class="badge bg-primary me-1">Belum Verifikasi</span> @endif
                @if(request('sort')) <span class="badge bg-primary me-1">Urutan: {{ [
                    'newest' => 'Terbaru',
                    'oldest' => 'Terlama',
                    'name_asc' => 'Nama A-Z',
                    'name_desc' => 'Nama Z-A'
                ][request('sort')] }}</span> @endif
                <a href="{{ route('user.index') }}" class="text-danger ms-2">
                    <i class="fas fa-times me-1"></i>Hapus semua filter
                </a>
            </small>
        </div>
        @endif

        <!-- User Cards -->
        <div class="row" id="userContainer">
            @forelse ($dataUser as $item)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-header bg-light py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-user me-2"></i>{{ $item->name }}
                                </h5>
                                <div>
                                    @if($item->id === auth()->id())
                                        <span class="badge bg-primary">Anda</span>
                                    @else
                                        <span class="badge {{ $item->email_verified_at ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $item->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- User Info -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-envelope text-muted me-2"></i>
                                    <span class="small">{{ $item->email }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar text-muted me-2"></i>
                                    <span class="small text-muted">
                                        Bergabung: {{ $item->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                @if($item->email_verified_at)
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span class="small text-success">
                                        Terverifikasi: {{ $item->email_verified_at->format('d M Y') }}
                                    </span>
                                </div>
                                @endif
                            </div>

                            <!-- Security Note -->
                            <div class="alert alert-warning alert-sm mb-3">
                                <small>
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Password terenkripsi dengan aman
                                </small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('user.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit User
                                </a>
                                @if($item->id !== auth()->id())
                                <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                            onclick="return confirm('Yakin hapus user {{ $item->name }}?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                                @else
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="fas fa-ban me-1"></i>Tidak Dapat Dihapus
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                ID: {{ $item->id }} •
                                @if($item->created_at->diffInDays(now()) < 7)
                                    <span class="text-success">Baru</span>
                                @else
                                    {{ $item->created_at->diffForHumans() }}
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada data user</h4>
                            <p class="text-muted mb-4">
                                @if(request()->anyFilled(['search', 'status']))
                                    User tidak ditemukan dengan filter yang dipilih
                                @else
                                    Belum ada data user
                                @endif
                            </p>
                            @if(request()->anyFilled(['search', 'status']))
                                <a href="{{ route('user.index') }}" class="btn btn-primary">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </a>
                            @else
                                <a href="{{ route('user.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah User Pertama
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($dataUser->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $dataUser->firstItem() ?? 0 }} - {{ $dataUser->lastItem() ?? 0 }} dari {{ $dataUser->total() }} user
                    </div>
                    <div>
                        {{ $dataUser->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .card-header {
        border-bottom: 2px solid #e9ecef;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.75em;
    }

    .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .card-footer {
        border-top: 1px solid #e9ecef;
        padding: 0.75rem 1.25rem;
    }

    .pagination {
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
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
@endpush
