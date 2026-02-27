<?php

namespace App\Services;

use Illuminate\Support\Facades\View;

class LandingPageBuilderService
{
    public static function getLayouts(): array
    {
        return [
            1 => ['name' => 'Layout 1 — Satu kolom, hero tengah', 'cols' => '1 kolom'],
            2 => ['name' => 'Layout 2 — Dua kolom: gambar kiri, teks kanan', 'cols' => '2 kolom'],
            3 => ['name' => 'Layout 3 — Dua kolom: teks kiri, gambar kanan', 'cols' => '2 kolom'],
            4 => ['name' => 'Layout 4 — Full-width background, overlay teks', 'cols' => '1 kolom'],
            5 => ['name' => 'Layout 5 — Hero + 3 kolom fitur + CTA', 'cols' => '3 kolom'],
            6 => ['name' => 'Layout 6 — Minimal, banyak tombol sejajar', 'cols' => '1 kolom'],
            7 => ['name' => 'Layout 7 — Dua kolom sama lebar', 'cols' => '2 kolom'],
            8 => ['name' => 'Layout 8 — Satu kolom, 2 blok gambar-teks', 'cols' => '1 kolom'],
            9 => ['name' => 'Layout 9 — Kartu: gambar, headline, tombol', 'cols' => '1 kolom'],
            10 => ['name' => 'Layout 10 — Split hero: setengah gambar, setengah teks', 'cols' => '2 kolom'],
            11 => ['name' => 'Layout 11 — Navbar (Daftar + Login) + hero', 'cols' => '1 kolom'],
        ];
    }

    /**
     * @param  array{layout: int, primary_color: string, image_url: string, logo_url?: string, background_color?: string, buttons: array, headline: string, tagline: string, head_script?: string, body_script?: string, register_url?: string, login_url?: string}  $data
     */
    public function generateHtml(array $data): string
    {
        $layout = (int) ($data['layout'] ?? 1);
        $layout = $layout < 1 || $layout > 11 ? 1 : $layout;

        $buttons = $data['buttons'] ?? [];
        $buttons = array_slice(array_filter($buttons, fn ($b) => ! empty($b['label'] ?? '')), 0, 5);

        $viewData = [
            'primary_color' => $data['primary_color'] ?? '#0d6efd',
            'image_url' => $data['image_url'] ?? '',
            'logo_url' => $data['logo_url'] ?? '',
            'background_color' => $data['background_color'] ?? '#f8f9fa',
            'buttons' => $buttons,
            'seo_title' => $data['headline'] ?? 'Landing Page',
            'head_script' => $data['head_script'] ?? '',
            'body_script' => $data['body_script'] ?? '',
            'headline' => $data['headline'] ?? 'Headline Anda',
            'tagline' => $data['tagline'] ?? 'Tagline atau deskripsi singkat.',
            'register_url' => $data['register_url'] ?? '',
            'login_url' => $data['login_url'] ?? '',
        ];

        return View::make('partials.landing-layouts.layout-' . str_pad((string) $layout, 2, '0', STR_PAD_LEFT), $viewData)->render();
    }
}
