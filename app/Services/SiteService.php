<?php

namespace App\Services;

class SiteService
{
    /**
     * Get global data for layout (site name, logo, footer).
     * TODO: Connect to database when ready.
     */
    public function getGlobal(): array
    {
        return [
            'name' => 'Sekanca Media Digital',
            'logo' => asset('assets/images/logo.webp'),
            'footer' => '© 2026 Sekanca Media Digital. All Rights Reserved.',
            'url' => config('app.url'),
            'image' => asset('assets/images/logo.webp'),
        ];
    }
}
