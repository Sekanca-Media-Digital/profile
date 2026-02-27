@php $seoContent = $seoContent ?? []; $blocks = $seoContent['blocks'] ?? []; @endphp
@if(!empty($blocks))
<section class="seo-content py-5 bg-light" aria-label="Konten tambahan">
    <div class="container">
        <div class="row justify-content-center">
            <article class="col-lg-8">
                @foreach($blocks as $block)
                    @if($block['type'] === 'h2')
                        <h2 class="h5 mb-3">{{ $block['content'] }}</h2>
                    @elseif($block['type'] === 'h3')
                        <h3 class="h6 mb-2">{{ $block['content'] }}</h3>
                    @elseif($block['type'] === 'p')
                        <p class="mb-3">{!! $block['content'] !!}</p>
                    @endif
                @endforeach
            </article>
        </div>
    </div>
</section>
@endif
