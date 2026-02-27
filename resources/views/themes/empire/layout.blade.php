<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.meta')

    {{-- JSON-LD WebSite (Google structured data) --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $site['name'] ?? config('app.name'),
        'url' => url('/'),
    ]) !!}
    </script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset(config('app.theme') . 'css/style.css') }}" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top mb-5">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ $site['logo'] ?? asset('assets/images/logo.webp') }}" height="80" class="me-2" alt="{{ $site['name'] ?? '' }}">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Buka menu navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                @foreach($menu ?? [] as $item)
                    @if($item['type'] === 'dropdown')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $item['label'] }}</a>
                            <ul class="dropdown-menu">
                                @foreach($item['items'] ?? [] as $sub)
                                    <li><a class="dropdown-item {{ ($sub['disabled'] ?? false) ? 'disabled' : '' }}" href="{{ $sub['url'] ?? '#' }}">{{ $sub['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $item['url'] ?? '#' }}" {{ ($item['external'] ?? false) ? 'target="_blank" rel="noopener"' : '' }}>{{ $item['label'] }}</a>
                        </li>
                    @endif
                @endforeach
                <li class="nav-item">
                    <a href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank" rel="noopener" class="btn btn-warning rounded-pill ms-3 px-4">Coba Sekarang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        {{ $site['footer'] ?? '© 2026 Sekanca Media Digital. All Rights Reserved.' }}
    </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

</body>
</html>
