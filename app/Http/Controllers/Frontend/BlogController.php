<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Support\Seo\PageMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class BlogController extends Controller
{
    private const BLOGS_PER_PAGE = 6;

    public function index(Request $request): View
    {
        $searchTerm = trim((string) $request->query('search'));
        $activeCategory = trim((string) $request->query('category'));
        $categories = $this->categories();
        $categoryMap = $this->categoryMap($categories);

        if ($activeCategory !== '' && ! array_key_exists($activeCategory, $categoryMap)) {
            $activeCategory = '';
        }

        return view('frontend.blog.blog-list', [
            'blogs' => $this->blogs($searchTerm, $activeCategory, $categoryMap),
            'categories' => $categories,
            'recentBlogs' => $this->recentBlogs(),
            'searchTerm' => $searchTerm,
            'activeCategory' => $activeCategory,
        ]);
    }

    public function feed(): JsonResponse
    {
        try {
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
        } catch (Throwable $exception) {
            report($exception);

            $blogs = collect();
        }

        return response()->json($blogs);
    }

    public function show(string $slug): View|RedirectResponse
    {
        try {
            $blog = Blog::query()
                ->when(
                    ! auth()->check(),
                    fn (Builder $query) => $query->published(),
                )
                ->where('slug', $slug)
                ->first();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('frontend.blog.index');
        }

        if (! $blog) {
            $legacyRedirect = $this->legacyBlogRedirect($slug);

            if ($legacyRedirect) {
                return $legacyRedirect;
            }

            abort(404);
        }

        $this->recordBlogView($blog);

        return view('frontend.blog.show', [
            'blog' => $blog,
            'pageMeta' => PageMeta::article(
                $blog->excerpt ?: $blog->content,
                $blog->image_url,
                "{$blog->title} | Sortiq Solutions"
            ),
            'recentBlogs' => $this->recentBlogs($blog, 3),
        ]);
    }

    private function categories()
    {
        try {
            return Blog::query()
                ->published()
                ->whereNotNull('category')
                ->where('category', '!=', '')
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
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function categoryMap($categories): array
    {
        $categoryMap = [];

        foreach ($categories as $category) {
            $categoryMap[$category->slug] = $category->name;
        }

        return $categoryMap;
    }

    private function blogs(string $searchTerm, string $activeCategory, array $categoryMap): LengthAwarePaginator
    {
        try {
            $blogsQuery = $this->publishedBlogsQuery();

            if ($searchTerm !== '') {
                $blogsQuery->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                        ->orWhere('content', 'like', "%{$searchTerm}%");
                });
            }

            if ($activeCategory !== '') {
                $blogsQuery->where('category', $categoryMap[$activeCategory]);
            }

            return $blogsQuery
                ->paginate(self::BLOGS_PER_PAGE)
                ->withQueryString();
        } catch (Throwable $exception) {
            report($exception);

            return $this->emptyBlogsPaginator();
        }
    }

    private function recentBlogs(?Blog $blog = null, int $limit = 5)
    {
        try {
            $recentBlogsQuery = $this->publishedBlogsQuery();

            if ($blog) {
                $recentBlogsQuery->whereKeyNot($blog->getKey());
            }

            return $recentBlogsQuery
                ->limit($limit)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function legacyBlogRedirect(string $slug): ?RedirectResponse
    {
        $canonicalSlug = collect(config('frontend-routes.legacy_blogs', []))
            ->search($slug, strict: true);

        if (! is_string($canonicalSlug)) {
            return null;
        }

        try {
            if (Blog::query()->where('slug', $canonicalSlug)->exists()) {
                return redirect()->route('frontend.blog.show', $canonicalSlug, 301);
            }
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('frontend.blog.index');
        }

        return null;
    }

    private function recordBlogView(Blog $blog): void
    {
        try {
            $blog->increment('views');
            $blog->refresh();
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function publishedBlogsQuery(): Builder
    {
        return Blog::query()->published()->ordered();
    }

    private function emptyBlogsPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            collect(),
            0,
            self::BLOGS_PER_PAGE,
            Paginator::resolveCurrentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}
