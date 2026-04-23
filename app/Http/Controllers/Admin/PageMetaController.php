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

        return redirect()
            ->route('admin.pages.edit', array_filter([
                'page' => $selectedPage,
            ]))
            ->with('status', 'Page metadata updated successfully.');
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
                'title' => trim((string) ($storedValues['title'] ?? $page['title'])),
                'description' => trim((string) ($storedValues['description'] ?? $page['description'])),
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
        $setting = SiteLayoutSetting::main();

        if (! is_array($setting->data)) {
            return [];
        }

        return is_array($setting->data['page_meta'] ?? null)
            ? $setting->data['page_meta']
            : [];
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
}
