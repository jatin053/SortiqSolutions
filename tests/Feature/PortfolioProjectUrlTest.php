<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioProjectUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_relative_project_urls_are_normalized_for_frontend_output(): void
    {
        $portfolio = Portfolio::query()->create([
            'title' => 'Flipbook Showcase',
            'slug' => 'flipbook-showcase',
            'category_name' => 'Laravel',
            'category_slug' => 'laravel',
            'image' => 'uploads/portfolio/flipbook-cover.jpg',
            'website_url' => '/flipbook/docs/index.html',
            'summary' => 'Interactive flipbook preview.',
            'content' => 'Open the live flipbook from the portfolio modal.',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 1,
        ]);

        $response = $this->get('/portfolio');

        $response->assertOk()
            ->assertViewHas('portfolioItems', function ($items) use ($portfolio): bool {
                $match = collect($items)->firstWhere('slug', $portfolio->slug);

                return is_array($match)
                    && ($match['website_url'] ?? null) === $portfolio->website_href
                    && ($match['title'] ?? null) === 'Flipbook Showcase';
            });
    }

    public function test_portfolio_model_builds_absolute_project_url_for_relative_paths(): void
    {
        $portfolio = new Portfolio([
            'website_url' => '/flipbook/docs/index.html',
        ]);

        $this->assertSame(url('flipbook/docs/index.html'), $portfolio->website_href);
    }

    public function test_portfolio_category_filter_is_applied_on_the_server(): void
    {
        Portfolio::query()->create([
            'title' => 'Laravel Showcase',
            'slug' => 'laravel-showcase',
            'category_name' => 'Laravel',
            'category_slug' => 'laravel',
            'image' => 'uploads/portfolio/laravel-showcase.jpg',
            'website_url' => '/portfolio/laravel-showcase',
            'summary' => 'Laravel project.',
            'content' => 'Laravel portfolio content.',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 1,
        ]);

        Portfolio::query()->create([
            'title' => 'Shopify Storefront',
            'slug' => 'shopify-storefront',
            'category_name' => 'Shopify',
            'category_slug' => 'shopify',
            'image' => 'uploads/portfolio/shopify-storefront.jpg',
            'website_url' => '/portfolio/shopify-storefront',
            'summary' => 'Shopify project.',
            'content' => 'Shopify portfolio content.',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 2,
        ]);

        $response = $this->get('/portfolio?category=laravel');

        $response->assertOk()
            ->assertViewHas('activePortfolioCategory', 'laravel')
            ->assertViewHas('portfolioItems', function ($items): bool {
                return collect($items)->pluck('slug')->all() === ['laravel-showcase'];
            })
            ->assertSee('Laravel Showcase')
            ->assertDontSee('Shopify Storefront');
    }
}
