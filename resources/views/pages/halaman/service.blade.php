@extends('layouts.guest.app')

@section('title', 'Layanan - Layanan Mandiri Desa')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-3">Layanan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Halaman</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Layanan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Layanan</h6>
                <h1 class="display-6 mb-4">Jenis Surat Yang Tersedia</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-block rounded text-center h-100 p-4">
                        <img class="img-fluid rounded mb-4" src="{{ asset('assets-guest/img/service-1.jpg') }}" alt="Surat Domisili">
                        <h4 class="mb-0">Surat Keterangan Domisili</h4>
                        <p class="mt-2">Untuk keperluan administrasi tempat tinggal</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-block rounded text-center h-100 p-4">
                        <img class="img-fluid rounded mb-4" src="{{ asset('assets-guest/img/service-2.jpg') }}" alt="Surat Usaha">
                        <h4 class="mb-0">Surat Keterangan Usaha</h4>
                        <p class="mt-2">Untuk keperluan perizinan dan pengembangan usaha</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-block rounded text-center h-100 p-4">
                        <img class="img-fluid rounded mb-4" src="{{ asset('assets-guest/img/service-3.jpg') }}" alt="Surat Tidak Mampu">
                        <h4 class="mb-0">Surat Keterangan Tidak Mampu</h4>
                        <p class="mt-2">Untuk keperluan bantuan sosial dan pendidikan</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-block rounded text-center h-100 p-4">
                        <img class="img-fluid rounded mb-4" src="{{ asset('assets-guest/img/service-4.jpg') }}" alt="Surat Kematian">
                        <h4 class="mb-0">Surat Keterangan Kematian</h4>
                        <p class="mt-2">Untuk keperluan administrasi kematian</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-block rounded text-center h-100 p-4">
                        <img class="img-fluid rounded mb-4" src="{{ asset('assets-guest/img/service-5.jpg') }}" alt="Surat Kelahiran">
                        <h4 class="mb-0">Surat Keterangan Kelahiran</h4>
                        <p class="mt-2">Untuk keperluan administrasi kelahiran</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-block rounded text-center h-100 p-4">
                        <img class="img-fluid rounded mb-4" src="{{ asset('assets-guest/img/service-6.jpg') }}" alt="Surat Lainnya">
                        <h4 class="mb-0">Surat Keterangan Lainnya</h4>
                        <p class="mt-2">Berbagai jenis surat keterangan lainnya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
