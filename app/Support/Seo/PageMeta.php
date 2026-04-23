<?php

namespace App\Support\Seo;

use App\Models\SiteLayoutSetting;
use Illuminate\Support\Str;
use Throwable;

class PageMeta
{
    private static ?array $resolvedMetaMap = null;

    public function __construct(
        public readonly ?string $title,
        public readonly string $description,
        public readonly string $image,
        public readonly string $type = 'website',
    ) {
    }

    public static function forRoute(?string $routeName): self
    {
        return new self(
            title: self::titleForRoute($routeName),
            description: self::descriptionForRoute($routeName),
            image: asset(config('seo.default_image')),
        );
    }

    public static function titleForRoute(?string $routeName): ?string
    {
        if (! $routeName) {
            return null;
        }

        $title = trim((string) data_get(self::metaForRoute($routeName), 'title'));

        return $title !== '' ? $title : null;
    }

    public static function descriptionForRoute(?string $routeName): string
    {
        if (! $routeName) {
            return config('seo.default_description');
        }

        $description = trim((string) data_get(self::metaForRoute($routeName), 'description'));

        return $description !== '' ? $description : config('seo.default_description');
    }

    public static function custom(string $description, ?string $image = null, string $type = 'website', ?string $title = null): self
    {
        return new self(
            title: $title,
            description: trim($description),
            image: $image ?: asset(config('seo.default_image')),
            type: $type,
        );
    }

    public static function article(?string $text, ?string $image = null, ?string $title = null): self
    {
        return new self(
            title: $title,
            description: Str::limit(strip_tags((string) $text), 155),
            image: $image ?: asset(config('seo.default_image')),
            type: 'article',
        );
    }

    public static function clearCache(): void
    {
        self::$resolvedMetaMap = null;
    }

    private static function metaForRoute(string $routeName): array
    {
        return self::resolvedMetaMap()[$routeName] ?? [];
    }

    private static function resolvedMetaMap(): array
    {
        if (self::$resolvedMetaMap !== null) {
            return self::$resolvedMetaMap;
        }

        $metaMap = SeoPageCatalog::defaultMetaMap();

        try {
            $setting = SiteLayoutSetting::query()
                ->where('key', SiteLayoutSetting::MAIN_KEY)
                ->first();

            $overrides = is_array($setting?->data)
                ? ($setting->data['page_meta'] ?? [])
                : [];
        } catch (Throwable $exception) {
            $overrides = [];
        }

        foreach ($overrides as $routeName => $meta) {
            if (! is_array($meta) || ! array_key_exists($routeName, $metaMap)) {
                continue;
            }

            $title = trim((string) ($meta['title'] ?? ''));
            $description = trim((string) ($meta['description'] ?? ''));

            if ($title !== '') {
                $metaMap[$routeName]['title'] = $title;
            }

            if ($description !== '') {
                $metaMap[$routeName]['description'] = $description;
            }
        }

        return self::$resolvedMetaMap = $metaMap;
    }
}
