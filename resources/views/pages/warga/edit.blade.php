@extends('layouts.guest.app')

@section('content')

        {{-- START MAIN CONTENT --}}
        <div class="py-4">
            <div class="container mt-4">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Warga</li>
                    </ol>
                </nav>

                <!-- Card -->
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Edit Data Warga</h5>
                    </div>

                    <div class="card-body">
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

                        <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">No KTP</label>
                                    <input type="text" name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}" class="form-control" required>
                                    @error('no_ktp')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}" class="form-control" required>
                                    @error('nama')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- FIELD ALAMAT - PERBAIKAN -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $warga->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <!-- JENIS KELAMIN - PERBAIKAN -->
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Agama</label>
                                    <input type="text" name="agama" value="{{ old('agama', $warga->agama) }}" class="form-control" required>
                                    @error('agama')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}" class="form-control" required>
                                    @error('pekerjaan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" name="telp" value="{{ old('telp', $warga->telp) }}" class="form-control" required>
                                    @error('telp')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $warga->email) }}" class="form-control" required>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

           {{-- END MAIN CONTENT --}}
@endsection
