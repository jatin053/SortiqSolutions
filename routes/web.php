<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageMetaController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteLayoutSettingController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\ClientController as FrontendClientController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\PortfolioController as FrontendPortfolioController;
use App\Http\Controllers\Frontend\ReviewController as FrontendReviewController;
use App\Http\Controllers\Frontend\VideoController as FrontendVideoController;
use Illuminate\Support\Facades\Route;

$frontendRoutes = config('frontend-routes');

$registerViewRoutes = function (array $routes, string $namePrefix = 'frontend.') : void {
    foreach ($routes as $uri => $view) {
        Route::view("/{$uri}", $view)->name("{$namePrefix}{$uri}");
    }
};

$registerSlugRoutes = function (array $slugs, string $viewPrefix, string $namePrefix) : void {
    foreach ($slugs as $slug) {
        Route::view("/{$slug}", "{$viewPrefix}.{$slug}")->name("{$namePrefix}{$slug}");
    }
};

$registerRedirects = function (array $redirects, string $targetPrefix = '') : void {
    foreach ($redirects as $old => $new) {
        Route::redirect("/{$old}", "{$targetPrefix}/{$new}", 301);
    }
};

$registerAdminResourceRoutes = function (string $prefix, string $name, string $controller, string $parameter) : void {
    Route::prefix($prefix)
        ->name("{$name}.")
        ->controller($controller)
        ->group(function () use ($parameter) {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get("/{{$parameter}}", 'show')->name('show');
            Route::get("/{{$parameter}}/edit", 'edit')->name('edit');
            Route::put("/{{$parameter}}", 'update')->name('update');
        });
};

Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend.home');
Route::redirect('/sortiqsolution', '/', 301);

$staticPageRoutes = $frontendRoutes['pages'];
unset($staticPageRoutes['reviews'], $staticPageRoutes['clients'], $staticPageRoutes['videos'], $staticPageRoutes['portfolio']);

$registerViewRoutes($staticPageRoutes);
$registerRedirects($frontendRoutes['legacy_pages']);

Route::get('/reviews', [FrontendReviewController::class, 'index'])->name('frontend.reviews');
Route::get('/reviews/{slug}', [FrontendReviewController::class, 'show'])->name('frontend.reviews.show');
Route::get('/clients', [FrontendClientController::class, 'index'])->name('frontend.clients');
Route::get('/videos', [FrontendVideoController::class, 'index'])->name('frontend.videos');
Route::get('/portfolios', [FrontendPortfolioController::class, 'index'])->name('frontend.portfolio');
Route::redirect('/portfolio', '/portfolios', 301);

Route::prefix('blog')->name('frontend.blog.')->group(function () use (
    $frontendRoutes
) {
    Route::get('/', [FrontendBlogController::class, 'index'])->name('index');
    Route::get('/feed.json', [FrontendBlogController::class, 'feed'])->name('feed');
    Route::get('/{slug}', [FrontendBlogController::class, 'show'])->name('show');
});

Route::prefix('services')->name('frontend.services.')->group(function () use (
    $frontendRoutes,
    $registerRedirects,
    $registerSlugRoutes
) {
    Route::view('/', 'frontend.services.services-page')->name('index');

    $registerSlugRoutes($frontendRoutes['services'], 'frontend.services', '');
    $registerRedirects($frontendRoutes['legacy_services'], '/services');
});

Route::redirect('/admin', '/sortiqadmin', 301);

Route::prefix('sortiqadmin')->name('admin.')->group(function () use ($registerAdminResourceRoutes) {
    Route::middleware('admin.guest')->controller(AuthController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('authenticate');
    });

    Route::middleware('admin.auth')->group(function () use ($registerAdminResourceRoutes) {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

        Route::controller(SiteLayoutSettingController::class)->group(function () {
            Route::get('/site-layout', 'edit')->name('site-layout.edit');
            Route::put('/site-layout', 'update')->name('site-layout.update');
        });

        Route::controller(PageMetaController::class)->group(function () {
            Route::get('/pages', 'edit')->name('pages.edit');
            Route::put('/pages', 'update')->name('pages.update');
        });

        $registerAdminResourceRoutes('blogs', 'blogs', BlogController::class, 'blog');
        $registerAdminResourceRoutes('portfolios', 'portfolios', AdminPortfolioController::class, 'portfolio');
        $registerAdminResourceRoutes('videos', 'videos', AdminVideoController::class, 'video');
        $registerAdminResourceRoutes('client-logos', 'client-logos', ClientLogoController::class, 'clientLogo');
        $registerAdminResourceRoutes('reviews', 'reviews', ReviewController::class, 'review');

        Route::prefix('contact-messages')
            ->name('contact-messages.')
            ->controller(AdminContactMessageController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{contactMessage}', 'show')->name('show');
            });
    });
});
