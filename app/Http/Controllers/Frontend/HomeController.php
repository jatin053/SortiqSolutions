<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use App\Models\Video;
use App\Support\Seo\PageMeta;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index(): View
    {
        try {
            $homeClientLogos = ClientLogo::query()
                ->published()
                ->ordered()
                ->get();

            $homeVideos = Video::query()
                ->published()
                ->ordered()
                ->limit(4)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $homeClientLogos = ClientLogo::newCollection();
            $homeVideos = Video::newCollection();
        }

        return view('frontend.home.home-page', [
            'pageMeta' => PageMeta::custom(
                'Sortiq Solutions provides web development, mobile app development, digital marketing, and scalable IT services for businesses that want reliable digital growth.'
            ),
            'homeClientLogos' => $homeClientLogos,
            'homeVideos' => $homeVideos,
        ]);
    }
}
