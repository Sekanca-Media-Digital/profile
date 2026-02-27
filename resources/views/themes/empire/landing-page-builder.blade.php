@extends('themes.empire.layout')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="h4 mb-3" data-aos="fade-up">Landing Page Builder</h1>
        <p class="text-muted mb-4" data-aos="fade-up">Pilih layout, warna, tombol, gambar, dan SEO. Hasil HTML satu halaman siap disalin atau diunduh.</p>
        @include('partials.landing-page-builder-form', ['layouts' => $layouts ?? []])
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
