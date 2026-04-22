<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VideoController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $videos = Video::query()
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        return VideoResource::collection($videos);
    }

    public function show(Video $video): VideoResource
    {
        if ($video->status !== 'published') {
            abort(404);
        }

        return new VideoResource($video);
    }
}