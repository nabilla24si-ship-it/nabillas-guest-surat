@extends('layouts.guest.app')
{{--  --}}
@section('content')
    {{-- START MAIN CONTENT --}}
        <div class="py-4">
            <div class="container mt-4">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jenis-surat.index') }}">Jenis Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Surat</li>
                    </ol>
                </nav>

                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Jenis Surat</h5>
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

                        <form action="{{ route('jenis-surat.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Kode Jenis Surat</label>
                                    <input type="text" name="kode" class="form-control"
                                        value="{{ old('kode') }}" required>
                                    @error('kode')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Jenis Surat</label>
                                    <input type="text" name="nama_jenis" class="form-control"
                                        value="{{ old('nama_jenis') }}" required>
                                    @error('nama_jenis')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Syarat (Format JSON)</label>
                                <textarea name="syarat_json" class="form-control" rows="4"
                                    placeholder='Contoh: ["KTP", "KK", "Surat Pengantar RT"]'>{{ old('syarat_json') }}</textarea>
                                @error('syarat_json')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Masukkan syarat dalam format JSON array. Contoh: <code>["KTP", "KK", "Surat Pengantar RT"]</code>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('jenis-surat.index') }}" class="btn btn-outline-secondary">Kembali</a>
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

