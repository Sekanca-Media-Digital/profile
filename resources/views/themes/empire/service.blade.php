@extends('themes.empire.layout')

@section('content')
<!-- Page Hero -->
<section class="page-hero mt-5">
    <div class="container" data-aos="fade-up">
        <h1 class="display-5">Layanan Profesional Kami</h1>
        <p class="lead mt-3">{{ $description }}</p>
    </div>
</section>

<!-- Services Detail -->
<section>
    <div class="container">
        <div class="row g-4">
            @foreach ($service as $index => $item)
                <div class="col-md-4" data-aos="fade-up" @if($index > 0) data-aos-delay="{{ $index * 200 }}" @endif>
                    <a href="{{ route('service.show', $item['slug']) }}" class="text-decoration-none text-dark">
                        <div class="service-box text-center h-100">
                            <h5 class="fw-bold text-warning">{{ $item['title'] }}</h5>
                            <p>{!! \Illuminate\Support\Str::limit(strip_tags($item['description']), 120) !!}</p>
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
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold">Siap Memulai Proyek Anda?</h2>
        <p class="mt-3">Hubungi kami sekarang dan dapatkan konsultasi gratis.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-brand mt-3">Hubungi Kami</a>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
