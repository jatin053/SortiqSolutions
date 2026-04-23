<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\View\View;
use Throwable;

class VideoController extends Controller
{
    public function index(): View
    {
        return view('frontend.videos.videos-page', [
            'videos' => $this->videos(),
        ]);
    }

    private function videos()
    {
        try {
            return Video::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }
}
