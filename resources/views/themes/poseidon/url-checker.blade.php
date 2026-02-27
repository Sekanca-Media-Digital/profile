@extends('themes.poseidon.layout')

@section('content')
<section class="poseidon-services py-5 url-checker-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="poseidon-service-card card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h1 class="h4 mb-3 poseidon-accent">URL Checker</h1>
                        @if(isset($networkIp))
                            <p class="small text-muted mb-3">IP Network: <code>{{ $networkIp }}</code></p>
                        @endif
                        <form id="urlCheckerForm" action="{{ route('url-checker.check') }}" method="POST" class="mb-4">
                            @csrf
                            @if(!empty($tabSlug))<input type="hidden" name="tab" value="{{ $tabSlug }}">@endif
                            <div class="mb-3">
                                <label for="url" class="form-label">Masukkan URL atau Domain</label>
                                <input type="text" class="form-control form-control-lg @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $checkedUrl ?? '') }}" placeholder="https://example.com atau example.com" required>
                                @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-cta-poseidon rounded-pill px-4" id="urlCheckSubmitBtn">Cek URL</button>
                        </form>

                        <div id="urlCheckResults" class="{{ ($results ?? null) ? '' : 'd-none' }}">
                            <h2 class="h5 mb-3 poseidon-accent">Hasil Pengecekan: <span id="urlCheckResultUrl">{{ $checkedUrl ?? '' }}</span></h2>
                            @include('partials.url-checker-tabs', ['activeTab' => $activeTab ?? 'ip_info', 'results' => $results ?? []])
                        </div>

                        @include('partials.url-checker-form-script')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.seo-content', ['seoContent' => $seoContent ?? []])
@endsection
