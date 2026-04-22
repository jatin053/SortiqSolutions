<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Support\Seo\PageMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim((string) $request->query('search'));
        $activeCategory = trim((string) $request->query('category'));

        $categoryQuery = Blog::query()
            ->published()
            ->whereNotNull('category')
            ->where('category', '!=', '');

        $categoryMap = (clone $categoryQuery)
            ->pluck('category')
            ->unique()
            ->mapWithKeys(fn (string $category) => [Str::slug($category) => $category]);

        $blogsQuery = $this->publishedBlogsQuery();

        if ($searchTerm !== '') {
            $blogsQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        if ($activeCategory !== '' && $categoryMap->has($activeCategory)) {
            $blogsQuery->where('category', $categoryMap->get($activeCategory));
        }

        $categories = (clone $categoryQuery)
            ->selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->map(function ($item) {
                return (object) [
                    'name' => $item->category,
                    'slug' => Str::slug($item->category),
                    'total' => $item->total,
                ];
            });

        return view('frontend.blog.blog-list', [
            'blogs' => $blogsQuery->paginate(6)->withQueryString(),
            'categories' => $categories,
            'pageMeta' => PageMeta::custom(
                'Read the latest Sortiq Solutions blog posts on web design, development, digital marketing, and practical IT insights for growing businesses.'
            ),
            'recentBlogs' => $this->publishedBlogsQuery()
                ->limit(5)
                ->get(),
            'searchTerm' => $searchTerm,
            'activeCategory' => $activeCategory,
        ]);
    }

    public function feed(): JsonResponse
    {
        $blogs = $this->publishedBlogsQuery()
            ->get()
            ->map(function (Blog $blog) {
                $category = $blog->category ?: 'General';

                return [
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'image' => $blog->image_url,
                    'excerpt' => $blog->excerpt ?: Str::limit(strip_tags($blog->content), 140),
                    'date' => $blog->published_at?->toDateString(),
                    'categories' => [
                        [
                            'name' => $category,
                            'slug' => Str::slug($category),
                        ],
                    ],
                ];
            })
            ->values();

        return response()->json($blogs);
    }

    public function show(string $slug): View|RedirectResponse
    {
        $blog = Blog::query()
            ->when(
                ! auth()->check(),
                fn (Builder $query) => $query->published(),
            )
            ->where('slug', $slug)
            ->first();

        if (! $blog) {
            $canonicalSlug = collect(config('frontend-routes.legacy_blogs', []))
                ->search($slug, strict: true);

            if (is_string($canonicalSlug) && Blog::query()->where('slug', $canonicalSlug)->exists()) {
                return redirect()->route('frontend.blog.show', $canonicalSlug, 301);
            }

            abort(404);
        }

        $blog->increment('views');
        $blog->refresh();

        $recentBlogs = $this->publishedBlogsQuery()
            ->whereKeyNot($blog->getKey())
            ->limit(3)
            ->get();

        return view('frontend.blog.show', [
            'blog' => $blog,
            'pageMeta' => PageMeta::article(
                $blog->excerpt ?: $blog->content,
                $blog->image_url
            ),
            'recentBlogs' => $recentBlogs,
        ]);
    }

    private function publishedBlogsQuery(): Builder
    {
        return Blog::query()->published()->ordered();
    }
}
