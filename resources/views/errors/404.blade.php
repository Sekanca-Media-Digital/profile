@php
    $layoutName = 'themes.' . last(explode('/', rtrim(config('app.theme'), '/'))) . '.layout';
    $title = 'Halaman Tidak Ditemukan';
    $code = '404';
    $message = $message ?? 'Halaman yang Anda cari tidak ada atau telah dipindahkan.';
@endphp
@extends($layoutName)

@section('content')
<section class="{{ config('app.theme') === 'themes/poseidon/' ? 'poseidon-hero poseidon-hero-sm text-center py-5' : 'page-hero' }}">
    <div class="container text-center" data-aos="fade-up">
        <p class="display-1 fw-bold {{ config('app.theme') === 'themes/poseidon/' ? 'poseidon-accent' : 'text-warning' }} mb-0">{{ $code }}</p>
        <h1 class="display-5 mt-2">{{ $title }}</h1>
        <p class="lead mt-3">{{ $message }}</p>
        <a href="{{ route('home') }}" class="btn {{ config('app.theme') === 'themes/poseidon/' ? 'btn-cta-poseidon' : 'btn-warning' }} rounded-pill px-5 py-3 mt-3">Kembali ke Beranda</a>
    </div>
</section>
@endsection
