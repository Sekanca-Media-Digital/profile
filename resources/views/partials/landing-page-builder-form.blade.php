@php
    $layouts = $layouts ?? \App\Services\LandingPageBuilderService::getLayouts();
    $colorPresets = [
        '0d6efd' => 'Biru', 'dc3545' => 'Merah', '198754' => 'Hijau', '6f42c1' => 'Ungu',
        'fd7e14' => 'Orange', '20c997' => 'Teal', '212529' => 'Gelap', 'f8f9fa' => 'Abu terang',
    ];
@endphp
<input type="hidden" id="lpb-csrf" value="{{ csrf_token() }}">
<div class="row g-4">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h2 class="h5 mb-3">Pilih Layout</h2>
                <select class="form-select mb-4" id="lpbLayout" name="layout">
                    @foreach($layouts as $num => $info)
                        <option value="{{ $num }}">{{ $info['name'] }}</option>
                    @endforeach
                </select>

                <h2 class="h6 mb-2">Konten</h2>
                <div class="mb-3">
                    <label class="form-label small">Headline</label>
                    <input type="text" class="form-control form-control-sm" id="lpbHeadline" name="headline" placeholder="Headline Anda" maxlength="200">
                </div>
                <div class="mb-3">
                    <label class="form-label small">Tagline / Deskripsi</label>
                    <textarea class="form-control form-control-sm" id="lpbTagline" name="tagline" rows="2" placeholder="Tagline atau deskripsi singkat" maxlength="500"></textarea>
                </div>

                <h2 class="h6 mb-2 mt-4">Navbar</h2>
                <div class="mb-2">
                    <label class="form-label small">URL gambar logo (navbar)</label>
                    <input type="url" class="form-control form-control-sm" name="logo_url" placeholder="https://... (kosongkan = pakai judul teks)">
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small">URL Daftar</label>
                        <input type="text" class="form-control form-control-sm" name="register_url" placeholder="/daftar atau https://...">
                    </div>
                    <div class="col-6">
                        <label class="form-label small">URL Login</label>
                        <input type="text" class="form-control form-control-sm" name="login_url" placeholder="/login atau https://...">
                    </div>
                </div>

                <h2 class="h6 mb-2 mt-4">Tombol (maks. 5)</h2>
                @for($i = 1; $i <= 5; $i++)
                <div class="row g-1 mb-2">
                    <div class="col-5"><input type="text" class="form-control form-control-sm" name="button_{{ $i }}_label" placeholder="Teks tombol {{ $i }}"></div>
                    <div class="col-7"><input type="url" class="form-control form-control-sm" name="button_{{ $i }}_url" placeholder="URL"></div>
                </div>
                @endfor

                <h2 class="h6 mb-2 mt-4">Warna</h2>
                <div class="mb-2">
                    <label class="form-label small">Warna utama (tombol, aksen)</label>
                    <div class="d-flex flex-wrap gap-1 mb-1">
                        @foreach($colorPresets as $hex => $nama)
                            <button type="button" class="lpb-color border rounded-circle p-0" data-hex="{{ $hex }}" style="width:1.5rem;height:1.5rem;background:#{{ $hex }};" title="{{ $nama }}"></button>
                        @endforeach
                    </div>
                    <input type="text" class="form-control form-control-sm" id="lpbPrimaryColor" name="primary_color" value="0d6efd" maxlength="7" placeholder="hex">
                </div>
                <div class="mb-3">
                    <label class="form-label small">Warna background halaman</label>
                    <div class="d-flex flex-wrap gap-1 mb-1">
                        @foreach($colorPresets as $hex => $nama)
                            <button type="button" class="lpb-bg-color border rounded-circle p-0" data-hex="{{ $hex }}" style="width:1.5rem;height:1.5rem;background:#{{ $hex }};" title="{{ $nama }}"></button>
                        @endforeach
                    </div>
                    <input type="text" class="form-control form-control-sm" id="lpbBgColor" name="background_color" value="f8f9fa" maxlength="7" placeholder="hex">
                </div>

                <h2 class="h6 mb-2 mt-4">Gambar</h2>
                <div class="mb-3">
                    <label class="form-label small">URL gambar (hero / utama)</label>
                    <input type="url" class="form-control form-control-sm" name="image_url" placeholder="https://...">
                </div>

                <h2 class="h6 mb-2 mt-4">Custom script</h2>
                <div class="mb-2">
                    <label class="form-label small">Script dalam &lt;head&gt;</label>
                    <textarea class="form-control form-control-sm font-monospace" name="head_script" rows="3" placeholder="Contoh: &lt;script&gt;...&lt;/script&gt; atau &lt;link&gt; CSS"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small">Script sebelum &lt;/body&gt;</label>
                    <textarea class="form-control form-control-sm font-monospace" name="body_script" rows="3" placeholder="Contoh: &lt;script&gt;...&lt;/script&gt;"></textarea>
                </div>

                <button type="button" class="btn btn-primary w-100" id="lpbGenerate">Generate & Preview</button>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="alert alert-danger d-none" id="lpbError"></div>
        <div class="card border-0 shadow-sm d-none" id="lpbResultCard">
            <div class="card-header bg-success text-white py-2 d-flex justify-content-between align-items-center">
                <span class="small">Preview</span>
                <div>
                    <button type="button" class="btn btn-sm btn-light" id="lpbCopy">Salin HTML</button>
                    <a href="#" class="btn btn-sm btn-light d-none" id="lpbDownload">Download HTML</a>
                </div>
            </div>
            <div class="card-body p-0 position-relative">
                <div class="border rounded m-2 bg-white position-relative" style="height: 520px;">
                    <div id="lpbPreviewLoading" class="position-absolute top-0 start-0 end-0 bottom-0 d-none align-items-center justify-content-center bg-white bg-opacity-75 rounded" style="z-index:2;">
                        <span class="spinner-border spinner-border-sm text-secondary me-2"></span>
                        <span class="small text-muted">Memperbarui...</span>
                    </div>
                    <iframe id="lpbFrame" title="Preview" style="width:100%;height:100%;border:0;"></iframe>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm" id="lpbPlaceholder">
            <div class="card-body text-center py-5 text-muted">
                <p class="mb-0">Ubah form di kiri — preview akan diperbarui otomatis. Hasil HTML bisa disalin atau diunduh.</p>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var csrf = document.getElementById('lpb-csrf') && document.getElementById('lpb-csrf').value;
    var form = document.querySelector('.col-lg-5 .card-body');
    var lastHtml = '';
    var debounceTimer = null;
    var DEBOUNCE_MS = 450;

    function buildFormData() {
        var fd = new FormData();
        fd.append('_token', csrf);
        fd.append('layout', document.getElementById('lpbLayout').value);
        fd.append('primary_color', (document.getElementById('lpbPrimaryColor').value || '0d6efd').replace(/^#/, ''));
        fd.append('background_color', (document.getElementById('lpbBgColor').value || 'f8f9fa').replace(/^#/, ''));
        fd.append('image_url', form.querySelector('input[name="image_url"]').value);
        fd.append('logo_url', form.querySelector('input[name="logo_url"]').value);
        fd.append('head_script', form.querySelector('textarea[name="head_script"]').value);
        fd.append('body_script', form.querySelector('textarea[name="body_script"]').value);
        fd.append('headline', document.getElementById('lpbHeadline').value);
        fd.append('tagline', document.getElementById('lpbTagline').value);
        fd.append('register_url', form.querySelector('input[name="register_url"]').value);
        fd.append('login_url', form.querySelector('input[name="login_url"]').value);
        for (var i = 1; i <= 5; i++) {
            fd.append('button_' + i + '_label', form.querySelector('input[name="button_' + i + '_label"]').value);
            fd.append('button_' + i + '_url', form.querySelector('input[name="button_' + i + '_url"]').value);
        }
        return fd;
    }

    function applyResult(data) {
        if (data.success && data.html) {
            lastHtml = data.html;
            document.getElementById('lpbFrame').srcdoc = data.html;
            document.getElementById('lpbResultCard').classList.remove('d-none');
            document.getElementById('lpbPlaceholder').classList.add('d-none');
            var dl = document.getElementById('lpbDownload');
            dl.href = URL.createObjectURL(new Blob([data.html], { type: 'text/html' }));
            dl.download = 'landing-page.html';
            dl.classList.remove('d-none');
        } else {
            document.getElementById('lpbError').textContent = data.message || 'Terjadi kesalahan.';
            document.getElementById('lpbError').classList.remove('d-none');
        }
    }

    function doGenerate(showButtonLoading) {
        document.getElementById('lpbError').classList.add('d-none');
        var btn = document.getElementById('lpbGenerate');
        var loadingEl = document.getElementById('lpbPreviewLoading');
        if (showButtonLoading) {
            btn.disabled = true;
            btn.textContent = 'Memproses...';
        } else if (document.getElementById('lpbResultCard').classList.contains('d-none') === false) {
            loadingEl.classList.remove('d-none');
            loadingEl.classList.add('d-flex');
        }

        fetch('{{ route("landing-page-builder.generate") }}', {
            method: 'POST',
            body: buildFormData(),
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            btn.textContent = 'Generate & Preview';
            loadingEl.classList.add('d-none');
            loadingEl.classList.remove('d-flex');
            applyResult(data);
            if (showButtonLoading) document.getElementById('lpbResultCard').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        })
        .catch(function() {
            btn.disabled = false;
            btn.textContent = 'Generate & Preview';
            loadingEl.classList.add('d-none');
            loadingEl.classList.remove('d-flex');
            document.getElementById('lpbError').textContent = 'Gagal memproses.';
            document.getElementById('lpbError').classList.remove('d-none');
        });
    }

    function schedulePreview() {
        if (debounceTimer) clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() { doGenerate(false); }, DEBOUNCE_MS);
    }

    document.querySelectorAll('.lpb-color').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var h = this.getAttribute('data-hex').replace(/^#/, '');
            document.getElementById('lpbPrimaryColor').value = h;
            schedulePreview();
        });
    });

    document.querySelectorAll('.lpb-bg-color').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var h = this.getAttribute('data-hex').replace(/^#/, '');
            document.getElementById('lpbBgColor').value = h;
            schedulePreview();
        });
    });

    var inputs = [
        'lpbLayout', 'lpbHeadline', 'lpbTagline', 'lpbPrimaryColor', 'lpbBgColor',
        'image_url', 'logo_url', 'head_script', 'body_script',
        'register_url', 'login_url'
    ];
    inputs.forEach(function(idOrName) {
        var el = document.getElementById(idOrName) || form.querySelector('[name="' + idOrName + '"]');
        if (el) {
            el.addEventListener('input', schedulePreview);
            if (el.tagName !== 'TEXTAREA') el.addEventListener('change', schedulePreview);
        }
    });
    for (var i = 1; i <= 5; i++) {
        ['button_' + i + '_label', 'button_' + i + '_url'].forEach(function(name) {
            var el = form.querySelector('[name="' + name + '"]');
            if (el) {
                el.addEventListener('input', schedulePreview);
                el.addEventListener('change', schedulePreview);
            }
        });
    }

    document.getElementById('lpbGenerate').addEventListener('click', function() {
        if (debounceTimer) clearTimeout(debounceTimer);
        debounceTimer = null;
        doGenerate(true);
    });

    document.getElementById('lpbCopy').addEventListener('click', function() {
        if (!lastHtml) return;
        var copyBtn = this;
        navigator.clipboard.writeText(lastHtml).then(function() {
            var o = copyBtn.textContent;
            copyBtn.textContent = 'Tersalin!';
            setTimeout(function() { copyBtn.textContent = o; }, 2000);
        });
    });
})();
</script>
