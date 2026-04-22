<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');

        if ($status !== 'draft' && $status !== 'published') {
            $status = null;
        }

        $query = Video::query();

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%");
            });
        }

        $tabQuery = clone $query;

        if ($status) {
            $query->where('status', $status);
        }

        $videos = $query
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Video::count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => $tabQuery->count(),
            'published' => (clone $tabQuery)->where('status', 'published')->count(),
            'draft' => (clone $tabQuery)->where('status', 'draft')->count(),
        ];

        return view('admin.videos.video-list', [
            'videos' => $videos,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function create(): View
    {
        $video = new Video([
            'status' => 'published',
            'published_at' => now(),
            'sort_order' => 0,
            'views' => 0,
        ]);

        return view('admin.videos.create-video', [
            'video' => $video,
            'permalink' => $this->getPermalink($video),
        ]);
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $video = Video::create($data);

        return redirect()
            ->route('admin.videos.edit', $video)
            ->with('status', 'Video created successfully.');
    }

    public function show(Video $video): View
    {
        return view('admin.videos.video-details', [
            'video' => $video,
        ]);
    }

    public function edit(Video $video): View
    {
        return view('admin.videos.edit-video', [
            'video' => $video,
            'permalink' => $this->getPermalink($video),
        ]);
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $data = $request->validated();

        $video->update($data);

        return redirect()
            ->route('admin.videos.edit', $video)
            ->with('status', 'Video updated successfully.');
    }

    private function getPermalink(Video $video): string
    {
        $slug = $video->slug;

        if (empty($slug)) {
            $slug = Str::slug($video->title ?: 'new-video');
        }

        return url('videos#' . $slug);
    }
}
