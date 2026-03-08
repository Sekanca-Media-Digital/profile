@php
    $meta = $meta ?? [];
    $siteName = $site['name'] ?? config('app.name');
    $title = $meta['title'] ?? $siteName;
    $title = \Illuminate\Support\Str::limit($title, 60);
    $desc = $meta['description'] ?? $meta['meta_description'] ?? '';
    $desc = $desc ? \Illuminate\Support\Str::limit(strip_tags($desc), 155) : '';
    $keywords = trim($meta['keywords'] ?? $meta['meta_keywords'] ?? '');
    $canonical = $meta['canonical'] ?? url()->current();
    $canonicalAbs = $canonical ? (\Illuminate\Support\Str::startsWith($canonical, 'http') ? $canonical : url($canonical)) : url()->current();
    $ogImage = $meta['og_image'] ?? $meta['image'] ?? ($site['image'] ?? asset('assets/images/logo.webp'));
    $ogImageAbs = \Illuminate\Support\Str::startsWith($ogImage, 'http') ? $ogImage : url($ogImage);
    $ogImageWidth = $meta['og_image_width'] ?? null;
    $ogImageHeight = $meta['og_image_height'] ?? null;
    $ogImageAlt = $meta['og_image_alt'] ?? ($siteName . ' - ' . ($desc ?: 'Digital Agency'));
@endphp
{{-- Favicon (sesuai Google Search: square 1:1, multi-size 48/96/192, stable URL) --}}
{{-- https://developers.google.com/search/docs/appearance/favicon-in-search --}}
@if(file_exists(public_path('favicon.ico')))
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48" type="image/x-icon">
@endif
@if(file_exists(public_path('favicon-192x192.png')))
<link rel="icon" href="{{ asset('favicon-192x192.png') }}" type="image/png" sizes="192x192">
@endif
@if(file_exists(public_path('favicon-96x96.png')))
<link rel="icon" href="{{ asset('favicon-96x96.png') }}" type="image/png" sizes="96x96">
@endif
<link rel="icon" href="{{ asset('favicon-48x48.png') }}" type="image/png" sizes="48x48">
<link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
<link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">

{{-- SEO: Title & Canonical (Google: title 50-60 char, unique per page) --}}
<title>{{ $title }}</title>
<link rel="canonical" href="{{ $canonicalAbs }}">

@if($desc)
<meta name="description" content="{{ $desc }}">
@endif
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $meta['robots'] ?? 'index, follow' }}">
<meta name="format-detection" content="telephone=no">

{{-- Open Graph (Google, Facebook: image 1200x630 recommended) --}}
<meta property="og:type" content="{{ $meta['og_type'] ?? 'website' }}">
<meta property="og:title" content="{{ $meta['og_title'] ?? $title }}">
@if($desc)
<meta property="og:description" content="{{ $meta['og_description'] ?? $desc }}">
@endif
<meta property="og:url" content="{{ $meta['og_url'] ?? $canonicalAbs }}">
<meta property="og:image" content="{{ $ogImageAbs }}">
@if($ogImageWidth && $ogImageHeight)
<meta property="og:image:width" content="{{ $ogImageWidth }}">
<meta property="og:image:height" content="{{ $ogImageHeight }}">
@endif
<meta property="og:image:alt" content="{{ $ogImageAlt }}">
@if(config('app.https_enabled'))
<meta property="og:image:secure_url" content="{{ $ogImageAbs }}">
@endif
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $meta['locale'] ?? 'id_ID' }}">

{{-- Twitter Card (summary_large_image: 1200x630) --}}
<meta name="twitter:card" content="{{ $meta['twitter_card'] ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $meta['twitter_title'] ?? $title }}">
@if($desc)
<meta name="twitter:description" content="{{ $meta['twitter_description'] ?? $desc }}">
@endif
<meta name="twitter:image" content="{{ $ogImageAbs }}">
<meta name="twitter:image:alt" content="{{ $ogImageAlt }}">
