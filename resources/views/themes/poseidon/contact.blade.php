@extends('themes.poseidon.layout')

@section('content')
<!-- Page Hero -->
<section class="poseidon-hero poseidon-hero-sm text-center py-5">
    <div class="container pt-5 mt-5" data-aos="fade-up">
        <h1 class="display-5 fw-bold">Hubungi Kami</h1>
        <p class="lead mt-3">Hubungi kami via WhatsApp untuk konsultasi dan informasi layanan digital.</p>
    </div>
</section>

<!-- Contact Content -->
<section class="poseidon-contact py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8" data-aos="fade-up">
                <p class="mb-4">Untuk pertanyaan, konsultasi, atau informasi lebih lanjut tentang layanan kami, silakan hubungi kami melalui WhatsApp. Tim kami siap membantu Anda.</p>
                <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-success btn-lg rounded-pill px-5 py-3">
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
