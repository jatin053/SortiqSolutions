<?php

namespace App\Support\Seo;

use Illuminate\Support\Str;

class PageMeta
{
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
        return $routeName ? (config('seo.titles')[$routeName] ?? null) : null;
    }

    public static function descriptionForRoute(?string $routeName): string
    {
        return $routeName
            ? (config('seo.descriptions')[$routeName] ?? config('seo.default_description'))
            : config('seo.default_description');
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
}
