<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Support\LocalMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim((string) $request->query('search'));
        $status = $request->query('status');

        if (!in_array($status, ['draft', 'published'], true)) {
            $status = null;
        }

        $blogQuery = Blog::query();

        if ($searchTerm !== '') {
            $blogQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('category', 'like', '%' . $searchTerm . '%')
                    ->orWhere('excerpt', 'like', '%' . $searchTerm . '%')
                    ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        $blogsQuery = clone $blogQuery;

        if ($status !== null) {
            $blogsQuery->where('status', $status);
        }

        $blogs = $blogsQuery->ordered()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Blog::query()->count(),
            'published' => Blog::query()->published()->count(),
            'draft' => Blog::query()->where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => (clone $blogQuery)->count(),
            'published' => (clone $blogQuery)->where('status', 'published')->count(),
            'draft' => (clone $blogQuery)->where('status', 'draft')->count(),
        ];

        return view('admin.blogs.blog-list', [
            'blogs' => $blogs,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function create(): View
    {
        $blog = new Blog([
            'published_at' => now(),
            'status' => 'draft',
            'views' => 0,
        ]);

        return view('admin.blogs.create-blog', [
            'blog' => $blog,
            'categories' => Blog::CATEGORIES,
            'permalink' => $this->permalink($blog),
        ]);
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $blog = Blog::create($this->payload($request));

        return redirect()
            ->route('admin.blogs.edit', $blog)
            ->with('status', 'Blog created successfully.');
    }

    public function show(Blog $blog): View
    {
        return view('admin.blogs.blog-details', [
            'blog' => $blog,
        ]);
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit-blog', [
            'blog' => $blog,
            'categories' => Blog::CATEGORIES,
            'permalink' => $this->permalink($blog),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $blog->update($this->payload($request, $blog));

        return redirect()
            ->route('admin.blogs.edit', $blog)
            ->with('status', 'Blog updated successfully.');
    }

    private function permalink(Blog $blog): string
    {
        $slug = $blog->slug;

        if (!$slug) {
            $slug = Str::slug($blog->title ?: 'new-blog');
        }

        return route('frontend.blog.show', $slug);
    }

    private function payload(BlogRequest $request, ?Blog $blog = null): array
    {
        $data = $request->validated();

        unset($data['image_file']);

        if ($request->hasFile('image_file')) {
            if ($blog) {
                LocalMedia::deleteUploadedFile($blog->image);
            }

            $data['image'] = LocalMedia::storeUploadedFile(
                $request->file('image_file'),
                'uploads/blogs',
                $request->input('title', 'blog-image')
            );
        } elseif ($blog) {
            $data['image'] = $blog->image;
        }

        return $data;
    }
}
