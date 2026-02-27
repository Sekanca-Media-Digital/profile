@php
    $meta = $meta ?? [];
    $siteName = $site['name'] ?? config('app.name');
    $title = $meta['title'] ?? $siteName;
    $desc = $meta['description'] ?? $meta['meta_description'] ?? '';
    $desc = $desc ? \Illuminate\Support\Str::limit(strip_tags($desc), 160) : '';
    $keywords = trim($meta['keywords'] ?? $meta['meta_keywords'] ?? '');
    $canonical = $meta['canonical'] ?? url()->current();
    $canonicalAbs = $canonical ? (\Illuminate\Support\Str::startsWith($canonical, 'http') ? $canonical : url($canonical)) : url()->current();
    $ogImage = $meta['og_image'] ?? $meta['image'] ?? ($site['image'] ?? asset('assets/images/logo.webp'));
    $ogImageAbs = \Illuminate\Support\Str::startsWith($ogImage, 'http') ? $ogImage : url($ogImage);
@endphp
{{-- Favicon (rekomendasi Google: multi-size) --}}
<link rel="icon" href="{{ asset('favicon-48x48.png') }}" type="image/png" sizes="48x48">
<link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
<link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">

{{-- SEO: Title & Canonical (wajib untuk Google) --}}
<title>{{ $title }}</title>
<link rel="canonical" href="{{ $canonicalAbs }}">

@if($desc)
<meta name="description" content="{{ $desc }}">
@endif
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $meta['robots'] ?? 'index, follow' }}">

{{-- Open Graph (Facebook, Google rich results) --}}
<meta property="og:type" content="{{ $meta['og_type'] ?? 'website' }}">
<meta property="og:title" content="{{ $meta['og_title'] ?? $title }}">
@if($desc)
<meta property="og:description" content="{{ $desc }}">
@endif
<meta property="og:url" content="{{ $meta['og_url'] ?? $canonicalAbs }}">
<meta property="og:image" content="{{ $ogImageAbs }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $meta['locale'] ?? 'id_ID' }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="{{ $meta['twitter_card'] ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $meta['twitter_title'] ?? $title }}">
@if($desc)
<meta name="twitter:description" content="{{ $desc }}">
@endif
<meta name="twitter:image" content="{{ $ogImageAbs }}">
