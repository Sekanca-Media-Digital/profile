@extends('themes.poseidon.layout')

@section('content')
@php $lokerUrl = $lokerUrl ?? 'https://www.loker.id/profile/sekanca-media-digital'; $glintsUrl = $glintsUrl ?? 'https://glints.com/companies/sekanca-media-digital/a36cc466-518b-403a-a58b-181eec54ee90'; @endphp
<!-- Page Hero -->
<section class="poseidon-hero poseidon-hero-sm text-center py-5">
    <div class="container" data-aos="fade-up">
        <h1 class="display-5 fw-bold">Career</h1>
        <p class="lead mt-3">Bergabung dengan tim Sekanca Media Digital. Lihat peluang karir dan lowongan kerja di bidang digital.</p>
    </div>
</section>

<!-- Intro -->
<section class="poseidon-contact py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <p class="mb-4">Sekanca Media Digital membuka peluang karir bagi profesional kreatif di bidang digital marketing, web development, design, dan branding. Lamar langsung melalui Loker.id.</p>
                <a href="{{ $lokerUrl }}" target="_blank" rel="noopener" class="btn btn-cta-poseidon btn-lg rounded-pill px-5 py-3 me-2 mb-2">
                    Loker.id
                </a>
                <a href="{{ $glintsUrl }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-lg rounded-pill px-5 py-3 me-2 mb-2">
                    Glints
                </a>
                <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-lg rounded-pill px-5 py-3 mb-2">
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Job Listings -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Lowongan Tersedia</h2>
        <div class="row g-4">
            @foreach ($jobs ?? [] as $index => $job)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" @if($index > 0) data-aos-delay="{{ min($index * 100, 400) }}" @endif>
                    <div class="card h-100 shadow-sm border-0 rounded-3 poseidon-service-card">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">{{ $job['type'] ?? 'Full-time' }}</span>
                            <h5 class="card-title fw-bold poseidon-accent">{{ $job['title'] }}</h5>
                            <p class="text-muted small mb-2">
                                <span class="me-2">📍 {{ $job['location'] ?? 'Jakarta' }}</span>
                            </p>
                            <p class="card-text small">{{ $job['description'] ?? '' }}</p>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <a href="{{ $job['apply_url'] ?? $lokerUrl ?? '#' }}" target="_blank" rel="noopener" class="btn btn-cta-poseidon btn-sm rounded-pill">
                                    Loker.id
                                </a>
                                @if(!empty($job['glints_url']))
                                    <a href="{{ $job['glints_url'] }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-sm rounded-pill">
                                        Glints
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="poseidon-cta py-5">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold mb-3">Tertarik Bergabung?</h2>
        <p class="mb-4">Cek posisi yang tersedia di <a href="{{ $lokerUrl ?? '#' }}" target="_blank" rel="noopener" class="text-white text-decoration-underline">Loker.id</a> atau <a href="{{ $glintsUrl ?? '#' }}" target="_blank" rel="noopener" class="text-white text-decoration-underline">Glints</a>, atau hubungi kami via WhatsApp untuk konsultasi karir.</p>
        <a href="{{ $lokerUrl ?? '#' }}" target="_blank" rel="noopener" class="btn btn-light btn-lg rounded-pill px-5 me-2">Loker.id</a>
        <a href="{{ $glintsUrl ?? '#' }}" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg rounded-pill px-5 me-2">Glints</a>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg rounded-pill px-5">WhatsApp</a>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
