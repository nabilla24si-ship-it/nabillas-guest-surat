@extends('layouts.guest.app')
{{--  --}}
@section('content')
    {{-- START MAIN CONTENT --}}
    <div class="py-4">
      <div class="container mt-4">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Warga</li>
          </ol>
        </nav>

        <div class="card shadow border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Data Warga</h5>
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

            <form action="{{ route('warga.store') }}" method="POST">
              @csrf

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">No KTP</label>
                  <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp') }}" required>
                  @error('no_ktp')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                  @error('nama')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- FIELD ALAMAT YANG PERLU DITAMBAHKAN -->
              <div class="row mb-3">
                <div class="col-12">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                  @error('alamat')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                  @error('jenis_kelamin')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label">Agama</label>
                  <input type="text" name="agama" class="form-control" value="{{ old('agama') }}" required>
                  @error('agama')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Pekerjaan</label>
                  <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" required>
                  @error('pekerjaan')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label">Telepon</label>
                  <input type="text" name="telp" class="form-control" value="{{ old('telp') }}" required>
                  @error('telp')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                  <div class="text-danger small">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="bg-white rounded shadow p-5 mb-4 mt-4">
      <div class="row">
        <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
          <p class="mb-0 text-center text-lg-start">
            © 2019-<span class="current-year"></span>
            <a class="text-primary fw-normal" href="https://themesberg.com" target="_blank">Themesberg</a>
          </p>
        </div>
        <div class="col-12 col-md-8 col-xl-6 text-center text-lg-start">
          <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">
            <li class="list-inline-item px-0 px-sm-2"><a href="#">About</a></li>
            <li class="list-inline-item px-0 px-sm-2"><a href="#">Themes</a></li>
            <li class="list-inline-item px-0 px-sm-2"><a href="#">Blog</a></li>
            <li class="list-inline-item px-0 px-sm-2"><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    {{-- END MAIN CONTENT --}}
@endsection
