@extends('themes.poseidon.layout')

@section('content')
<!-- Breadcrumb -->
<nav class="container mt-5 pt-5" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Layanan</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $service['title'] }}</li>
    </ol>
</nav>

<!-- Page Hero -->
<section class="poseidon-hero poseidon-hero-sm text-center py-5">
    <div class="container pt-5 mt-5" data-aos="fade-up">
        <h1 class="display-5 fw-bold">{{ $service['title'] }}</h1>
    </div>
</section>

<!-- Service Detail -->
<section class="poseidon-services py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="poseidon-service-card card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="service-content">
                            {!! $service['description'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="poseidon-cta py-5">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold mb-3">Tertarik dengan Layanan Ini?</h2>
        <p class="mb-4">Hubungi kami sekarang untuk konsultasi gratis.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-cta-poseidon btn-lg rounded-pill px-5">Hubungi via WhatsApp</a>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
