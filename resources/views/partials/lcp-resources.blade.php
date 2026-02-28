@php
    $logoUrl = $site['logo'] ?? asset('assets/images/logo.webp');
    $logoUrl = \Illuminate\Support\Str::startsWith($logoUrl, 'http') ? $logoUrl : url($logoUrl);
@endphp
{{-- Preconnect to critical origins (reduces connection time for LCP) --}}
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
<link rel="preconnect" href="https://unpkg.com" crossorigin>
{{-- Preload LCP image (logo above the fold) --}}
<link rel="preload" as="image" href="{{ $logoUrl }}">
