<?php

namespace App\Services;

class HomePageService
{
    protected function getServicesData(): array
    {
        return [
            [
                'slug' => 'security-as-a-service',
                'title' => 'Security as a Service',
                'description' => $this->getSecurityAsAServiceArticle(),
                'meta_title' => 'Security as a Service (SECaaS) | Sekanca Media Digital',
                'meta_description' => 'Solusi keamanan berbasis cloud untuk melindungi sistem, jaringan, aplikasi, dan data perusahaan Anda. SECaaS dari Sekanca Media Digital.',
                'meta_keywords' => 'security as a service, SECaaS, keamanan cloud, cybersecurity',
            ],
            [
                'slug' => 'digital-marketing',
                'title' => 'Digital Marketing',
                'description' => $this->getDigitalMarketingArticle(),
                'meta_title' => 'Layanan Digital Marketing | Sekanca Media Digital',
                'meta_description' => 'Strategi pemasaran digital terintegrasi untuk bisnis Anda. Menjangkau audiens tepat dan membangun hubungan jangka panjang dengan pelanggan.',
                'meta_keywords' => 'digital marketing, pemasaran digital, strategi marketing',
            ],
            [
                'slug' => 'social-media-marketing',
                'title' => 'Social Media Marketing',
                'description' => $this->getSocialMediaMarketingArticle(),
                'meta_title' => 'Social Media Marketing | Sekanca Media Digital',
                'meta_description' => 'Strategi pemasaran media sosial untuk membangun brand awareness, meningkatkan engagement, dan mendorong penjualan bisnis Anda.',
                'meta_keywords' => 'social media marketing, SMM, media sosial, brand awareness',
            ],
        ];
    }

    protected function getSecurityAsAServiceArticle(): string
    {
        return <<<'HTML'
<p class="lead"><strong>Security as a Service (SECaaS)</strong> adalah solusi keamanan berbasis cloud yang dirancang untuk melindungi sistem, jaringan, aplikasi, dan data perusahaan tanpa memerlukan investasi infrastruktur keamanan yang besar.</p>

<h3 class="h5 mt-4 mb-2">Apa itu Security as a Service?</h3>
<p>SECaaS memindahkan tanggung jawab pengelolaan keamanan dari sisi Anda ke penyedia layanan yang berpengalaman. Dengan model berlangganan, perusahaan dapat mengakses teknologi keamanan mutakhir—seperti firewall, deteksi intrusi, pemantauan ancaman, dan manajemen kerentanan—tanpa harus membeli perangkat keras atau merekrut tim keamanan internal yang besar. Solusi ini sangat cocok untuk UMKM hingga perusahaan menengah yang ingin fokus pada bisnis inti sambil tetap terlindungi dari ancaman siber.</p>

<h3 class="h5 mt-4 mb-2">Mengapa Perusahaan Memilih SECaaS?</h3>
<p>Ancaman siber terus berkembang: ransomware, phishing, kebocoran data, dan serangan DDoS menjadi risiko nyata bagi operasional dan reputasi bisnis. Membangun dan memelihara infrastruktur keamanan sendiri membutuhkan biaya awal yang tinggi, keahlian khusus, serta pembaruan berkelanjutan. Dengan SECaaS, Anda mendapatkan akses ke tim ahli dan alat canggih yang selalu diperbarui, dengan biaya yang dapat diprediksi dan skalabel sesuai kebutuhan.</p>

<h3 class="h5 mt-4 mb-2">Layanan yang Kami Tawarkan</h3>
<p>Kami menyediakan layanan SECaaS yang mencakup pemantauan keamanan 24/7, deteksi dan respons ancaman, audit keamanan berkala, serta rekomendasi peningkatan postur keamanan. Kami bekerja dengan pendekatan proaktif: tidak hanya menangani insiden setelah terjadi, tetapi juga mencegah dan memitigasi risiko sedini mungkin. Integrasi dengan infrastruktur cloud atau on-premise Anda dilakukan dengan aman dan sesuai standar industri.</p>

<h3 class="h5 mt-4 mb-2">Hasil yang Diharapkan</h3>
<p>Setelah menerapkan SECaaS, perusahaan dapat mengurangi risiko gangguan bisnis akibat serangan siber, memenuhi tuntutan kepatuhan (compliance), serta meningkatkan kepercayaan pelanggan dan mitra. Tim internal Anda dapat fokus pada inovasi dan pertumbuhan, sementara aspek keamanan ditangani oleh pakar yang berpengalaman.</p>

<p class="mt-4">Ingin tahu lebih lanjut atau memulai konsultasi keamanan? Hubungi kami untuk diskusi tanpa kewajiban.</p>
HTML;
    }

    protected function getDigitalMarketingArticle(): string
    {
        return <<<'HTML'
<p class="lead">Kami menyediakan layanan <strong>Digital Marketing</strong> terintegrasi untuk membantu bisnis Anda berkembang di era digital. Dengan pendekatan yang terencana dan berbasis data, bisnis dapat menjangkau audiens yang tepat serta membangun hubungan jangka panjang dengan pelanggan.</p>

<h3 class="h5 mt-4 mb-2">Peran Digital Marketing dalam Pertumbuhan Bisnis</h3>
<p>Pemasaran digital tidak sekadar memindahkan iklan dari media konvensional ke internet. Ini adalah ekosistem yang mencakup SEO, konten, iklan berbayar (PPC), email marketing, analitik, dan pengukuran performa. Tujuan utamanya adalah menarik calon pelanggan di saat mereka sedang mencari solusi, membangun kesadaran merek, dan mengubah prospek menjadi pelanggan setia. Tanpa strategi digital yang jelas, bisnis berisiko tertinggal dari pesaing yang sudah aktif di ranah online.</p>

<h3 class="h5 mt-4 mb-2">Pendekatan Kami: Data dan Strategi</h3>
<p>Kami tidak mengandalkan tebakan. Setiap kampanye dirancang berdasarkan riset audiens, analisis kompetitor, dan data perilaku pengguna. Dari penentuan saluran (Google, sosial media, website, email) hingga penentuan pesan dan anggaran, semuanya diselaraskan dengan tujuan bisnis Anda—apakah itu peningkatan penjualan, lead generation, atau penguatan brand awareness. Kami juga memastikan bahwa setiap rupiah yang dihabiskan dapat diukur dan dioptimalkan.</p>

<h3 class="h5 mt-4 mb-2">Layanan yang Tercakup</h3>
<p>Layanan digital marketing kami meliputi optimasi mesin pencari (SEO) untuk website Anda, pengelolaan iklan di Google Ads dan platform sosial, pembuatan dan distribusi konten yang relevan, serta pengaturan dan pelaporan analitik. Kami dapat mendampingi Anda dari tahap perencanaan strategi hingga eksekusi dan evaluasi bulanan, sehingga Anda selalu mendapat gambaran jelas tentang perkembangan kampanye.</p>

<h3 class="h5 mt-4 mb-2">Mengapa Memilih Sekanca?</h3>
<p>Tim kami menggabungkan pemahaman mendalam tentang pemasaran digital dengan pengalaman menangani berbagai industri. Kami fokus pada hasil yang terukur dan komunikasi yang transparan, sehingga Anda tidak hanya menerima laporan angka, tetapi juga insight dan rekomendasi yang dapat ditindaklanjuti untuk pertumbuhan bisnis jangka panjang.</p>

<p class="mt-4">Siap mengembangkan bisnis Anda di dunia digital? Mari kita bicara tentang tujuan Anda dan cara kami membantu mewujudkannya.</p>
HTML;
    }

    protected function getSocialMediaMarketingArticle(): string
    {
        return <<<'HTML'
<p class="lead"><strong>Social Media Marketing</strong> adalah strategi pemasaran digital yang memanfaatkan platform media sosial untuk membangun brand awareness, meningkatkan engagement, dan mendorong penjualan secara efektif.</p>

<h3 class="h5 mt-4 mb-2">Kekuatan Media Sosial untuk Bisnis</h3>
<p>Platform seperti Instagram, Facebook, LinkedIn, TikTok, dan YouTube telah menjadi tempat di mana jutaan orang menghabiskan waktu setiap hari. Di sana, mereka menemukan inspirasi, informasi, dan rekomendasi—termasuk tentang produk dan layanan. Memiliki kehadiran yang konsisten dan strategis di media sosial memungkinkan merek Anda terlihat, didiskusikan, dan dipercaya oleh calon pelanggan. Tanpa strategi yang tepat, akun bisnis bisa sekadar “ada” tanpa memberikan dampak nyata terhadap penjualan atau loyalitas.</p>

<h3 class="h5 mt-4 mb-2">Strategi yang Kami Terapkan</h3>
<p>Kami tidak hanya mengelola postingan; kami membangun strategi konten yang selaras dengan tujuan bisnis dan karakter audiens. Ini mencakup penentuan platform yang paling relevan, tone of voice, jadwal posting, jenis konten (edukatif, promosi, cerita pelanggan), serta kampanye berbayar untuk memperluas jangkauan. Setiap aktivitas dirancang untuk mendorong engagement yang bermakna—bukan sekadar like atau follow—dan mengarahkan audiens ke langkah berikutnya, misalnya mengunjungi website atau menghubungi penjualan.</p>

<h3 class="h5 mt-4 mb-2">Apa yang Anda Dapatkan</h3>
<p>Layanan social media marketing kami meliputi perencanaan konten (content calendar), pembuatan konten (copy, desain, atau koordinasi dengan kreator), manajemen komunitas dan respons komentar/chat, serta iklan di media sosial (targeting, creative, dan optimasi). Kami juga menyediakan laporan berkala yang memudahkan Anda melihat pertumbuhan akun, engagement, dan dampaknya terhadap traffic atau konversi.</p>

<h3 class="h5 mt-4 mb-2">Membangun Merek yang Diingat</h3>
<p>Media sosial adalah ruang untuk bercerita dan membangun hubungan. Dengan konsistensi dan pesan yang tepat, merek Anda dapat menjadi yang pertama diingat ketika pelanggan membutuhkan solusi yang Anda tawarkan. Kami membantu Anda tampil profesional, relevan, dan mudah dihubungi—sehingga media sosial benar-benar menjadi aset pemasaran, bukan beban.</p>

<p class="mt-4">Mau mulai mengoptimalkan kehadiran bisnis Anda di media sosial? Hubungi kami untuk konsultasi dan rencana yang disesuaikan dengan kebutuhan Anda.</p>
HTML;
    }

    /**
     * Get home page content (hero, about, services).
     * TODO: Connect to database when ready.
     */
    public function getContent(): array
    {
        $services = $this->getServicesData();

        return [
            'title' => 'Sekanca Media Digital | Digital Innovation for Modern Business',
            'description' => 'Kami membantu bisnis berkembang dengan solusi digital kreatif dan profesional.',
            'meta_title' => 'Sekanca Media Digital | Digital Innovation for Modern Business',
            'meta_description' => 'Kami membantu bisnis berkembang dengan solusi digital kreatif dan profesional. Layanan Security as a Service, Digital Marketing, dan Social Media Marketing.',
            'meta_keywords' => 'sekanca media digital, digital agency, web development, digital marketing, branding',
            'about' => [
                'title' => 'Tentang Kami',
                'description' => 'Sekanca Media Digital adalah agensi kreatif yang berfokus pada pengembangan website, branding, dan digital marketing dengan pendekatan modern dan strategis.',
            ],
            'service' => array_map(fn ($s) => array_intersect_key($s, array_flip(['slug', 'title', 'description'])), $services),
        ];
    }

    /**
     * Get service by slug. Returns null if not found.
     */
    public function getServiceBySlug(string $slug): ?array
    {
        foreach ($this->getServicesData() as $service) {
            if ($service['slug'] === $slug) {
                return $service;
            }
        }

        return null;
    }
}
