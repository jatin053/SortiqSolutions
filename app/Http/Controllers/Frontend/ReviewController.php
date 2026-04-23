<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Support\Seo\PageMeta;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class ReviewController extends Controller
{
    public function index(): View
    {
        try {
            $reviews = Review::query()
                ->published()
                ->ordered()
                ->paginate(9);
        } catch (Throwable $exception) {
            report($exception);

            $reviews = new LengthAwarePaginator(
                collect(),
                0,
                9,
                Paginator::resolveCurrentPage(),
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ]
            );
        }

        return view('frontend.reviews.reviews-page', [
            'reviews' => $reviews,
            'pageMeta' => PageMeta::custom(
                $reviews->total() > 0
                    ? sprintf(
                        'Read %d client reviews and testimonials for Sortiq Solutions and see how our digital services support real business growth.',
                        $reviews->total()
                    )
                    : PageMeta::descriptionForRoute('frontend.reviews')
            ),
        ]);
    }

    public function show(string $slug): View|RedirectResponse
    {
        try {
            $review = Review::query()->where('slug', $slug)->first();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('frontend.reviews');
        }

        abort_unless($review && ($review->status === 'published' || auth()->check()), 404);

        try {
            $review->increment('views');
            $review->refresh();

            $recentReviews = Review::query()
                ->published()
                ->whereKeyNot($review->getKey())
                ->ordered()
                ->limit(3)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $recentReviews = collect();
        }

        return view('frontend.reviews.show', [
            'review' => $review,
            'recentReviews' => $recentReviews,
            'pageMeta' => PageMeta::article(
                $review->summary ?: $review->content,
                null,
                "{$review->name} Review | Sortiq Solutions"
            ),
        ]);
    }
}
