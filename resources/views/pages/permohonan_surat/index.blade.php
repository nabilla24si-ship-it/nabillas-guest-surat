@extends('layouts.guest.app')

@section('title', 'Permohonan Surat - Layanan Mandiri Desa')

@section('content')
<!-- Header Section -->
<div class="container-fluid py-5 bg-primary hero-header mb-5">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated slideInDown">Permohonan Surat</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Permohonan Surat</li>
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

        <!-- Statistics Cards -->
        @php
            $stats = App\Models\PermohonanSurat::getStats();
        @endphp
        <div class="row mb-4">
            <div class="col-md-2 col-6">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center p-3">
                        <h4 class="mb-0">{{ $stats['total'] }}</h4>
                        <small>Total</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center p-3">
                        <h4 class="mb-0">{{ $stats['pending'] }}</h4>
                        <small>Pending</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card bg-info text-white">
                    <div class="card-body text-center p-3">
                        <h4 class="mb-0">{{ $stats['diproses'] }}</h4>
                        <small>Diproses</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center p-3">
                        <h4 class="mb-0">{{ $stats['ditolak'] }}</h4>
                        <small>Ditolak</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card bg-success text-white">
                    <div class="card-body text-center p-3">
                        <h4 class="mb-0">{{ $stats['selesai'] }}</h4>
                        <small>Selesai</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-primary mb-1">Data Permohonan Surat</h2>
                <p class="mb-0">Menampilkan {{ $permohonans->total() }} permohonan surat</p>
            </div>
            <div>
                <a href="{{ route('permohonan-surat.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Permohonan
                </a>
            </div>
        </div>

        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('permohonan-surat.index') }}" class="mb-4">
            <div class="row g-3">
                <!-- Search Input -->
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari no. pemohonan, nama, jenis surat..."
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
                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach($statusList as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Jenis Surat -->
                <div class="col-md-3">
                    <select name="jenis_surat" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Surat</option>
                        @foreach($jenisSuratList as $jenis)
                            <option value="{{ $jenis->jenis_id }}" {{ request('jenis_surat') == $jenis->jenis_id ? 'selected' : '' }}>
                                {{ $jenis->kode }} - {{ $jenis->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tanggal -->
                <div class="col-md-2">
                    <input type="date" name="tanggal_mulai" class="form-control"
                           value="{{ request('tanggal_mulai') }}" placeholder="Tanggal Mulai"
                           onchange="this.form.submit()">
                </div>

                <div class="col-md-2">
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ request('tanggal_selesai') }}" placeholder="Tanggal Selesai"
                           onchange="this.form.submit()">
                </div>

                <!-- Reset Filter -->
                <div class="col-md-2">
                    <a href="{{ route('permohonan-surat.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Info Filter Aktif -->
        @if(request()->anyFilled(['search', 'status', 'jenis_surat', 'tanggal_mulai', 'tanggal_selesai']))
        <div class="alert alert-info mb-4">
            <small>
                <i class="fas fa-info-circle me-1"></i>
                Filter aktif:
                @if(request('search')) <span class="badge bg-primary me-1">Pencarian: "{{ request('search') }}"</span> @endif
                @if(request('status')) <span class="badge bg-primary me-1">Status: {{ ucfirst(request('status')) }}</span> @endif
                @if(request('jenis_surat'))
                    @php
                        $selectedJenis = $jenisSuratList->firstWhere('jenis_id', request('jenis_surat'));
                    @endphp
                    <span class="badge bg-primary me-1">Jenis: {{ $selectedJenis->kode ?? '' }}</span>
                @endif
                @if(request('tanggal_mulai') || request('tanggal_selesai'))
                    <span class="badge bg-primary me-1">
                        Tanggal: {{ request('tanggal_mulai') ?? 'Awal' }} - {{ request('tanggal_selesai') ?? 'Akhir' }}
                    </span>
                @endif
                <a href="{{ route('permohonan-surat.index') }}" class="text-danger ms-2">
                    <i class="fas fa-times me-1"></i>Hapus semua filter
                </a>
            </small>
        </div>
        @endif

        <!-- Permohonan Surat Cards -->
        <div class="row" id="permohonanSuratContainer">
            @forelse ($permohonans as $permohonan)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-header bg-light py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-file-alt me-2"></i>{{ $permohonan->jenisSurat->nama_jenis ?? 'Jenis Surat' }}
                                </h5>
                                <div class="action-icons">
                                    <a href="{{ route('permohonan-surat.edit', $permohonan->permohonan_id) }}"
                                       class="text-warning me-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('permohonan-surat.destroy', $permohonan->permohonan_id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 border-0"
                                                onclick="return confirm('Yakin hapus permohonan {{ $permohonan->nomor_pemohonan }}?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Info Section -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user text-muted me-2"></i>
                                    <span class="small">
                                        <strong>Pemohon:</strong>
                                        {{ $permohonan->pemohon->nama ?? 'Data tidak ditemukan' }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-hashtag text-muted me-2"></i>
                                    <span class="small">
                                        <strong>No:</strong>
                                        {{ $permohonan->nomor_pemohonan }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar text-muted me-2"></i>
                                    <span class="small">
                                        <strong>Tanggal:</strong>
                                        {{ $permohonan->tanggal_pengajuan->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-tag text-muted me-2"></i>
                                    <span class="small">
                                        <strong>Jenis:</strong>
                                        {{ $permohonan->jenisSurat->kode ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="mb-4">
                                @php
                                    $statusInfo = $permohonan->status_label;
                                @endphp
                                <span class="badge bg-{{ $statusInfo['class'] }} w-100 py-2">
                                    <i class="fas fa-circle me-1"></i>
                                    {{ $statusInfo['text'] }}
                                </span>
                            </div>

                            <!-- Catatan Section -->
                            @if($permohonan->catatan)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-sticky-note me-2"></i>Catatan:
                                </h6>
                                <p class="small text-muted mb-0">{{ Str::limit($permohonan->catatan, 100) }}</p>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('permohonan-surat.show', $permohonan->permohonan_id) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>

                                <!-- Quick Status Update -->
                                <div class="btn-group" role="group">
                                    <form action="{{ route('permohonan-surat.update-status', $permohonan->permohonan_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="btn btn-outline-success btn-sm"
                                                {{ $permohonan->status == 'selesai' ? 'disabled' : '' }}
                                                title="Tandai Selesai">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('permohonan-surat.update-status', $permohonan->permohonan_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                {{ $permohonan->status == 'ditolak' ? 'disabled' : '' }}
                                                title="Tandai Ditolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada data permohonan surat</h4>
                            <p class="text-muted mb-4">
                                @if(request()->anyFilled(['search', 'status', 'jenis_surat', 'tanggal_mulai', 'tanggal_selesai']))
                                    Permohonan surat tidak ditemukan dengan filter yang dipilih
                                @else
                                    Belum ada data permohonan surat
                                @endif
                            </p>
                            @if(request()->anyFilled(['search', 'status', 'jenis_surat', 'tanggal_mulai', 'tanggal_selesai']))
                                <a href="{{ route('permohonan-surat.index') }}" class="btn btn-primary">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </a>
                            @else
                                <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Permohonan Surat Pertama
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($permohonans->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $permohonans->firstItem() ?? 0 }} - {{ $permohonans->lastItem() ?? 0 }} dari {{ $permohonans->total() }} permohonan
                    </div>
                    <div>
                        {{ $permohonans->links('pagination::bootstrap-5') }}
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

    .small {
        font-size: 0.875rem;
    }

    .action-icons a,
    .action-icons button {
        font-size: 1rem;
        transition: color 0.2s ease-in-out;
    }

    .action-icons a:hover {
        color: #e0a800 !important;
    }

    .action-icons button:hover {
        color: #dc3545 !important;
    }

    .action-icons form {
        display: inline;
    }

    .btn-group .btn {
        flex: 1;
    }

    .stat-card {
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        color: white;
        margin-bottom: 15px;
    }

    .stat-card h4 {
        margin: 0;
        font-weight: bold;
    }

    .stat-card small {
        opacity: 0.9;
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
        $('[title]').tooltip();

        // Confirm status update
        $('.btn-group form').on('submit', function(e) {
            const status = $(this).find('input[name="status"]').val();
            const statusText = status === 'selesai' ? 'Selesai' : 'Ditolak';

            if (!confirm(`Yakin ubah status menjadi ${statusText}?`)) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
