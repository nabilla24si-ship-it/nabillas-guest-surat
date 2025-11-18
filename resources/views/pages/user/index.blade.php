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
                <h2 class="text-primary mb-1">Data User</h2>
                <p class="mb-0">List data seluruh user</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah User
                </a>
            </div>
        </div>

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
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- User Info -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-envelope text-muted me-2"></i>
                                    <span class="small">{{ $item->email }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-key text-muted me-2"></i>
                                    <span class="small text-muted">Password terenkripsi</span>
                                </div>
                            </div>

                            <!-- Security Note -->
                            <div class="alert alert-warning alert-sm mb-3">
                                <small>
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Password disimpan secara aman dengan enkripsi
                                </small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('user.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit User
                                </a>
                                <div class="btn-group" role="group">
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                onclick="return confirm('Yakin hapus user {{ $item->name }}?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Terdaftar sejak {{ $item->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada data user</h4>
                            <p class="text-muted mb-4">Silakan tambah user pertama Anda</p>
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Tambah User
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

    .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        margin-bottom: 1rem;
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
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchText = $(this).val().toLowerCase();
            $('.user-card').each(function() {
                const name = $(this).data('name');
                if (name.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endpush
