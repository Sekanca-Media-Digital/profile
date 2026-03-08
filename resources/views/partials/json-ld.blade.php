@php
    $siteName = $site['name'] ?? config('app.name');
    $siteUrl = $site['url'] ?? config('app.url');
    $siteImage = $site['image'] ?? asset('assets/images/logo.webp');
    $siteImageAbs = \Illuminate\Support\Str::startsWith($siteImage, 'http') ? $siteImage : url($siteImage);
@endphp
{{-- JSON-LD structured data (Google Search, AI overviews) --}}
{{-- https://developers.google.com/search/docs/appearance/structured-data --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'name' => $siteName,
            'url' => url('/'),
            'description' => 'Digital agency Indonesia - layanan Security as a Service, Digital Marketing, Social Media Marketing.',
            'publisher' => ['@id' => url('/') . '#organization'],
        ],
        [
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => $siteName,
            'url' => $siteUrl,
            'logo' => ['@type' => 'ImageObject', 'url' => $siteImageAbs],
            'image' => $siteImageAbs,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
