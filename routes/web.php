<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/robots.txt', function () {
    $base = rtrim(url('/'), '/');
    return response("User-agent: *\nAllow: /\n\nSitemap: {$base}/sitemap.xml\n", 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
})->name('robots');

Route::get('/sitemap.xml', function () {
    $base = rtrim(url('/'), '/');
    $urlCheckerTabs = ['ip-info', 'ping', 'ping-global', 'http', 'dns', 'redirect', 'tcp-port', 'whois'];
    $pages = [
        ['url' => $base . '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['url' => $base . '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['url' => $base . '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['url' => $base . '/service', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['url' => $base . '/landing-page-builder', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['url' => $base . '/url-checker', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ];
    foreach ($urlCheckerTabs as $tab) {
        $pages[] = ['url' => $base . '/url-checker/' . $tab, 'priority' => '0.7', 'changefreq' => 'monthly'];
    }
    $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($pages as $p) {
        $xml .= '<url><loc>' . htmlspecialchars($p['url']) . '</loc><changefreq>' . $p['changefreq'] . '</changefreq><priority>' . $p['priority'] . '</priority></url>';
    }
    $xml .= '</urlset>';
    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service', [HomeController::class, 'service'])->name('service.index');
Route::get('/service/{slug}', [HomeController::class, 'serviceDetail'])->name('service.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/landing-page-builder', [PageController::class, 'landingPageBuilder'])->name('landing-page-builder');
Route::post('/landing-page-builder/generate', [PageController::class, 'landingPageBuilderGenerate'])->name('landing-page-builder.generate');
Route::get('/url-checker', [PageController::class, 'urlChecker'])->name('url-checker');
Route::get('/url-checker/{tab}', [PageController::class, 'urlCheckerTab'])->name('url-checker.tab')->where('tab', 'ip-info|ping|ping-global|http|dns|redirect|tcp-port|whois');
Route::post('/url-checker', [PageController::class, 'urlCheckerCheck'])->name('url-checker.check');
Route::get('/url-checker/run-check', [PageController::class, 'urlCheckerRunCheck'])->name('url-checker.run-check');
