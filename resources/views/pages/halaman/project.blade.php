@extends('layouts.guest.app')

@section('title', 'Proyek - Layanan Mandiri Desa')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-3">Proyek</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Halaman</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Proyek</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Project Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Proyek Kami</h6>
                <h1 class="display-6 mb-4">Pelajari Lebih Lanjut Tentang Proyek Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="project-item border rounded h-100 p-4">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('assets-guest/img/project-1.jpg') }}" alt="Sistem Online">
                            <a href="{{ asset('assets-guest/img/project-1.jpg') }}" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                        </div>
                        <h6>Sistem Pelayanan Online</h6>
                        <span>Pengembangan sistem pelayanan surat online terintegrasi</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="project-item border rounded h-100 p-4">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('assets-guest/img/project-2.jpg') }}" alt="Database Warga">
                            <a href="{{ asset('assets-guest/img/project-2.jpg') }}" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                        </div>
                        <h6>Database Warga</h6>
                        <span>Sistem database warga terpadu dan terjamin keamanannya</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="project-item border rounded h-100 p-4">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('assets-guest/img/project-3.jpg') }}" alt="Mobile App">
                            <a href="{{ asset('assets-guest/img/project-3.jpg') }}" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                        </div>
                        <h6>Aplikasi Mobile</h6>
                        <span>Pengembangan aplikasi mobile untuk akses yang lebih mudah</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->
@endsection
