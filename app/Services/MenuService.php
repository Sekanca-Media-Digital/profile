<?php

namespace App\Services;

class MenuService
{
    /**
     * Get menu items for navbar.
     * TODO: Connect to database when ready.
     */
    public function getMenu(): array
    {
        $items = [
            ['label' => 'Beranda', 'route' => 'home', 'type' => 'link'],
            ['label' => 'Tentang Kami', 'route' => 'about', 'type' => 'link'],
            ['label' => 'Layanan', 'route' => 'service.index', 'type' => 'link'],
            [
                'label' => 'Tools',
                'type' => 'dropdown',
                'items' => [
                    ['label' => 'Landing Page Builder', 'route' => 'landing-page-builder', 'disabled' => false],
                    ['label' => 'URL Checker', 'route' => 'url-checker', 'disabled' => false],
                ],
            ],
            ['label' => 'Kontak', 'route' => 'contact', 'type' => 'link'],
        ];

        return $this->resolveMenuUrls($items);
    }

    protected function resolveMenuUrls(array $items): array
    {
        foreach ($items as &$item) {
            if (($item['type'] ?? '') === 'dropdown' && isset($item['items'])) {
                foreach ($item['items'] as &$sub) {
                    $sub['url'] = $sub['route'] ?? $sub['url'] ?? '#';
                    if (isset($sub['route']) && $sub['route']) {
                        $sub['url'] = route($sub['route']);
                    }
                    unset($sub['route']);
                }
            } elseif (isset($item['route'])) {
                $item['url'] = route($item['route']);
                $item['external'] = false;
                unset($item['route']);
            }
        }

        return $items;
    }
}
