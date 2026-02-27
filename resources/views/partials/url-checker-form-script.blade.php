<style>
.url-checker-section #urlCheckTabs .nav-link.url-check-done { border-bottom-color: var(--bs-success); border-bottom-width: 2px; }
</style>
<script>
(function() {
    var form = document.getElementById('urlCheckerForm');
    if (!form) return;
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        var url = document.getElementById('url').value.trim();
        if (!url) return;
        var btn = document.getElementById('urlCheckSubmitBtn');
        var resultsEl = document.getElementById('urlCheckResults');
        document.getElementById('urlCheckResultUrl').textContent = url;
        resultsEl.classList.remove('d-none');
        resultsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        var panes = { ip_info: 'ipinfo-pane', ping: 'ping-pane', ping_global: 'ping-global-pane', http: 'http-pane', dns: 'dns-pane', redirect: 'redirect-pane', tcp_port: 'tcpport-pane', whois: 'whois-pane' };
        var checks = Object.keys(panes);
        var loadingHtml = '<div class="url-check-loading text-muted small">Memeriksa...</div>';
        var spinnerHtml = '<span class="spinner-border spinner-border-sm ms-1 url-check-tab-spinner" role="status" aria-hidden="true"></span>';
        var checkmarkHtml = '<span class="url-check-tab-check text-success ms-1" aria-hidden="true">✓</span>';

        function getTabId(check) { return panes[check].replace('-pane', '-tab'); }
        function setTabDone(check) {
            var tabBtn = document.getElementById(getTabId(check));
            if (!tabBtn) return;
            var sp = tabBtn.querySelector('.url-check-tab-spinner');
            if (sp) sp.remove();
            tabBtn.classList.add('url-check-done');
            tabBtn.classList.remove('url-check-loading');
            if (!tabBtn.querySelector('.url-check-tab-check')) tabBtn.insertAdjacentHTML('beforeend', checkmarkHtml);
        }

        checks.forEach(function(c) {
            document.getElementById(panes[c]).innerHTML = loadingHtml;
            var tabBtn = document.getElementById(getTabId(c));
            if (tabBtn) {
                tabBtn.classList.add('url-check-loading');
                tabBtn.classList.remove('url-check-done');
                var oldCheck = tabBtn.querySelector('.url-check-tab-check');
                if (oldCheck) oldCheck.remove();
                if (!tabBtn.querySelector('.url-check-tab-spinner')) tabBtn.insertAdjacentHTML('beforeend', spinnerHtml);
            }
        });
        btn.disabled = true;

        var base = '{{ route("url-checker.run-check") }}';
        await Promise.all(checks.map(function(check) {
            return fetch(base + '?url=' + encodeURIComponent(url) + '&check=' + encodeURIComponent(check))
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    document.getElementById(panes[data.check]).innerHTML = data.html || '<div class="alert alert-danger">Gagal memuat hasil.</div>';
                    setTabDone(data.check);
                })
                .catch(function() {
                    document.getElementById(panes[check]).innerHTML = '<div class="alert alert-danger">Gagal memuat hasil.</div>';
                    setTabDone(check);
                });
        }));
        btn.disabled = false;
    });
})();
</script>
