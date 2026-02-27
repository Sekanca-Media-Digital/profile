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
        .navbar { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 10; }
        .navbar-brand { font-weight: 700; font-size: 1.25rem; color: #333; text-decoration: none; }
        .navbar-menu { display: flex; align-items: center; gap: 0.5rem; }
        .navbar-menu a { display: inline-block; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 500; text-decoration: none; transition: opacity 0.2s; }
        .navbar-menu a:hover { opacity: 0.9; }
        .nav-link-outline { color: {{ $primary_color }}; border: 1px solid {{ $primary_color }}; }
        .nav-link-solid { background: {{ $primary_color }}; color: #fff; }
        .container { max-width: 720px; margin: 0 auto; padding: 3rem 1rem; text-align: center; }
        h1 { font-size: 2rem; margin-bottom: 1rem; }
        .tagline { color: #666; margin-bottom: 2rem; }
        .img-wrap { margin-bottom: 2rem; border-radius: 8px; overflow: hidden; }
        .img-wrap img { width: 100%; height: auto; display: block; }
        .btns { display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center; }
        .btns a { display: inline-block; padding: 0.75rem 1.5rem; background: {{ $primary_color }}; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600; }
        .btns a:hover { opacity: 0.9; }
        .navbar-logo { max-height: 2rem; width: auto; display: block; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-brand">@if(!empty($logo_url))<img src="{{ $logo_url }}" alt="" class="navbar-logo">@else{{ $seo_title }}@endif</a>
        <div class="navbar-menu">
            <a href="{{ $register_url ?: '#' }}" class="nav-link-outline" target="_blank" rel="noopener">Daftar</a>
            <a href="{{ $login_url ?: '#' }}" class="nav-link-solid" target="_blank" rel="noopener">Login</a>
        </div>
    </nav>
    <div class="container">
        @if($image_url)
        <div class="img-wrap"><img src="{{ $image_url }}" alt=""></div>
        @endif
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
    @if(!empty($body_script)){!! $body_script !!}@endif
</body>
</html>
