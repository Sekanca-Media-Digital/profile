<?php

namespace App\Services;

class SeoContentService
{
    /**
     * Get SEO content for a page.
     * TODO: Fetch from database when ready.
     *
     * @param  string  $page  Page identifier: home, about, service, service-detail, contact, url-checker
     * @param  array  $context  Context data (e.g. ['service' => $service] for service-detail)
     * @return array  ['blocks' => [['type' => 'h2'|'h3'|'p', 'content' => '...'], ...]]
     */
    public function getContent(string $page, array $context = []): array
    {
        $blocks = $this->getBlocks($page, $context);

        return [
            'blocks' => $this->resolvePlaceholders($blocks, $context),
        ];
    }

    /**
     * Get raw content blocks. Override/replace with DB fetch when ready.
     */
    protected function getBlocks(string $page, array $context): array
    {
        return match ($page) {
            'home' => $this->getHomeBlocks(),
            'about' => $this->getAboutBlocks(),
            'service' => $this->getServiceListBlocks(),
            'service-detail' => $this->getServiceDetailBlocks($context),
            'contact' => $this->getContactBlocks(),
            'landing-page-builder' => $this->getLandingPageBuilderBlocks(),
            'url-checker' => isset($context['tab']) ? $this->getUrlCheckerTabBlocks($context['tab']) : $this->getUrlCheckerBlocks(),
            default => [],
        };
    }

    protected function getHomeBlocks(): array
    {
        return [
            ['type' => 'h2', 'content' => 'Digital Agency Indonesia — Solusi Digital untuk Bisnis Anda'],
            ['type' => 'p', 'content' => 'Sekanca Media Digital adalah digital agency di Indonesia yang menyediakan layanan <a href="{route:service.index}">pemasaran digital</a>, pengembangan website, dan branding. Kami membantu UMKM hingga perusahaan besar mencapai tujuan bisnis melalui strategi digital yang terukur dan berorientasi hasil.'],
            ['type' => 'h3', 'content' => 'Mengapa Memilih Sekanca Media Digital?'],
            ['type' => 'p', 'content' => 'Dengan pengalaman di industri digital marketing dan web development, tim kami menggabungkan kreativitas dengan data untuk menciptakan solusi yang efektif. Layanan kami meliputi Security as a Service (SECaaS), Digital Marketing, dan Social Media Marketing — semua dirancang untuk meningkatkan visibilitas dan pertumbuhan bisnis Anda secara online.'],
            ['type' => 'h3', 'content' => 'Mulai Transformasi Digital Bisnis Anda'],
            ['type' => 'p', 'content' => 'Konsultasi gratis tersedia untuk membahas kebutuhan bisnis Anda. <a href="{route:contact}">Hubungi kami</a> via WhatsApp atau kunjungi halaman <a href="{route:about}">Tentang Kami</a> untuk mengenal Sekanca Media Digital lebih dekat.'],
        ];
    }

    protected function getAboutBlocks(): array
    {
        return [
            ['type' => 'h2', 'content' => 'Tentang Sekanca Media Digital — Mitra Transformasi Digital Anda'],
            ['type' => 'p', 'content' => 'Sekanca Media Digital adalah agensi kreatif yang fokus pada pengembangan website, branding, dan digital marketing. Berbasis di Indonesia, kami melayani klien dari berbagai sektor industri dengan pendekatan modern dan strategis.'],
            ['type' => 'h3', 'content' => 'Visi dan Misi Kami'],
            ['type' => 'p', 'content' => 'Kami percaya bahwa setiap bisnis layak memiliki kehadiran digital yang kuat. Melalui layanan <a href="{route:service.index}">Security as a Service</a>, Digital Marketing, dan Social Media Marketing, kami mendampingi bisnis dalam menghadapi tantangan era digital dan memanfaatkan peluang pertumbuhan online.'],
            ['type' => 'h3', 'content' => 'Kolaborasi untuk Hasil Terbaik'],
            ['type' => 'p', 'content' => 'Tim Sekanca terdiri dari profesional berpengalaman di bidang web development, design, dan marketing. Ingin mengetahui lebih lanjut tentang <a href="{route:service.show:digital-marketing}">layanan digital marketing</a> atau <a href="{route:contact}">berdiskusi</a> tentang proyek Anda? Silakan hubungi kami.'],
        ];
    }

    protected function getServiceListBlocks(): array
    {
        return [
            ['type' => 'h2', 'content' => 'Layanan Digital Profesional — Security, Marketing & Branding'],
            ['type' => 'p', 'content' => 'Sekanca Media Digital menyediakan beragam layanan digital untuk mendukung pertumbuhan bisnis Anda. Dari keamanan berbasis cloud hingga strategi pemasaran digital, kami menawarkan solusi terintegrasi yang dapat disesuaikan dengan kebutuhan spesifik bisnis Anda.'],
            ['type' => 'h3', 'content' => 'Security as a Service (SECaaS)'],
            ['type' => 'p', 'content' => 'Solusi keamanan cloud untuk melindungi sistem, jaringan, dan data perusahaan tanpa investasi infrastruktur besar. Ideal untuk bisnis yang ingin meningkatkan keamanan IT dengan biaya terjangkau.'],
            ['type' => 'h3', 'content' => 'Digital Marketing & Social Media Marketing'],
            ['type' => 'p', 'content' => 'Strategi pemasaran berbasis data untuk menjangkau audiens yang tepat. Kami membantu membangun brand awareness, meningkatkan engagement, dan mendorong konversi melalui kanal digital dan media sosial.'],
            ['type' => 'p', 'content' => 'Pelajari lebih detail setiap layanan kami atau <a href="{route:contact}">konsultasikan kebutuhan</a> bisnis Anda dengan tim Sekanca.'],
        ];
    }

    protected function getServiceDetailBlocks(array $context): array
    {
        $service = $context['service'] ?? [];
        $title = $service['title'] ?? 'Layanan';

        return [
            ['type' => 'h2', 'content' => $title . ' — Layanan Profesional dari Sekanca Media Digital'],
            ['type' => 'p', 'content' => $title . ' adalah salah satu layanan unggulan Sekanca Media Digital yang dirancang untuk memenuhi kebutuhan bisnis modern. Kami menyediakan solusi terpadu dengan pendekatan yang berorientasi pada hasil.'],
            ['type' => 'h3', 'content' => 'Dapatkan Solusi Digital Terbaik'],
            ['type' => 'p', 'content' => 'Sebagai <a href="{route:about}">digital agency</a> berpengalaman, Sekanca menggabungkan keahlian teknis dengan pemahaman mendalam tentang pasar. Selain ' . strtolower($title) . ', kami juga menyediakan <a href="{route:service.index}">layanan digital lainnya</a> yang dapat mendukung transformasi bisnis Anda secara menyeluruh.'],
            ['type' => 'p', 'content' => 'Untuk konsultasi atau informasi lebih lanjut, <a href="{route:contact}">hubungi tim Sekanca Media Digital</a> via WhatsApp. Kami siap membantu Anda mencapai tujuan bisnis.'],
        ];
    }

    protected function getContactBlocks(): array
    {
        return [
            ['type' => 'h2', 'content' => 'Hubungi Sekanca Media Digital — Konsultasi Gratis'],
            ['type' => 'p', 'content' => 'Sekanca Media Digital menerima pertanyaan, konsultasi, dan penawaran kerja sama melalui WhatsApp. Tim kami siap menjawab kebutuhan Anda terkait layanan digital marketing, web development, dan branding.'],
            ['type' => 'h3', 'content' => 'Cara Menghubungi Kami'],
            ['type' => 'p', 'content' => 'Gunakan tombol Chat via WhatsApp di atas untuk terhubung langsung dengan tim kami. Kami merespons dalam waktu singkat pada jam kerja. Anda juga dapat mengunjungi halaman <a href="{route:service.index}">Layanan</a> untuk melihat portofolio layanan kami atau membaca lebih lanjut <a href="{route:about}">tentang Sekanca Media Digital</a>.'],
            ['type' => 'h3', 'content' => 'Layanan yang Tersedia'],
            ['type' => 'p', 'content' => 'Konsultasi gratis tersedia untuk Security as a Service, Digital Marketing, Social Media Marketing, dan kebutuhan digital lainnya. <a href="{route:home}">Kembali ke beranda</a> untuk informasi lengkap tentang Sekanca Media Digital.'],
        ];
    }

    protected function getLandingPageBuilderBlocks(): array
    {
        return [
            ['type' => 'h2', 'content' => 'Landing Page Builder — Buat Halaman Landing dengan Mudah'],
            ['type' => 'p', 'content' => 'Gunakan alat ini untuk membuat landing page sesuai kebutuhan campaign atau produk Anda. Pilih template dan sesuaikan konten.'],
            ['type' => 'p', 'content' => 'Lihat juga <a href="{route:url-checker}">URL Checker</a> dan <a href="{route:contact}">hubungi kami</a> untuk layanan custom.'],
        ];
    }

    protected function getUrlCheckerBlocks(): array
    {
        return [
            ['type' => 'h2', 'content' => 'URL Checker Gratis — Cek HTTP, DNS, Redirect & WHOIS'],
            ['type' => 'p', 'content' => 'URL Checker dari Sekanca Media Digital adalah tools gratis untuk memeriksa status website Anda. Cek HTTP response, DNS records, redirect chain, dan informasi WHOIS domain dalam satu tempat. Berguna untuk developer, SEO specialist, dan pemilik website yang ingin memastikan konfigurasi domain dan server berjalan dengan benar.'],
            ['type' => 'h3', 'content' => 'Fitur URL Checker'],
            ['type' => 'p', 'content' => 'HTTP Checker menampilkan status code, response time, dan headers. DNS Checker menampilkan record A, AAAA, MX, NS, TXT, dan CNAME. Redirect Checker memetakan rantai redirect dari URL awal hingga final destination. WHOIS menampilkan informasi registrasi domain. Tools ini membantu diagnosis masalah website dan verifikasi konfigurasi.'],
            ['type' => 'h3', 'content' => 'Tools Digital Lainnya'],
            ['type' => 'p', 'content' => 'Sekanca Media Digital menyediakan berbagai <a href="{route:service.index}">layanan digital</a> termasuk web development dan digital marketing. <a href="{route:contact}">Hubungi kami</a> untuk konsultasi bisnis atau kunjungi <a href="{route:home}">beranda</a> untuk informasi lengkap.'],
        ];
    }

    /**
     * SEO content per URL checker tab — keyword umum yang sering dicari user.
     */
    protected function getUrlCheckerTabBlocks(string $tab): array
    {
        $blocks = match ($tab) {
            'ip-info' => [
                ['type' => 'h2', 'content' => 'Cek IP Address & IP Lookup Gratis — Geolocation & Info IP'],
                ['type' => 'p', 'content' => 'Tool <strong>cek IP address</strong> dan <strong>IP lookup</strong> gratis untuk melihat informasi IP dari domain atau alamat IP. Menampilkan geolocation (negara, kota, region), ISP, timezone, dan organisasi. Berguna untuk verifikasi server, deteksi lokasi visitor, atau troubleshooting jaringan.'],
                ['type' => 'h3', 'content' => 'Kapan Perlu Cek IP?'],
                ['type' => 'p', 'content' => 'Gunakan <strong>IP lookup</strong> saat Anda perlu mengecek IP domain, memverifikasi hosting, atau menganalisis dari mana lalu lintas website berasal. Hasil <strong>cek IP</strong> juga membantu memastikan DNS domain mengarah ke server yang benar.'],
                ['type' => 'p', 'content' => 'Selain IP Info, gunakan juga <a href="{route:url-checker.tab:dns}">DNS lookup</a>, <a href="{route:url-checker.tab:whois}">WHOIS lookup</a>, dan <a href="{route:url-checker}">semua tool URL checker</a> lainnya. <a href="{route:contact}">Hubungi kami</a> untuk layanan digital.'],
            ],
            'ping' => [
                ['type' => 'h2', 'content' => 'Ping Domain & Cek Ping Online — Tes Latency & Koneksi'],
                ['type' => 'p', 'content' => 'Tool <strong>ping domain</strong> dan <strong>cek ping online</strong> gratis untuk mengukur latency dan response time ke server. Ping membantu memastikan server merespons, mendeteksi packet loss, dan menguji koneksi dari lokasi Anda ke host.'],
                ['type' => 'h3', 'content' => 'Fungsi Ping untuk Website'],
                ['type' => 'p', 'content' => 'Ping sering digunakan untuk: tes apakah website atau server online, cek kecepatan respon (response time dalam ms), dan diagnosis masalah koneksi. <strong>Ping online</strong> dari browser memudahkan tanpa perlu command line.'],
                ['type' => 'p', 'content' => 'Butuh tes dari berbagai lokasi? Gunakan <a href="{route:url-checker.tab:ping-global}">ping global</a>. Untuk cek HTTP dan DNS, lihat <a href="{route:url-checker.tab:http}">HTTP checker</a> dan <a href="{route:url-checker.tab:dns}">DNS lookup</a>. <a href="{route:home}">Sekanca Media Digital</a> — layanan digital & web development.'],
            ],
            'ping-global' => [
                ['type' => 'h2', 'content' => 'Ping Global dari Berbagai Negara — Worldwide Ping Test'],
                ['type' => 'p', 'content' => 'Tool <strong>ping global</strong> untuk mengetes aksesibilitas website dari berbagai negara dan kota. Lihat status ping (OK, timeout) dan latency dari beberapa lokasi dunia. Berguna untuk memastikan situs dapat diakses dari luar Indonesia dan membandingkan response time global.'],
                ['type' => 'h3', 'content' => 'Mengapa Ping dari Berbagai Negara?'],
                ['type' => 'p', 'content' => 'Website yang cepat di Indonesia belum tentu cepat di Amerika atau Eropa. <strong>Worldwide ping test</strong> membantu developer dan DevOps memantau performa global dan memilih CDN atau server terdekat dengan pengguna.'],
                ['type' => 'p', 'content' => 'Kombinasikan dengan <a href="{route:url-checker.tab:ping}">ping biasa</a>, <a href="{route:url-checker.tab:http}">HTTP checker</a>, dan <a href="{route:url-checker}">URL checker</a> lengkap. <a href="{route:contact}">Konsultasi</a> kebutuhan digital dengan Sekanca.'],
            ],
            'http' => [
                ['type' => 'h2', 'content' => 'HTTP Checker & Cek Status Code — Response Header & Down Detector'],
                ['type' => 'p', 'content' => 'Tool <strong>cek HTTP</strong> dan <strong>HTTP status code checker</strong> gratis. Lihat status code (200, 301, 404, 500), response time, response header, dan content length. Berguna untuk memastikan website tidak down, redirect benar, dan server merespons dengan benar.'],
                ['type' => 'h3', 'content' => 'Status Code yang Umum'],
                ['type' => 'p', 'content' => '200 = OK, 301/302 = redirect, 404 = not found, 500 = server error. <strong>Cek website down</strong> atau lambat dengan melihat response time. Header HTTP memberi informasi cache, server, dan encoding.'],
                ['type' => 'p', 'content' => 'Lengkapi dengan <a href="{route:url-checker.tab:redirect}">redirect checker</a>, <a href="{route:url-checker.tab:dns}">DNS lookup</a>, dan <a href="{route:url-checker}">tool URL checker</a> lain. <a href="{route:service.index}">Layanan Sekanca</a> — digital marketing & web development.'],
            ],
            'dns' => [
                ['type' => 'h2', 'content' => 'DNS Lookup & Cek DNS Record — A, MX, NS, TXT, CNAME'],
                ['type' => 'p', 'content' => 'Tool <strong>DNS lookup</strong> dan <strong>cek DNS</strong> gratis untuk melihat record A, AAAA, MX, NS, TXT, CNAME domain. Verifikasi konfigurasi DNS, cek nameserver, dan pastikan email (MX) mengarah benar. Sangat berguna untuk developer dan admin domain.'],
                ['type' => 'h3', 'content' => 'Jenis Record DNS'],
                ['type' => 'p', 'content' => '<strong>A record</strong> dan <strong>AAAA</strong> untuk IP domain; <strong>MX record</strong> untuk mail server; <strong>NS</strong> untuk nameserver; <strong>TXT</strong> untuk verifikasi (SPF, DKIM, domain ownership); <strong>CNAME</strong> untuk alias. <strong>Cek DNS</strong> membantu saat migrasi atau troubleshooting.'],
                ['type' => 'p', 'content' => 'Gunakan juga <a href="{route:url-checker.tab:whois}">WHOIS</a>, <a href="{route:url-checker.tab:http}">HTTP checker</a>, dan <a href="{route:url-checker}">semua fitur URL checker</a>. <a href="{route:contact}">Hubungi Sekanca</a> untuk konsultasi.'],
            ],
            'redirect' => [
                ['type' => 'h2', 'content' => 'Redirect Checker — Cek Rantai Redirect 301 & 302'],
                ['type' => 'p', 'content' => 'Tool <strong>redirect checker</strong> gratis untuk melacak rantai redirect dari URL awal ke URL akhir. Cek redirect 301 (permanent) dan 302 (temporary), short URL, dan redirect chain. Penting untuk SEO dan memastikan link mengarah ke tujuan yang benar.'],
                ['type' => 'h3', 'content' => 'Kapan Cek Redirect?'],
                ['type' => 'p', 'content' => 'Gunakan <strong>cek redirect</strong> saat: memverifikasi short URL (bit.ly, dll), memastikan 301 redirect setelah migrasi domain, mengecek redirect chain yang terlalu panjang, atau audit SEO. <strong>Redirect chain</strong> yang panjang dapat mempengaruhi kecepatan dan SEO.'],
                ['type' => 'p', 'content' => 'Kombinasikan dengan <a href="{route:url-checker.tab:http}">HTTP checker</a> dan <a href="{route:url-checker.tab:dns}">DNS lookup</a>. <a href="{route:url-checker}">URL checker</a> lengkap dari <a href="{route:home}">Sekanca Media Digital</a>.'],
            ],
            'tcp-port' => [
                ['type' => 'h2', 'content' => 'Cek TCP Port & Port Scanner — Verifikasi Port Terbuka'],
                ['type' => 'p', 'content' => 'Tool <strong>cek port</strong> dan <strong>TCP port checker</strong> gratis untuk memeriksa apakah port tertentu (80, 443, 22, 21, dll) terbuka pada server. Berguna untuk verifikasi firewall, konfigurasi web server, SSH, FTP, atau layanan lain.'],
                ['type' => 'h3', 'content' => 'Port Umum yang Dicek'],
                ['type' => 'p', 'content' => 'Port 80 (HTTP), 443 (HTTPS), 22 (SSH), 21 (FTP), 25 (SMTP), 3306 (MySQL). <strong>Port scanner</strong> sederhana ini membantu memastikan hanya port yang diinginkan yang terbuka dan mendeteksi konfigurasi yang salah.'],
                ['type' => 'p', 'content' => 'Lihat juga <a href="{route:url-checker.tab:http}">HTTP checker</a>, <a href="{route:url-checker.tab:ping}">ping</a>, dan <a href="{route:url-checker}">URL checker</a>. <a href="{route:contact}">Konsultasi</a> keamanan & layanan digital dengan Sekanca.'],
            ],
            'whois' => [
                ['type' => 'h2', 'content' => 'WHOIS Lookup — Cek Informasi Domain & Tanggal Expired'],
                ['type' => 'p', 'content' => 'Tool <strong>WHOIS lookup</strong> dan <strong>cek WHOIS domain</strong> gratis. Lihat informasi registrasi domain: pemilik, registrar, tanggal expired, nameserver, dan status domain. Berguna sebelum beli domain, cek expiry, atau verifikasi ownership.'],
                ['type' => 'h3', 'content' => 'Informasi yang Tampil di WHOIS'],
                ['type' => 'p', 'content' => 'Hasil <strong>whois domain</strong> biasanya berisi: registrant, admin contact, tanggal dibuat & expired, nameserver, status (active, locked, dll). <strong>Cek expired domain</strong> penting agar domain tidak hangus. Gunakan <strong>whois lookup</strong> untuk riset kompetitor atau domain yang ingin Anda beli.'],
                ['type' => 'p', 'content' => 'Lengkapi dengan <a href="{route:url-checker.tab:dns}">DNS lookup</a>, <a href="{route:url-checker.tab:http}">HTTP checker</a>, dan <a href="{route:url-checker}">URL checker</a>. <a href="{route:service.index}">Sekanca</a> — layanan digital marketing & web development.'],
            ],
            default => $this->getUrlCheckerBlocks(),
        };

        return $blocks;
    }

    /**
     * Replace {route:name} and {route:name:param} placeholders with actual URLs.
     */
    protected function resolvePlaceholders(array $blocks, array $context): array
    {
        foreach ($blocks as &$block) {
            $block['content'] = preg_replace_callback(
                '/\{route:([^}]+)\}/',
                function ($matches) {
                    $parts = explode(':', $matches[1], 2);
                    $routeName = $parts[0];
                    $params = isset($parts[1]) ? array_filter(explode(':', $parts[1])) : [];

                    return route($routeName, $params);
                },
                $block['content']
            );
        }

        return $blocks;
    }
}
