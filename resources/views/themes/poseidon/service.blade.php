@extends('themes.poseidon.layout')

@section('content')
<!-- Page Hero -->
<section class="poseidon-hero poseidon-hero-sm text-center py-5">
    <div class="container pt-5 mt-5" data-aos="fade-up">
        <h1 class="display-5 fw-bold">Layanan Profesional Kami</h1>
        <p class="lead mt-3">{{ $description }}</p>
    </div>
</section>

<!-- Services Detail -->
<section class="poseidon-services py-5">
    <div class="container">
        <div class="row g-4">
            @foreach ($service as $index => $item)
                <div class="col-md-4" data-aos="fade-up" @if($index > 0) data-aos-delay="{{ $index * 200 }}" @endif>
                    <a href="{{ route('service.show', $item['slug']) }}" class="text-decoration-none">
                        <div class="poseidon-service-card card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <h5 class="fw-bold poseidon-accent mb-3">{{ $item['title'] }}</h5>
                                <p class="text-muted">{!! \Illuminate\Support\Str::limit(strip_tags($item['description']), 120) !!}</p>
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
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold mb-3">Siap Memulai Proyek Anda?</h2>
        <p class="mb-4">Hubungi kami sekarang dan dapatkan konsultasi gratis.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-cta-poseidon btn-lg rounded-pill px-4">Hubungi Kami</a>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
