<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo_title }}</title>
    @if(!empty($head_script)){!! $head_script !!}@endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; line-height: 1.6; color: #333; }
        .split { min-height: 70vh; display: grid; grid-template-columns: 1fr 1fr; }
        @media (max-width: 640px) { .split { grid-template-columns: 1fr; } }
        .split-left { background: {{ $background_color }}; @if($image_url) background-image: url('{{ $image_url }}'); background-size: cover; background-position: center; @else background: linear-gradient(135deg, {{ $primary_color }}44, {{ $primary_color }}22); @endif }
        .split-right { padding: 3rem 2rem; display: flex; flex-direction: column; justify-content: center; background: #fff; }
        .split-right h1 { font-size: 1.75rem; margin-bottom: 0.75rem; }
        .split-right .tagline { color: #666; margin-bottom: 1.5rem; }
        .btns a { display: inline-block; padding: 0.75rem 1.5rem; background: {{ $primary_color }}; color: #fff; text-decoration: none; border-radius: 6px; margin-right: 0.5rem; margin-bottom: 0.5rem; }
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
    <div class="split">
        <div class="split-left"></div>
        <div class="split-right">
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
