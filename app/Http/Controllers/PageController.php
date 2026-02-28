<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HomePageService;
use App\Services\LandingPageBuilderService;
use App\Services\SeoContentService;
use App\Services\SiteService;
use App\Services\UrlCheckerService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        private HomePageService $homePageService,
        private SiteService $siteService,
        private UrlCheckerService $urlCheckerService,
        private SeoContentService $seoContentService
    ) {}

    public function about()
    {
        $data = $this->homePageService->getContent();
        $site = $this->siteService->getGlobal();

        return view(config('app.theme') . 'about', [
            'meta' => [
                'title' => $data['about']['title'] . ' | ' . $site['name'],
                'description' => strip_tags($data['about']['description']),
                'keywords' => 'tentang sekanca, profil perusahaan, digital agency',
                'canonical' => route('about'),
            ],
            'about' => $data['about'],
            'seoContent' => $this->seoContentService->getContent('about'),
        ]);
    }

    public function contact()
    {
        $site = $this->siteService->getGlobal();

        return view(config('app.theme') . 'contact', [
            'meta' => [
                'title' => 'Kontak | ' . $site['name'],
                'description' => 'Hubungi Sekanca Media Digital via WhatsApp untuk konsultasi dan informasi layanan digital.',
                'keywords' => 'kontak sekanca, hubungi kami, konsultasi digital',
                'canonical' => route('contact'),
            ],
            'seoContent' => $this->seoContentService->getContent('contact'),
        ]);
    }

    public function landingPageBuilder()
    {
        $site = $this->siteService->getGlobal();

        return view(config('app.theme') . 'landing-page-builder', [
            'meta' => [
                'title' => 'Landing Page Builder | ' . $site['name'],
                'description' => 'Alat untuk membuat landing page. Pilih template dan sesuaikan konten.',
                'keywords' => 'landing page builder, buat landing page',
                'canonical' => route('landing-page-builder'),
            ],
            'layouts' => LandingPageBuilderService::getLayouts(),
            'seoContent' => $this->seoContentService->getContent('landing-page-builder'),
        ]);
    }

    public function landingPageBuilderGenerate(Request $request)
    {
        $rules = [
            'layout' => 'required|integer|min:1|max:11',
            'primary_color' => ['required', 'string', 'regex:/^#?[0-9A-Fa-f]{6}$/'],
            'image_url' => 'nullable|url|max:500',
            'logo_url' => 'nullable|url|max:500',
            'background_color' => ['nullable', 'string', 'regex:/^#?[0-9A-Fa-f]{6}$/'],
            'head_script' => 'nullable|string|max:15000',
            'body_script' => 'nullable|string|max:15000',
            'headline' => 'nullable|string|max:200',
            'tagline' => 'nullable|string|max:500',
            'register_url' => 'nullable|string|max:500',
            'login_url' => 'nullable|string|max:500',
        ];
        for ($i = 1; $i <= 5; $i++) {
            $rules["button_{$i}_label"] = 'nullable|string|max:100';
            $rules["button_{$i}_url"] = 'nullable|string|max:500';
        }
        $request->validate($rules);

        $buttons = [];
        for ($i = 1; $i <= 5; $i++) {
            $label = $request->input("button_{$i}_label");
            $url = $request->input("button_{$i}_url");
            if ($label !== null && $label !== '') {
                $buttons[] = ['label' => $label, 'url' => $url && $url !== '' ? $url : '#'];
            }
        }

        $data = [
            'layout' => (int) $request->input('layout'),
            'primary_color' => '#' . ltrim($request->input('primary_color'), '#'),
            'image_url' => $request->input('image_url') ?: '',
            'logo_url' => $request->input('logo_url') ?: '',
            'background_color' => $request->input('background_color') ? ('#' . ltrim($request->input('background_color'), '#')) : '#f8f9fa',
            'buttons' => $buttons,
            'head_script' => $request->input('head_script') ?: '',
            'body_script' => $request->input('body_script') ?: '',
            'headline' => $request->input('headline') ?: 'Headline Anda',
            'tagline' => $request->input('tagline') ?: 'Tagline atau deskripsi singkat.',
            'register_url' => $request->input('register_url') ?: '',
            'login_url' => $request->input('login_url') ?: '',
        ];

        $html = app(LandingPageBuilderService::class)->generateHtml($data);

        return response()->json(['success' => true, 'html' => $html]);
    }

    /**
     * IP publik pengunjung (seperti ifconfig.me).
     * Pakai X-Forwarded-For / X-Real-IP bila ada proxy (Nginx, Cloudflare, dll).
     */
    private function getClientPublicIp(Request $request): ?string
    {
        $forwarded = $request->header('X-Forwarded-For');
        if ($forwarded) {
            $ips = array_map('trim', explode(',', $forwarded));

            return $ips[0] ?: null;
        }
        $realIp = $request->header('X-Real-IP');
        if ($realIp) {
            return trim($realIp);
        }

        return $request->ip();
    }

    /** Tab slug (URL) -> check key (internal). */
    private const URL_CHECKER_TABS = [
        'ip-info' => 'ip_info',
        'ping' => 'ping',
        'ping-global' => 'ping_global',
        'http' => 'http',
        'dns' => 'dns',
        'redirect' => 'redirect',
        'tcp-port' => 'tcp_port',
        'whois' => 'whois',
    ];

    public function urlChecker(Request $request)
    {
        $site = $this->siteService->getGlobal();

        return view(config('app.theme') . 'url-checker', [
            'meta' => [
                'title' => 'URL Checker | ' . $site['name'],
                'description' => 'Cek URL website gratis: HTTP, DNS, Redirect, WHOIS, Ping. Tools dari Sekanca Media Digital untuk developer dan SEO.',
                'keywords' => 'url checker, cek url, website checker, dns checker, whois, ping',
                'canonical' => route('url-checker'),
            ],
            'userIp' => $this->getClientPublicIp($request),
            'results' => null,
            'checkedUrl' => null,
            'activeTab' => null,
            'tabSlug' => null,
            'seoContent' => $this->seoContentService->getContent('url-checker'),
        ]);
    }

    public function urlCheckerTab(Request $request, string $tab)
    {
        $site = $this->siteService->getGlobal();
        $checkKey = self::URL_CHECKER_TABS[$tab] ?? null;
        if (! $checkKey) {
            abort(404);
        }

        $meta = $this->getUrlCheckerTabMeta($tab, $checkKey, $site['name']);

        return view(config('app.theme') . 'url-checker', [
            'meta' => $meta,
            'userIp' => $this->getClientPublicIp($request),
            'results' => null,
            'checkedUrl' => null,
            'activeTab' => $checkKey,
            'tabSlug' => $tab,
            'seoContent' => $this->seoContentService->getContent('url-checker', ['tab' => $tab]),
        ]);
    }

    private function getUrlCheckerTabMeta(string $tab, string $checkKey, string $siteName): array
    {
        $titles = [
            'ip-info' => 'Cek IP Address & IP Lookup Gratis',
            'ping' => 'Ping Domain / Cek Ping Online',
            'ping-global' => 'Ping Global dari Berbagai Negara',
            'http' => 'HTTP Checker & Cek Status Code',
            'dns' => 'DNS Lookup & Cek DNS Record',
            'redirect' => 'Redirect Checker & Cek Rantai Redirect',
            'tcp-port' => 'Cek TCP Port & Port Scanner',
            'whois' => 'WHOIS Lookup & Info Domain',
        ];
        $descriptions = [
            'ip-info' => 'Cek IP address, IP lookup, dan geolocation gratis. Lihat lokasi, ISP, timezone dari IP atau domain.',
            'ping' => 'Ping domain dan cek latency online. Tes koneksi ke server, response time, dan packet loss.',
            'ping-global' => 'Ping dari berbagai negara. Tes aksesibilitas website dari lokasi global dan bandingkan latency.',
            'http' => 'Cek HTTP status code, response header, dan response time. Deteksi website down atau redirect.',
            'dns' => 'DNS lookup gratis: cek A, AAAA, MX, NS, TXT, CNAME. Verifikasi DNS record domain Anda.',
            'redirect' => 'Cek redirect 301/302 dan rantai redirect. Lacak URL akhir dari short URL atau redirect chain.',
            'tcp-port' => 'Cek port terbuka dan TCP port scanner. Verifikasi port 80, 443, 22, dan port lain pada server.',
            'whois' => 'WHOIS lookup: cek informasi domain, tanggal expired, registrar, nameserver. Gratis dan cepat.',
        ];
        $keywords = [
            'ip-info' => 'cek IP, IP lookup, geolocation IP, informasi IP address',
            'ping' => 'ping domain, cek ping, ping online, latency, response time',
            'ping-global' => 'ping global, ping berbagai negara, worldwide ping test',
            'http' => 'HTTP checker, status code, cek website down, response header',
            'dns' => 'DNS lookup, cek DNS, A record, MX record, nameserver',
            'redirect' => 'redirect checker, 301 redirect, cek redirect, redirect chain',
            'tcp-port' => 'cek port, port scanner, TCP port, port terbuka',
            'whois' => 'whois domain, whois lookup, info domain, expiry domain',
        ];

        return [
            'title' => ($titles[$tab] ?? 'URL Check') . ' | ' . $siteName,
            'description' => $descriptions[$tab] ?? 'Tool gratis dari Sekanca Media Digital.',
            'keywords' => $keywords[$tab] ?? 'url checker',
            'canonical' => route('url-checker.tab', $tab),
        ];
    }

    public function urlCheckerCheck(Request $request)
    {
        $request->validate(['url' => 'required|string|max:2048']);

        $site = $this->siteService->getGlobal();
        $url = trim($request->input('url'));
        $results = $this->urlCheckerService->runAllChecks($url);

        return view(config('app.theme') . 'url-checker', [
            'meta' => [
                'title' => 'URL Checker | ' . $site['name'],
                'description' => 'Cek URL website gratis: HTTP, DNS, Redirect, WHOIS, Ping. Tools dari Sekanca Media Digital untuk developer dan SEO.',
                'keywords' => 'url checker, cek url, website checker, dns checker, whois, ping',
                'canonical' => route('url-checker'),
            ],
            'userIp' => $this->getClientPublicIp($request),
            'results' => $results,
            'checkedUrl' => $url,
            'activeTab' => $this->getActiveTabFromRequest($request),
            'tabSlug' => $request->input('tab'),
            'seoContent' => $this->seoContentService->getContent('url-checker'),
        ]);
    }

    private function getActiveTabFromRequest(Request $request): ?string
    {
        $tab = $request->input('tab');
        if ($tab && isset(self::URL_CHECKER_TABS[$tab])) {
            return self::URL_CHECKER_TABS[$tab];
        }
        return null;
    }

    /**
     * Run a single URL check (for async/parallel frontend). Returns JSON with rendered HTML for the tab.
     */
    public function urlCheckerRunCheck(Request $request)
    {
        $request->validate([
            'url' => 'required|string|max:2048',
            'check' => 'required|string|in:ip_info,ping,ping_global,http,dns,redirect,tcp_port,whois',
        ]);

        $url = trim($request->input('url'));
        $check = $request->input('check');
        $out = $this->urlCheckerService->runSingleCheck($url, $check);

        if (! $out['success']) {
            return response()->json(['check' => $check, 'html' => '<div class="alert alert-danger">' . e($out['result']['error'] ?? 'Invalid check') . '</div>'], 400);
        }

        $html = view('partials.url-checker.' . str_replace('_', '-', $check), ['result' => $out['result']])->render();

        return response()->json(['check' => $check, 'html' => $html]);
    }
}
