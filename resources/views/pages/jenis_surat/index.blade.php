@extends('layouts.guest.app')

@section('title', 'Jenis Surat - Layanan Mandiri Desa')

@section('content')
<!-- Header Section -->
<div class="container-fluid py-5 bg-primary hero-header mb-5">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated slideInDown">Jenis Surat</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Jenis Surat</li>
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
                <h2 class="text-primary mb-1">Data Jenis Surat</h2>
                <p class="mb-0">Menampilkan {{ $surats->total() }} jenis surat tersedia</p>
            </div>
            <div>
                <a href="{{ route('jenis-surat.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Jenis Surat
                </a>
            </div>
        </div>

        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('jenis-surat.index') }}" class="mb-4">
            <div class="row g-3">
                <!-- Search Input -->
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari kode atau nama jenis surat..."
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

                <!-- Filter Kode -->
                <div class="col-md-3">
                    <select name="kode" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kode</option>
                        @foreach(['SKTM', 'SKU', 'SKK', 'SKL', 'SKP', 'SKD', 'SKKM', 'SKBM', 'SKPH', 'SKM', 'SKT', 'SKGG'] as $kode)
                            <option value="{{ $kode }}" {{ request('kode') == $kode ? 'selected' : '' }}>
                                {{ $kode }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Syarat -->
                <div class="col-md-3">
                    <select name="syarat" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Syarat</option>
                        <option value="with" {{ request('syarat') == 'with' ? 'selected' : '' }}>Dengan Syarat</option>
                        <option value="without" {{ request('syarat') == 'without' ? 'selected' : '' }}>Tanpa Syarat</option>
                    </select>
                </div>

                <!-- Reset Filter -->
                <div class="col-md-2">
                    <a href="{{ route('jenis-surat.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Info Filter Aktif -->
        @if(request()->anyFilled(['search', 'kode', 'syarat']))
        <div class="alert alert-info mb-4">
            <small>
                <i class="fas fa-info-circle me-1"></i>
                Filter aktif:
                @if(request('search')) <span class="badge bg-primary me-1">Pencarian: "{{ request('search') }}"</span> @endif
                @if(request('kode')) <span class="badge bg-primary me-1">Kode: {{ request('kode') }}</span> @endif
                @if(request('syarat') == 'with') <span class="badge bg-primary me-1">Dengan Syarat</span> @endif
                @if(request('syarat') == 'without') <span class="badge bg-primary me-1">Tanpa Syarat</span> @endif
                <a href="{{ route('jenis-surat.index') }}" class="text-danger ms-2">
                    <i class="fas fa-times me-1"></i>Hapus semua filter
                </a>
            </small>
        </div>
        @endif

        <!-- Jenis Surat Cards -->
        <div class="row" id="jenisSuratContainer">
            @forelse ($surats as $s)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-header bg-light py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-file-alt me-2"></i>{{ $s->nama_jenis }}
                                </h5>
                                <span class="badge bg-primary fs-6">{{ $s->kode }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Info Jumlah Syarat -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted small">
                                    <i class="fas fa-list-check me-1"></i>
                                    {{ count($s->syarat_list) }} syarat
                                </span>
                                <span class="badge {{ count($s->syarat_list) > 0 ? 'bg-success' : 'bg-secondary' }} small">
                                    {{ count($s->syarat_list) > 0 ? 'Ada Syarat' : 'Tidak Ada Syarat' }}
                                </span>
                            </div>

                            <!-- Syarat Section -->
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">
                                    <i class="fas fa-requirements me-2"></i>Persyaratan:
                                </h6>
                                @if(count($s->syarat_list) > 0)
                                    <div class="syarat-list">
                                        @foreach($s->syarat_list as $index => $item)
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-light text-dark me-2 small">{{ $index + 1 }}</span>
                                                <span class="small">{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Tidak ada syarat khusus
                                    </p>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('jenis-surat.edit', $s->jenis_id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('jenis-surat.destroy', $s->jenis_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                            onclick="return confirm('Yakin hapus jenis surat {{ $s->nama_jenis }}?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Dibuat: {{ $s->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada data jenis surat</h4>
                            <p class="text-muted mb-4">
                                @if(request()->anyFilled(['search', 'kode', 'syarat']))
                                    Jenis surat tidak ditemukan dengan filter yang dipilih
                                @else
                                    Belum ada data jenis surat
                                @endif
                            </p>
                            @if(request()->anyFilled(['search', 'kode', 'syarat']))
                                <a href="{{ route('jenis-surat.index') }}" class="btn btn-primary">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </a>
                            @else
                                <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Jenis Surat Pertama
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($surats->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $surats->firstItem() ?? 0 }} - {{ $surats->lastItem() ?? 0 }} dari {{ $surats->total() }} jenis surat
                    </div>
                    <div>
                        {{ $surats->links('pagination::bootstrap-5') }}
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

    .syarat-list {
        max-height: 150px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .syarat-list::-webkit-scrollbar {
        width: 4px;
    }

    .syarat-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .syarat-list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 2px solid #e9ecef;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.75em;
    }

    .card-footer {
        border-top: 1px solid #e9ecef;
        padding: 0.75rem 1.25rem;
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
