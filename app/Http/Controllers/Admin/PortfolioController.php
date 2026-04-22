<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');

        if ($status !== 'draft' && $status !== 'published') {
            $status = null;
        }

        $query = Portfolio::query();

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('category_name', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        $tabQuery = clone $query;

        if ($status) {
            $query->where('status', $status);
        }

        $portfolios = $query
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Portfolio::count(),
            'published' => Portfolio::where('status', 'published')->count(),
            'draft' => Portfolio::where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => $tabQuery->count(),
            'published' => (clone $tabQuery)->where('status', 'published')->count(),
            'draft' => (clone $tabQuery)->where('status', 'draft')->count(),
        ];

        return view('admin.portfolios.portfolio-list', [
            'portfolios' => $portfolios,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function create(): View
    {
        $defaultCategorySlug = array_key_first(Portfolio::CATEGORY_OPTIONS);
        $defaultCategoryName = Portfolio::CATEGORY_OPTIONS[$defaultCategorySlug];

        $portfolio = new Portfolio([
            'status' => 'published',
            'published_at' => now(),
            'sort_order' => 0,
            'category_slug' => $defaultCategorySlug,
            'category_name' => $defaultCategoryName,
        ]);

        return view('admin.portfolios.create-portfolio', [
            'portfolio' => $portfolio,
            'categories' => Portfolio::CATEGORY_OPTIONS,
            'permalink' => $this->getPermalink($portfolio),
        ]);
    }

    public function store(PortfolioRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $portfolio = Portfolio::create($data);

        return redirect()
            ->route('admin.portfolios.edit', $portfolio)
            ->with('status', 'Portfolio created successfully.');
    }

    public function show(Portfolio $portfolio): View
    {
        return view('admin.portfolios.portfolio-details', [
            'portfolio' => $portfolio,
        ]);
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolios.edit-portfolio', [
            'portfolio' => $portfolio,
            'categories' => Portfolio::CATEGORY_OPTIONS,
            'permalink' => $this->getPermalink($portfolio),
        ]);
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->validated();

        $portfolio->update($data);

        return redirect()
            ->route('admin.portfolios.edit', $portfolio)
            ->with('status', 'Portfolio updated successfully.');
    }

    private function getPermalink(Portfolio $portfolio): string
    {
        $slug = $portfolio->slug;

        if (empty($slug)) {
            $slug = Str::slug($portfolio->title ?: 'new-portfolio');
        }

        return url('portfolio#' . $slug);
    }
}
