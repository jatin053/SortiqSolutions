<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Support\Seo\PageMeta;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::query()
            ->published()
            ->ordered()
            ->get();

        return view('frontend.videos.videos-page', [
            'videos' => $videos,
            'pageMeta' => PageMeta::custom(sprintf(
                'Watch %d Sortiq Solutions videos on web development, digital marketing, design, and business-focused IT insights.',
                $videos->count()
            )),
        ]);
    }
}
