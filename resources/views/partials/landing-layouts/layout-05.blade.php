<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo_title }}</title>
    @if(!empty($head_script)){!! $head_script !!}@endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; line-height: 1.6; color: #333; background: {{ $background_color }}; }
        .hero { text-align: center; padding: 3rem 1rem; }
        .hero h1 { font-size: 2rem; margin-bottom: 0.5rem; }
        .hero .tagline { color: #666; margin-bottom: 1.5rem; }
        .hero .btns a { display: inline-block; padding: 0.75rem 1.5rem; background: {{ $primary_color }}; color: #fff; text-decoration: none; border-radius: 6px; margin: 0 0.25rem 0.5rem 0; }
        .features { max-width: 960px; margin: 0 auto; padding: 2rem 1rem; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        @media (max-width: 640px) { .features { grid-template-columns: 1fr; } }
        .feature { text-align: center; padding: 1.5rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .feature h3 { font-size: 1.1rem; margin-bottom: 0.5rem; color: {{ $primary_color }}; }
        .cta { text-align: center; padding: 2rem 1rem; }
        .cta a { display: inline-block; padding: 0.75rem 1.5rem; background: {{ $primary_color }}; color: #fff; text-decoration: none; border-radius: 6px; }
        .navbar { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 10; }
        .navbar-brand { font-weight: 700; font-size: 1.25rem; color: #333; text-decoration: none; }
        .navbar-menu { display: flex; align-items: center; gap: 0.5rem; }
        .navbar-menu a { display: inline-block; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 500; text-decoration: none; transition: opacity 0.2s; }
        .navbar-menu a:hover { opacity: 0.9; }
        .nav-link-outline { color: {{ $primary_color }}; border: 1px solid {{ $primary_color }}; }
        .nav-link-solid { background: {{ $primary_color }}; color: #fff; }
        .navbar-logo { max-height: 2rem; width: auto; display: block; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-brand">@if(!empty($logo_url))<img src="{{ $logo_url }}" alt="" class="navbar-logo">@else{{ $seo_title }}@endif</a>
        <div class="navbar-menu">
            <a href="{{ ($register_url ?? '') ?: '#' }}" class="nav-link-outline" target="_blank" rel="noopener">Daftar</a>
            <a href="{{ ($login_url ?? '') ?: '#' }}" class="nav-link-solid" target="_blank" rel="noopener">Login</a>
        </div>
    </nav>
    <section class="hero">
        @if($image_url)<img src="{{ $image_url }}" alt="" style="max-width:200px;height:auto;margin-bottom:1rem;border-radius:8px;">@endif
        <h1>{{ $headline }}</h1>
        <p class="tagline">{{ $tagline }}</p>
        @if(count($buttons) > 0)
        <div class="btns">
            @foreach($buttons as $btn)
            <a href="{{ $btn['url'] ?? '#' }}" target="_blank" rel="noopener">{{ $btn['label'] }}</a>
            @endforeach
        </div>
        @endif
    </section>
    <section class="features">
        <div class="feature"><h3>Fitur 1</h3><p>Deskripsi singkat fitur pertama.</p></div>
        <div class="feature"><h3>Fitur 2</h3><p>Deskripsi singkat fitur kedua.</p></div>
        <div class="feature"><h3>Fitur 3</h3><p>Deskripsi singkat fitur ketiga.</p></div>
    </section>
    @if(count($buttons) > 0)
    <section class="cta">
        <a href="{{ $buttons[0]['url'] ?? '#' }}" target="_blank" rel="noopener">{{ $buttons[0]['label'] }}</a>
    </section>
    @endif
    @if(!empty($body_script)){!! $body_script !!}@endif
</body>
</html>
