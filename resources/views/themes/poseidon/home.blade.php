@extends('themes.poseidon.layout')
@section('content')

<!-- Hero -->
<section class="poseidon-hero text-center py-5">
    <div class="container pt-5 mt-5" data-aos="fade-up">
        <h1 class="display-4 fw-bold poseidon-hero-title">Digital Innovation for Modern Business</h1>
        <p class="lead mt-3 poseidon-hero-subtitle">Kami membantu bisnis berkembang dengan solusi digital kreatif dan profesional.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-cta-poseidon btn-lg mt-4">Coba Layanan</a>
    </div>
</section>

<!-- About -->
<section id="about" class="poseidon-about py-5">
    <div class="container text-center">
        <h2 class="section-title mb-4" data-aos="fade-up">{{ $about['title'] }}</h2>
        <p class="mx-auto col-lg-8" data-aos="fade-up" data-aos-delay="200">
            {{ $about['description'] }}
        </p>
    </div>
</section>

<!-- Services -->
<section id="services" class="poseidon-services py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title" data-aos="fade-up">Layanan Kami</h2>
        </div>

        <div class="row g-4">
            @foreach ($service as $item)
                <div class="col-md-4" data-aos="fade-up">
                    <a href="{{ route('service.show', $item['slug']) }}" class="text-decoration-none">
                        <div class="poseidon-service-card card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <h5 class="fw-bold poseidon-accent mb-3">{{ $item['title'] }}</h5>
                                <p class="text-muted">{!! \Illuminate\Support\Str::limit(strip_tags($item['description']), 100) !!}</p>
                                <span class="poseidon-accent small">Selengkapnya →</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="poseidon-cta py-5">
    <div class="container">
        <div class="poseidon-cta-box text-center py-5 px-4 rounded-4" data-aos="zoom-in">
            <h2 class="fw-bold mb-3">Siap Mengembangkan Bisnis Anda?</h2>
            <p class="mb-4">Mari mulai kolaborasi bersama kami.</p>
            <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-light btn-lg rounded-pill px-4">Hubungi Kami</a>
        </div>
    </div>
</section>

<!-- Contact -->
<section id="contact" class="poseidon-contact py-5">
    <div class="container text-center">
        <h2 class="section-title mb-4" data-aos="fade-up">Contact Us</h2>

        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <p class="mb-4">Hubungi kami via WhatsApp untuk konsultasi dan informasi lebih lanjut.</p>
                <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-success btn-lg rounded-pill px-5 py-3">
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
