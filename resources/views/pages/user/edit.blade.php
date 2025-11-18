@extends('layouts.guest.app')

@section('title', 'Edit User - Layanan Mandiri Desa')

@section('content')
<!-- Header Section -->
<div class="container-fluid py-5 bg-primary hero-header mb-5">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated slideInDown">Edit User</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Edit User</li>
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
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            <!-- Form Section -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 text-primary">
                                <i class="fas fa-user-edit me-2"></i>Edit User - {{ $dataUser->name }}
                            </h4>
                            <a href="{{ route('user.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-4">Form untuk mengedit data user.</p>

                        <form action="{{ route('user.update', $dataUser->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-1 text-primary"></i>Nama User
                                    </label>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name', $dataUser->name) }}" required
                                           placeholder="Masukkan nama user">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-1 text-primary"></i>Email
                                    </label>
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email', $dataUser->email) }}" required
                                           placeholder="Masukkan email user">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="fas fa-key me-1 text-primary"></i>Password Baru
                                    </label>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                    <div class="form-text text-muted small">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Minimal 8 karakter. Biarkan kosong jika tidak ingin mengubah password.
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="fas fa-key me-1 text-primary"></i>Konfirmasi Password
                                    </label>
                                    <input type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror"
                                           name="password_confirmation"
                                           placeholder="Konfirmasi password baru">
                                    <div class="form-text text-muted small">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Wajib diisi jika mengubah password.
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i>Simpan Perubahan
                                        </button>
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i>Batal
                                        </a>
                                        <button type="reset" class="btn btn-outline-warning">
                                            <i class="fas fa-redo me-1"></i>Reset Form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- User Info Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi User</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>ID User:</strong>
                            <span class="badge bg-primary">#{{ $dataUser->id }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Dibuat:</strong>
                            <br>
                            <span class="text-muted small">{{ $dataUser->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="mb-0">
                            <strong>Terakhir Diupdate:</strong>
                            <br>
                            <span class="text-muted small">{{ $dataUser->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Panduan Edit</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info alert-sm mb-0">
                            <small>
                                <i class="fas fa-lightbulb me-1"></i>
                                <strong>Tips:</strong>
                                <ul class="mt-2 mb-0 ps-3">
                                    <li>Password bersifat opsional</li>
                                    <li>Email harus unik</li>
                                    <li>Password minimal 8 karakter</li>
                                </ul>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card {
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 2px solid #e9ecef;
    }

    .alert-sm {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .form-text {
        font-size: 0.8rem;
    }

    .badge {
        font-size: 0.75rem;
    }
</style>
@endpush
