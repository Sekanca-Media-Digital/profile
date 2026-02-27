@extends('themes.empire.layout')

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
<section class="page-hero mt-3">
    <div class="container" data-aos="fade-up">
        <h1 class="display-5">{{ $service['title'] }}</h1>
    </div>
</section>

<!-- Service Detail -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="service-box p-4">
                    <div class="service-content">
                        {!! $service['description'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section>
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold">Tertarik dengan Layanan Ini?</h2>
        <p class="mt-3">Hubungi kami sekarang untuk konsultasi gratis.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-warning rounded-pill px-5 mt-3">Hubungi via WhatsApp</a>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
