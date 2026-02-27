<?php

namespace App\View\Composers;

use App\Services\MenuService;
use App\Services\SiteService;
use Illuminate\View\View;

class LayoutComposer
{
    public function __construct(
        private MenuService $menuService,
        private SiteService $siteService
    ) {}

    public function compose(View $view): void
    {
        $view->with([
            'menu' => $this->menuService->getMenu(),
            'site' => $this->siteService->getGlobal(),
        ]);
    }
}
