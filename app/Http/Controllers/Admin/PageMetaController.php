<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageMetaSettingRequest;
use App\Models\SiteLayoutSetting;
use App\Support\Seo\PageMeta;
use App\Support\Seo\SeoPageCatalog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class PageMetaController extends Controller
{
    public function edit(Request $request): View
    {
        $selectedPage = $this->selectedPage($request->query('page'));

        return view('admin.pages.seo-settings', [
            'pageOptions' => $this->pageOptions(),
            'pageSections' => $this->pageSections($selectedPage),
            'selectedPage' => $selectedPage,
            'selectedPageDetails' => $this->selectedPageDetails($selectedPage),
            'allPages' => $this->allPagesWithMeta(),
            'xmlUrls' => $this->getXmlUrls(),
        ]);
    }

    public function update(PageMetaSettingRequest $request): RedirectResponse
    {
        $setting = SiteLayoutSetting::main();
        $data = is_array($setting->data) ? $setting->data : [];
        $selectedPage = $this->selectedPage($request->validated('selected_page'));
        $storedPageMeta = is_array($data['page_meta'] ?? null) ? $data['page_meta'] : [];

        $data['page_meta'] = $this->pageMetaForStorage(
            $request->validated('pages', []),
            $storedPageMeta
        );

        $setting->update([
            'data' => $data,
        ]);

        PageMeta::clearCache();

        $returnView = $request->input('return_view');

        return redirect()
            ->route('admin.pages.edit', array_filter([
                'page' => $selectedPage,
                'view' => $returnView,
            ]))
            ->with('status', 'Page metadata updated successfully.');
    }

    public function toggleSitemap(Request $request): RedirectResponse
    {
        $request->validate([
            'route_name' => ['required', 'string', \Illuminate\Validation\Rule::in(SeoPageCatalog::routeNames())],
        ]);

        $routeName = $request->input('route_name');
        
        $setting = SiteLayoutSetting::main();
        $data = is_array($setting->data) ? $setting->data : [];
        if (!isset($data['page_meta'])) {
            $data['page_meta'] = [];
        }
        if (!isset($data['page_meta'][$routeName])) {
            $defaults = SeoPageCatalog::defaultMetaMap()[$routeName] ?? [
                'title' => '',
                'description' => '',
                'keywords' => '',
            ];
            $data['page_meta'][$routeName] = $defaults;
        }

        // Toggle the boolean
        $current = $data['page_meta'][$routeName]['exclude_sitemap'] ?? false;
        $data['page_meta'][$routeName]['exclude_sitemap'] = !$current;

        $setting->update([
            'data' => $data,
        ]);

        PageMeta::clearCache();

        $actionWord = !$current ? 'excluded from' : 'included in';
        return redirect()
            ->back()
            ->with('status', "Page successfully {$actionWord} the XML sitemap.");
    }

    private function allPagesWithMeta(): array
    {
        $storedPageMeta = $this->storedPageMeta();
        $pages = [];

        foreach (SeoPageCatalog::pages() as $page) {
            $routeName = $page['route_name'];
            $storedValues = $this->storedValuesForRoute($storedPageMeta, $routeName);

            $pages[] = [
                ...$page,
                'path' => $this->pathForRoute($routeName),
                'title' => trim((string) ($storedValues['title'] ?? '')) ?: $page['title'],
                'description' => trim((string) ($storedValues['description'] ?? '')) ?: $page['description'],
                'keywords' => trim((string) ($storedValues['keywords'] ?? '')) ?: $page['keywords'],
                'exclude_sitemap' => (bool) ($storedValues['exclude_sitemap'] ?? false),
            ];
        }

        return $pages;
    }

    private function pageSections(?string $selectedPage = null): array
    {
        if ($selectedPage === null) {
            return [];
        }

        $storedPageMeta = $this->storedPageMeta();
        $pageSections = [];
        $pageIndex = 0;

        foreach (SeoPageCatalog::pages() as $page) {
            $routeName = $page['route_name'];

            if ($routeName !== $selectedPage) {
                continue;
            }

            $storedValues = $this->storedValuesForRoute($storedPageMeta, $routeName);
            $sectionName = $page['section'];

            $pageSections[$sectionName][] = [
                ...$page,
                'input_index' => $pageIndex,
                'path' => $this->pathForRoute($routeName),
                'title' => trim((string) ($storedValues['title'] ?? '')) ?: $page['title'],
                'description' => trim((string) ($storedValues['description'] ?? '')) ?: $page['description'],
                'keywords' => trim((string) ($storedValues['keywords'] ?? '')) ?: $page['keywords'],
            ];

            $pageIndex++;
        }

        return $pageSections;
    }

    private function pageOptions(): array
    {
        $pageOptions = [];

        foreach (SeoPageCatalog::pages() as $page) {
            $pageOptions[] = [
                'section' => $page['section'],
                'label' => $page['label'],
                'route_name' => $page['route_name'],
                'path' => $this->pathForRoute($page['route_name']),
            ];
        }

        return $pageOptions;
    }

    private function selectedPageDetails(?string $selectedPage): ?array
    {
        if ($selectedPage === null) {
            return null;
        }

        foreach ($this->pageOptions() as $pageOption) {
            if ($pageOption['route_name'] === $selectedPage) {
                return $pageOption;
            }
        }

        return null;
    }

    private function storedPageMeta(): array
    {
        try {
            $setting = SiteLayoutSetting::main();

            if (! is_array($setting->data)) {
                return [];
            }

            return is_array($setting->data['page_meta'] ?? null)
                ? $setting->data['page_meta']
                : [];
        } catch (\Throwable $e) {
            logger()->warning('Database query failed in PageMetaController@storedPageMeta: ' . $e->getMessage());
            return [];
        }
    }

    private function storedValuesForRoute(array $storedPageMeta, string $routeName): array
    {
        return is_array($storedPageMeta[$routeName] ?? null)
            ? $storedPageMeta[$routeName]
            : [];
    }

    private function pageMetaForStorage(array $pages, array $storedPageMeta): array
    {
        $pageMeta = $storedPageMeta;

        foreach ($pages as $page) {
            $routeName = $page['route_name'];

            $pageMeta[$routeName] = [
                'title' => trim((string) ($page['title'] ?? '')),
                'description' => trim((string) ($page['description'] ?? '')),
                'keywords' => trim((string) ($page['keywords'] ?? '')),
            ];
        }

        return $pageMeta;
    }

    private function selectedPage(?string $selectedPage): ?string
    {
        if (! is_string($selectedPage) || $selectedPage === '') {
            return null;
        }

        return in_array($selectedPage, SeoPageCatalog::routeNames(), true)
            ? $selectedPage
            : null;
    }

    private function pathForRoute(string $routeName): string
    {
        try {
            return route($routeName, [], false);
        } catch (Throwable $exception) {
            return '/';
        }
    }

    public function toggleSitemapUrl(Request $request): RedirectResponse
    {
        $request->validate([
            'path' => ['required', 'string'],
        ]);

        $path = '/' . ltrim($request->input('path'), '/');

        $setting = SiteLayoutSetting::main();
        $data = is_array($setting->data) ? $setting->data : [];
        if (!isset($data['blocked_sitemap_urls'])) {
            $data['blocked_sitemap_urls'] = [];
        }

        $blockedUrls = $data['blocked_sitemap_urls'];
        $index = array_search($path, $blockedUrls);

        if ($index === false) {
            // Block it: add to blocked list
            $blockedUrls[] = $path;
            $actionWord = 'blocked from';
        } else {
            // Unblock it: remove from blocked list
            array_splice($blockedUrls, $index, 1);
            $actionWord = 'included in';
        }
        $data['blocked_sitemap_urls'] = $blockedUrls;

        // Also if it matches any static route, synchronize its page_meta exclude_sitemap state
        $registeredRoutes = \Illuminate\Support\Facades\Route::getRoutes()->getRoutes();
        foreach ($registeredRoutes as $route) {
            $name = $route->getName();
            if ($name && str_starts_with($name, 'frontend.')) {
                $uri = '/' . trim($route->uri(), '/');
                if ($uri === $path) {
                    if (!isset($data['page_meta'])) {
                        $data['page_meta'] = [];
                    }
                    if (!isset($data['page_meta'][$name])) {
                        $defaults = SeoPageCatalog::defaultMetaMap()[$name] ?? [
                            'title' => '',
                            'description' => '',
                            'keywords' => '',
                        ];
                        $data['page_meta'][$name] = $defaults;
                    }
                    $data['page_meta'][$name]['exclude_sitemap'] = ($index === false);
                }
            }
        }

        $setting->update([
            'data' => $data,
        ]);

        PageMeta::clearCache();

        return redirect()
            ->back()
            ->with('status', "URL '{$path}' successfully {$actionWord} the XML sitemap.");
    }

    private function getXmlUrls(): array
    {
        $urls = [];
        $registeredRoutes = \Illuminate\Support\Facades\Route::getRoutes()->getRoutes();

        // Load settings
        try {
            $setting = SiteLayoutSetting::main();
            $data = is_array($setting->data) ? $setting->data : [];
            $storedPageMeta = $data['page_meta'] ?? [];
            $blockedUrls = $data['blocked_sitemap_urls'] ?? [];
        } catch (\Throwable $e) {
            $storedPageMeta = [];
            $blockedUrls = [];
        }

        foreach ($registeredRoutes as $route) {
            $name = $route->getName();
            if (!$name || !str_starts_with($name, 'frontend.') || !in_array('GET', $route->methods())) {
                continue;
            }

            $uri = $route->uri();
            $cleanUri = trim($uri, '/');

            // Skip any route that looks like a backend, admin, auth, or API route
            if (
                str_starts_with($cleanUri, 'sortiqadmin') ||
                str_starts_with($cleanUri, 'admin') ||
                str_starts_with($cleanUri, 'api') ||
                in_array($cleanUri, ['login', 'logout', 'register']) ||
                str_contains($cleanUri, 'password/')
            ) {
                continue;
            }

            // Skip routes with parameters (like blog/{slug})
            if (str_contains($uri, '{')) {
                continue;
            }

            // Skip json feeds
            if (str_ends_with($uri, '.json')) {
                continue;
            }

            $path = '/' . $cleanUri;

            // Check if blocked either by route name or by path/URL
            $isBlocked = ($storedPageMeta[$name]['exclude_sitemap'] ?? false) || in_array($path, $blockedUrls);

            // Find label if in catalog
            $label = $name;
            $section = 'Static Page';
            foreach (SeoPageCatalog::pages() as $p) {
                if ($p['route_name'] === $name) {
                    $label = $p['label'];
                    $section = $p['section'];
                    break;
                }
            }

            $storedValues = $this->storedValuesForRoute($storedPageMeta, $name);
            $defaultTitle = $label;
            $defaultDescription = '';
            $defaultKeywords = '';
            foreach (SeoPageCatalog::pages() as $p) {
                if ($p['route_name'] === $name) {
                    $defaultTitle = $p['title'];
                    $defaultDescription = $p['description'];
                    $defaultKeywords = $p['keywords'] ?? '';
                    break;
                }
            }
            $staticTitle = trim((string) ($storedValues['title'] ?? '')) ?: $defaultTitle;
            $staticDescription = trim((string) ($storedValues['description'] ?? '')) ?: $defaultDescription;
            $staticKeywords = trim((string) ($storedValues['keywords'] ?? '')) ?: $defaultKeywords;

            $urls[] = [
                'type' => 'static',
                'route_name' => $name,
                'label' => $label,
                'section' => $section,
                'path' => $path,
                'exclude_sitemap' => $isBlocked,
                'title' => $staticTitle,
                'description' => $staticDescription,
                'keywords' => $staticKeywords,
            ];
        }

        // Add blogs
        try {
            $blogs = \App\Models\Blog::query()
                ->published()
                ->whereNotNull('slug')
                ->get(['id', 'title', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'excerpt']);

            foreach ($blogs as $blog) {
                $path = '/blog/' . $blog->slug;
                $isBlocked = in_array($path, $blockedUrls);

                $urls[] = [
                    'type' => 'blog',
                    'route_name' => 'frontend.blog.show',
                    'label' => $blog->title,
                    'section' => 'Blog Post',
                    'path' => $path,
                    'exclude_sitemap' => $isBlocked,
                    'blog_slug' => $blog->slug,
                    'title' => trim((string) ($blog->meta_title ?? '')) ?: $blog->title,
                    'description' => trim((string) ($blog->meta_description ?? '')) ?: $blog->excerpt,
                    'keywords' => trim((string) ($blog->meta_keywords ?? '')) ?: '',
                ];
            }
        } catch (\Throwable $e) {
            // Ignore
        }

        return $urls;
    }
}
