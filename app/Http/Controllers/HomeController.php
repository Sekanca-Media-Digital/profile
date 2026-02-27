<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HomePageService;
use App\Services\SeoContentService;
use App\Services\SiteService;

class HomeController extends Controller
{
    public function __construct(
        private HomePageService $homePageService,
        private SiteService $siteService,
        private SeoContentService $seoContentService
    ) {}

    public function index()
    {
        $data = $this->homePageService->getContent();

        return view(config('app.theme') . 'home', array_merge($data, [
            'meta' => [
                'title' => $data['meta_title'] ?? $data['title'],
                'description' => $data['meta_description'] ?? $data['description'],
                'keywords' => $data['meta_keywords'] ?? '',
                'canonical' => route('home'),
            ],
            'seoContent' => $this->seoContentService->getContent('home'),
        ]));
    }

    public function service()
    {
        $data = $this->homePageService->getContent();
        $site = $this->siteService->getGlobal();

        return view(config('app.theme') . 'service', [
            'meta' => [
                'title' => 'Layanan | ' . $site['name'],
                'description' => $data['description'] . ' Layanan Security as a Service, Digital Marketing, Social Media Marketing.',
                'keywords' => 'layanan digital, security as a service, digital marketing, social media marketing',
                'canonical' => route('service.index'),
            ],
            'description' => $data['description'],
            'service' => $data['service'],
            'seoContent' => $this->seoContentService->getContent('service'),
        ]);
    }

    public function serviceDetail(string $slug)
    {
        $service = $this->homePageService->getServiceBySlug($slug);

        if (!$service) {
            abort(404);
        }

        $site = $this->siteService->getGlobal();

        return view(config('app.theme') . 'service-detail', [
            'meta' => [
                'title' => $service['meta_title'] ?? ($service['title'] . ' | ' . $site['name']),
                'description' => $service['meta_description'] ?? strip_tags($service['description']),
                'keywords' => $service['meta_keywords'] ?? '',
                'canonical' => route('service.show', $slug),
                'og_type' => 'article',
            ],
            'service' => $service,
            'seoContent' => $this->seoContentService->getContent('service-detail', ['service' => $service]),
        ]);
    }
}
