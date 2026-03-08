<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.lcp-resources')
    @include('partials.gtm')
    @include('partials.meta')
    @include('partials.critical-css')

    @include('partials.json-ld')

    {{-- Defer render-blocking CSS: load async so they don't block LCP (saves ~1,620 ms) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></noscript>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"></noscript>

    <link href="{{ asset(config('app.theme') . 'css/style.css') }}" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="{{ asset(config('app.theme') . 'css/style.css') }}" rel="stylesheet"></noscript>

    <!-- AOS (non-critical: load async to avoid blocking LCP) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"></noscript>
</head>
<body class="poseidon-theme">
@include('partials.gtm-noscript')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top poseidon-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ $site['logo'] ?? asset('assets/images/logo.webp') }}" height="60" width="120" class="me-2" alt="{{ $site['name'] ?? '' }}" fetchpriority="high" decoding="async" style="object-fit:contain">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Buka menu navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-center">
                @foreach($menu ?? [] as $item)
                    @if($item['type'] === 'dropdown')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $item['label'] }}</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @foreach($item['items'] ?? [] as $sub)
                                    <li><a class="dropdown-item {{ ($sub['disabled'] ?? false) ? 'disabled' : '' }}" href="{{ $sub['url'] ?? '#' }}" @if($sub['external'] ?? false) target="_blank" rel="noopener" @endif>{{ $sub['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $item['url'] ?? '#' }}" @if($item['external'] ?? false) target="_blank" rel="noopener" @endif>{{ $item['label'] }}</a>
                        </li>
                    @endif
                @endforeach
                <li class="nav-item ms-2">
                    <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-cta-poseidon">Coba Sekarang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
(function(){var t=document.querySelector('.navbar-toggler'),c=document.querySelector('.navbar-collapse');t&&c&&t.addEventListener('click',function(){c.classList.toggle('show');});})();
</script>

<main class="content-below-nav">
@yield('content')
</main>

<!-- Footer -->
<footer class="poseidon-footer text-center">
    <div class="container py-4">
        {{ $site['footer'] ?? '© 2026 Sekanca Media Digital. All Rights Reserved.' }}
    </div>
</footer>

<!-- JS (defer to not block parsing) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.AOS) AOS.init({ duration: 1000, once: true });
    });
</script>

</body>
</html>
