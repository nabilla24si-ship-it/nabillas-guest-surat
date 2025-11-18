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
                <p class="mb-0">Daftar seluruh jenis surat yang tersedia</p>
            </div>
            <div>
                <a href="{{ route('jenis-surat.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Jenis Surat
                </a>
            </div>
        </div>

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
                            <!-- Syarat Section -->
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">
                                    <i class="fas fa-list-check me-2"></i>Syarat:
                                </h6>
                                @if($s->syarat_json)
                                    @php
                                        $syarat = json_decode($s->syarat_json, true);
                                    @endphp
                                    @if(is_array($syarat) && count($syarat) > 0)
                                        <div class="syarat-list">
                                            @foreach($syarat as $item)
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="small">{{ $item }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted small mb-0">Tidak ada syarat khusus</p>
                                    @endif
                                @else
                                    <p class="text-muted small mb-0">Tidak ada syarat khusus</p>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('jenis-surat.edit', $s->jenis_id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <div class="btn-group" role="group">
                                    <form action="{{ route('jenis-surat.destroy', $s->jenis_id) }}" method="POST" class="w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                onclick="return confirm('Yakin hapus jenis surat {{ $s->nama_jenis }}?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
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
                            <h4 class="text-muted">Belum ada data jenis surat</h4>
                            <p class="text-muted mb-4">Silakan tambah jenis surat pertama Anda</p>
                            <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Tambah Jenis Surat
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

    .syarat-list {
        max-height: 150px;
        overflow-y: auto;
    }

    .card-header {
        border-bottom: 2px solid #e9ecef;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.75em;
    }
</style>
@endpush
