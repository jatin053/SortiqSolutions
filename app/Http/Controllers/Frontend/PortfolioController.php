<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Support\Seo\PageMeta;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->published()
            ->ordered()
            ->get();

        $categories = $portfolios
            ->map(fn (Portfolio $portfolio) => [
                'slug' => $portfolio->category_slug,
                'name' => $portfolio->category_name,
            ])
            ->unique('slug')
            ->values();

        $portfolioItems = $portfolios->map(function (Portfolio $portfolio) {
            return [
                'id' => $portfolio->getKey(),
                'title' => $portfolio->title,
                'slug' => $portfolio->slug,
                'summary' => $portfolio->summary,
                'content' => $portfolio->content,
                'featured_media_url' => $portfolio->image_url,
                'website_url' => $portfolio->website_href,
                'categories' => [[
                    'name' => $portfolio->category_name,
                    'slug' => $portfolio->category_slug,
                ]],
            ];
        });

        return view('frontend.portfolio.portfolio-page', [
            'pageMeta' => PageMeta::custom(sprintf(
                'Explore %d Sortiq Solutions portfolio projects in web design, development, e-commerce, and digital experiences built for growing businesses.',
                $portfolios->count()
            )),
            'portfolioItems' => $portfolioItems,
            'portfolioCategories' => $categories,
        ]);
    }
}
