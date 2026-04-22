<?php

namespace App\Support\Seo;

use Illuminate\Support\Str;

class PageMeta
{
    public function __construct(
        public readonly string $description,
        public readonly string $image,
        public readonly string $type = 'website',
    ) {
    }

    public static function forRoute(?string $routeName): self
    {
        return new self(
            description: config("seo.descriptions.{$routeName}", config('seo.default_description')),
            image: asset(config('seo.default_image')),
        );
    }

    public static function custom(string $description, ?string $image = null, string $type = 'website'): self
    {
        return new self(
            description: trim($description),
            image: $image ?: asset(config('seo.default_image')),
            type: $type,
        );
    }

    public static function article(?string $text, ?string $image = null): self
    {
        return new self(
            description: Str::limit(strip_tags((string) $text), 155),
            image: $image ?: asset(config('seo.default_image')),
            type: 'article',
        );
    }
}
