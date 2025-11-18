@extends('layouts.guest.app')

@section('title', 'Tentang Kami - Layanan Mandiri Desa')
{{--  --}}
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-3">Tentang Kami</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Halaman</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Tentang</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Facts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                        <h5 class="mb-3">Pengalaman</h5>
                        <h1 class="display-5 mb-0">5</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-users-cog fa-4x text-primary mb-4"></i>
                        <h5 class="mb-3">Tim Profesional</h5>
                        <h1 class="display-5 mb-0">10</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-users fa-4x text-primary mb-4"></i>
                        <h5 class="mb-3">Warga Terlayani</h5>
                        <h1 class="display-5 mb-0">1234</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-check fa-4x text-primary mb-4"></i>
                        <h5 class="mb-3">Surat Selesai</h5>
                        <h1 class="display-5 mb-0">1234</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="img-border">
                        <img class="img-fluid" src="{{ asset('assets-guest/img/about.jpg') }}" alt="Tentang Kami">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="section-title bg-white text-start text-primary pe-3">Tentang Kami</h6>
                        <h1 class="display-6 mb-4">Layanan Mandiri Desa <span class="text-primary">Digital</span></h1>
                        <p>Layanan Mandiri Desa merupakan platform digital untuk memudahkan warga dalam mengajukan berbagai jenis surat keterangan secara online tanpa harus datang ke kantor desa.</p>
                        <p class="mb-4">Dengan sistem yang terintegrasi, proses pengajuan surat menjadi lebih cepat, transparan, dan dapat dipantau kapan saja.</p>
                        <div class="d-flex align-items-center mb-4 pb-2">
                            <img class="flex-shrink-0 rounded-circle" src="{{ asset('assets-guest/img/team-1.jpg') }}" alt="" style="width: 50px; height: 50px;">
                            <div class="ps-4">
                                <h6>Kepala Desa</h6>
                                <small>Pemerintah Desa</small>
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('contact') }}">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="h-100">
                        <h6 class="section-title bg-white text-start text-primary pe-3">Mengapa Memilih Kami</h6>
                        <h1 class="display-6 mb-4">Mengapa Warga Mempercayai Kami? Pelajari Tentang Kami!</h1>
                        <p class="mb-4">Kami berkomitmen untuk memberikan pelayanan terbaik dengan sistem yang mudah, cepat, dan transparan.</p>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="skill">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Pelayanan Online</p>
                                        <p class="mb-2">95%</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="skill">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Kecepatan Proses</p>
                                        <p class="mb-2">90%</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="skill">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Kepuasan Warga</p>
                                        <p class="mb-2">95%</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="img-border">
                        <img class="img-fluid" src="{{ asset('assets-guest/img/feature.jpg') }}" alt="Fitur Kami">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
@endsection
