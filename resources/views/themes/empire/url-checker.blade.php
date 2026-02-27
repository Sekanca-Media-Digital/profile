@extends('themes.empire.layout')

@section('content')
<section class="url-checker-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="service-box p-4">
                    <h1 class="h4 mb-3">URL Checker</h1>
                    @if(isset($networkIp))
                        <p class="small text-muted mb-3">IP Network: <code>{{ $networkIp }}</code></p>
                    @endif
                    <form id="urlCheckerForm" action="{{ route('url-checker.check') }}" method="POST" class="mb-4 url-checker-form-inline">
                        @csrf
                        @if(!empty($tabSlug))<input type="hidden" name="tab" value="{{ $tabSlug }}">@endif
                        <div class="mb-3 d-flex flex-nowrap gap-2 align-items-center">
                            <label for="url" class="form-label mb-0 text-nowrap">URL / Domain:</label>
                            <input type="text" class="form-control form-control-lg flex-grow-1 @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $checkedUrl ?? '') }}" placeholder="https://example.com atau example.com" required>
                            <button type="submit" class="btn btn-warning rounded-pill px-4 flex-shrink-0" id="urlCheckSubmitBtn">Cek URL</button>
                        </div>
                        @error('url')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </form>

                    <div id="urlCheckResults" class="{{ ($results ?? null) ? '' : 'd-none' }}">
                        <h2 class="h5 mb-3">Hasil Pengecekan: <span id="urlCheckResultUrl">{{ $checkedUrl ?? '' }}</span></h2>
                            @include('partials.url-checker-tabs', ['activeTab' => $activeTab ?? 'ip_info', 'results' => $results ?? []])
                    </div>

                    @include('partials.url-checker-form-script')
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
