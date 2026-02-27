@extends('themes.empire.layout')
@section('content')

<!-- Hero -->
<section class="hero text-center">
    <div class="container" data-aos="fade-up">
        <h1 class="display-4">Digital Innovation for Modern Business</h1>
        <p class="lead mt-3">Kami membantu bisnis berkembang dengan solusi digital kreatif dan profesional.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-primary-custom mt-4">Coba Layanan</a>
    </div>
</section>

<!-- About -->
<section id="about">
    <div class="container text-center">
        <h2 class="section-title mb-4" data-aos="fade-up">{{ $about['title'] }}</h2>
        <p class="mx-auto col-lg-8" data-aos="fade-up" data-aos-delay="200">
            {{ $about['description'] }}
        </p>
    </div>
</section>

<!-- Services -->
<section id="services" class="bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title" data-aos="fade-up">Layanan Kami</h2>
        </div>

        <div class="row g-4">
            @foreach ($service as $item)
                <div class="col-md-4" data-aos="fade-up">
                    <a href="{{ route('service.show', $item['slug']) }}" class="text-decoration-none text-dark">
                        <div class="service-card text-center h-100">
                            <h5 class="fw-bold text-warning">{{ $item['title'] }}</h5>
                            <p>{!! \Illuminate\Support\Str::limit(strip_tags($item['description']), 100) !!}</p>
                            <span class="text-warning small">Selengkapnya →</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section>
    <div class="container">
        <div class="cta text-center" data-aos="zoom-in">
            <h2>Siap Mengembangkan Bisnis Anda?</h2>
            <p class="mt-3">Mari mulai kolaborasi bersama kami.</p>
            <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-light rounded-pill px-4 mt-3">Hubungi Kami</a>
        </div>
    </div>
</section>

<!-- Contact -->
<section id="contact">
    <div class="container text-center">
        <h2 class="section-title mb-4" data-aos="fade-up">Contact Us</h2>

        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <p class="mb-4">Hubungi kami via WhatsApp untuk konsultasi dan informasi lebih lanjut.</p>
                <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-success rounded-pill px-5 py-3">
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
