@extends('themes.empire.layout')

@section('content')
<!-- Page Hero -->
<section class="page-hero mt-5">
    <div class="container" data-aos="fade-up">
        <h1 class="display-5">{{ $about['title'] }}</h1>
        <p class="lead mt-3">{{ $about['description'] }}</p>
    </div>
</section>

<!-- About Content -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <p class="lead">{{ $about['description'] }}</p>
                <p class="mt-4">Sekanca Media Digital hadir sebagai mitra strategis untuk mendukung transformasi digital bisnis Anda. Dengan tim berpengalaman dan pendekatan yang berfokus pada hasil, kami siap membantu Anda mencapai tujuan bisnis.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section>
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold">Mari Berkolaborasi Bersama Kami</h2>
        <p class="mt-3">Hubungi kami via WhatsApp untuk diskusi lebih lanjut.</p>
        <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-warning rounded-pill px-5 mt-3">Hubungi Kami</a>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
