<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Support\Seo\PageMeta;
use Illuminate\View\View;
use Throwable;

class VideoController extends Controller
{
    public function index(): View
    {
        try {
            $videos = Video::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $videos = collect();
        }

        return view('frontend.videos.videos-page', [
            'videos' => $videos,
            'pageMeta' => PageMeta::custom(
                $videos->isNotEmpty()
                    ? sprintf(
                        'Watch %d Sortiq Solutions videos on web development, digital marketing, design, and business-focused IT insights.',
                        $videos->count()
                    )
                    : PageMeta::descriptionForRoute('frontend.videos')
            ),
        ]);
    }
}
