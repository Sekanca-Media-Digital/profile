<?php

namespace App\Providers;

use App\Services\HomePageService;
use App\Services\MenuService;
use App\Services\SeoContentService;
use App\Services\SiteService;
use App\Services\UrlCheckerService;
use App\View\Composers\LayoutComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MenuService::class);
        $this->app->singleton(SiteService::class);
        $this->app->singleton(HomePageService::class);
        $this->app->singleton(UrlCheckerService::class);
        $this->app->singleton(SeoContentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships(true);

        View::composer('themes.*.layout', LayoutComposer::class);
    }
}
