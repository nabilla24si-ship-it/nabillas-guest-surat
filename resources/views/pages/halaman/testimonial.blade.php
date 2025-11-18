@extends('layouts.guest.app')

@section('title', 'Testimoni - Layanan Mandiri Desa')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-3">Testimoni</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Halaman</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Testimoni</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimoni</h6>
                <h1 class="display-6 mb-4">Apa Kata Warga Tentang Kami!</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="flex-shrink-0 rounded-circle border p-1" src="{{ asset('assets-guest/img/testimonial-1.jpg') }}" alt="Warga 1">
                            <div class="ms-4">
                                <h5 class="mb-1">Ahmad Fauzi</h5>
                                <span>Warga Desa</span>
                            </div>
                        </div>
                        <p class="mb-0">"Sangat membantu! Sekarang tidak perlu antri lama untuk mengajukan surat domisili."</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="testimonial-item bg-light rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="flex-shrink-0 rounded-circle border p-1" src="{{ asset('assets-guest/img/testimonial-2.jpg') }}" alt="Warga 2">
                            <div class="ms-4">
                                <h5 class="mb-1">Sari Dewi</h5>
                                <span>Pedagang</span>
                            </div>
                        </div>
                        <p class="mb-0">"Proses pengajuan surat usaha jadi lebih cepat dan mudah dengan sistem online ini."</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="testimonial-item bg-light rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="flex-shrink-0 rounded-circle border p-1" src="{{ asset('assets-guest/img/testimonial-3.jpg') }}" alt="Warga 3">
                            <div class="ms-4">
                                <h5 class="mb-1">Bambang Sutrisno</h5>
                                <span>Pensiunan</span>
                            </div>
                        </div>
                        <p class="mb-0">"Pelayanan yang sangat memuaskan, petugasnya ramah dan prosesnya transparan."</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="testimonial-item bg-light rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="flex-shrink-0 rounded-circle border p-1" src="{{ asset('assets-guest/img/testimonial-4.jpg') }}" alt="Warga 4">
                            <div class="ms-4">
                                <h5 class="mb-1">Maya Sari</h5>
                                <span>Ibu Rumah Tangga</span>
                            </div>
                        </div>
                        <p class="mb-0">"Sangat praktis, bisa mengajukan surat dari rumah tanpa harus ke kantor desa."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
