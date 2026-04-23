<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Throwable;

class PortfolioController extends Controller
{
    private const PORTFOLIOS_PER_PAGE = 6;

    public function index(Request $request): View
    {
        $activeCategory = trim((string) $request->query('category'));
        $portfolioCategories = $this->portfolioCategories();

        if ($activeCategory !== '' && ! $this->categoryExists($portfolioCategories, $activeCategory)) {
            $activeCategory = '';
        }

        $portfolioPaginator = $this->portfolioPaginator($activeCategory);

        return view('frontend.portfolio.portfolio-page', [
            'activePortfolioCategory' => $activeCategory,
            'portfolioItems' => $this->portfolioItems($portfolioPaginator),
            'portfolioCategories' => $portfolioCategories,
            'portfolioPaginator' => $portfolioPaginator,
        ]);
    }

    private function portfolioCategories()
    {
        try {
            return Portfolio::query()
                ->published()
                ->ordered()
                ->get()
                ->map(fn (Portfolio $portfolio) => [
                    'slug' => $portfolio->category_slug,
                    'name' => $portfolio->category_name,
                ])
                ->filter(fn (array $category) => filled($category['slug']) && filled($category['name']))
                ->unique('slug')
                ->values();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function categoryExists($portfolioCategories, string $activeCategory): bool
    {
        return $portfolioCategories->contains(
            fn (array $category) => $category['slug'] === $activeCategory
        );
    }

    private function portfolioPaginator(string $activeCategory): LengthAwarePaginator
    {
        try {
            $portfolioQuery = Portfolio::query()
                ->published()
                ->ordered();

            if ($activeCategory !== '') {
                $portfolioQuery->where('category_slug', $activeCategory);
            }

            return $portfolioQuery
                ->paginate(self::PORTFOLIOS_PER_PAGE)
                ->withQueryString();
        } catch (Throwable $exception) {
            report($exception);

            return $this->emptyPortfolioPaginator();
        }
    }

    private function portfolioItems(LengthAwarePaginator $portfolioPaginator)
    {
        return collect($portfolioPaginator->items())
            ->map(function (Portfolio $portfolio) {
                return [
                    'id' => $portfolio->getKey(),
                    'title' => $portfolio->title,
                    'slug' => $portfolio->slug,
                    'summary' => $portfolio->summary,
                    'content' => $portfolio->content,
                    'featured_media_url' => $portfolio->image_url,
                    'website_url' => $portfolio->website_href,
                    'category_name' => $portfolio->category_name,
                    'category_slug' => $portfolio->category_slug,
                ];
            })
            ->values();
    }

    private function emptyPortfolioPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            collect(),
            0,
            self::PORTFOLIOS_PER_PAGE,
            Paginator::resolveCurrentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}
