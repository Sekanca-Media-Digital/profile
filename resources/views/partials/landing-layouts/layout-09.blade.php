<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo_title }}</title>
    @if(!empty($head_script)){!! $head_script !!}@endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; line-height: 1.6; color: #333; background: {{ $background_color }}; padding: 2rem 1rem; }
        .card { max-width: 480px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden; }
        .card-img { width: 100%; aspect-ratio: 16/10; object-fit: cover; }
        .card-body { padding: 1.5rem; text-align: center; }
        .card-body h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .card-body .tagline { color: #666; margin-bottom: 1.25rem; font-size: 0.95rem; }
        .btns a { display: inline-block; padding: 0.65rem 1.25rem; background: {{ $primary_color }}; color: #fff; text-decoration: none; border-radius: 6px; margin: 0 0.25rem 0.5rem 0; font-size: 0.9rem; }
        .btns a:hover { opacity: 0.9; }
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
    <div class="card">
        @if($image_url)
        <img src="{{ $image_url }}" alt="" class="card-img">
        @else
        <div style="background: linear-gradient(135deg, {{ $primary_color }}22, {{ $primary_color }}44); padding: 30%;"></div>
        @endif
        <div class="card-body">
            <h1>{{ $headline }}</h1>
            <p class="tagline">{{ $tagline }}</p>
            @if(count($buttons) > 0)
            <div class="btns">
                @foreach($buttons as $btn)
                <a href="{{ $btn['url'] ?? '#' }}" target="_blank" rel="noopener">{{ $btn['label'] }}</a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @if(!empty($body_script)){!! $body_script !!}@endif
</body>
</html>
