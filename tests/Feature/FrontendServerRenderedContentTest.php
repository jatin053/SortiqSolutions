<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendServerRenderedContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_latest_insights_from_the_database(): void
    {
        Blog::query()->create([
            'title' => 'Fresh Insight',
            'slug' => 'fresh-insight',
            'category' => 'Technology',
            'excerpt' => 'Fresh insight excerpt.',
            'content' => 'Fresh insight content.',
            'published_at' => '2026-04-22',
            'status' => 'published',
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertSee('Latest Insights')
            ->assertSee('Fresh Insight');
    }

    public function test_support_page_renders_testimonials_from_published_reviews(): void
    {
        Review::query()->create([
            'name' => 'Ava Brooks',
            'slug' => 'ava-brooks-review',
            'platform' => 'Upwork',
            'rating' => 5,
            'published_at' => '2026-04-22',
            'status' => 'published',
            'content' => 'Support page testimonial from the database.',
            'summary' => 'Support page testimonial.',
        ]);

        $response = $this->get('/support');

        $response->assertOk()
            ->assertSee('Client Success Stories')
            ->assertSee('Ava Brooks')
            ->assertSee('Support page testimonial from the database.');
    }
}
