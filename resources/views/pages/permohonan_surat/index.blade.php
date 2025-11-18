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

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-primary mb-1">Data Permohonan Surat</h2>
                <p class="mb-0">Daftar seluruh permohonan surat warga</p>
            </div>
            <div>
                <a href="{{ route('permohonan-surat.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Permohonan
                </a>
            </div>
        </div>

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
                                        {{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d/m/Y H:i') }}
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
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'diproses' => 'primary',
                                        'ditolak' => 'danger',
                                        'selesai' => 'success'
                                    ];
                                    $color = $statusColors[$permohonan->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }} w-100 py-2">
                                    <i class="fas fa-circle me-1"></i>
                                    {{ ucfirst($permohonan->status) }}
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

                            <!-- Detail Button -->
                            <div class="d-grid">
                                <a href="{{ route('permohonan-surat.show', $permohonan->permohonan_id) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada data permohonan surat</h4>
                            <p class="text-muted mb-4">Silakan tambah permohonan surat pertama Anda</p>
                            <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Tambah Permohonan Surat
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
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
</style>
@endpush
