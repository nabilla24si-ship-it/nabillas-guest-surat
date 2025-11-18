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
                <p class="mb-0">Daftar seluruh data warga desa kami</p>
            </div>
            <div>
                <a href="{{ route('warga.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Warga
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari nama warga..." id="searchInput">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="filterJenisKelamin">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <!-- Warga Cards -->
        <div class="row" id="wargaContainer">
            @forelse ($warga as $item)
                <div class="col-lg-6 col-xl-4 mb-4 warga-card"
                     data-name="{{ strtolower($item->nama) }}"
                     data-jenis-kelamin="{{ $item->jenis_kelamin }}">
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
                            <h4 class="text-muted">Belum ada data warga</h4>
                            <p class="text-muted mb-4">Silakan tambah data warga pertama Anda</p>
                            <a href="{{ route('warga.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Tambah Data Warga
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchText = $(this).val().toLowerCase();
            filterCards();
        });

        // Filter functionality
        $('#filterJenisKelamin').on('change', function() {
            filterCards();
        });

        function filterCards() {
            const searchText = $('#searchInput').val().toLowerCase();
            const selectedGender = $('#filterJenisKelamin').val();

            $('.warga-card').each(function() {
                const name = $(this).data('name');
                const gender = $(this).data('jenis-kelamin');

                const nameMatch = name.includes(searchText);
                const genderMatch = !selectedGender || gender === selectedGender;

                if (nameMatch && genderMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
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
</style>
@endsection
