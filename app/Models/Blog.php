<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    public const CATEGORIES = [
        'Company',
        'Web Design',
        'Development',
        'Digital Marketing',
        'Technology',
        'News',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'category',
        'excerpt',
        'content',
        'published_at',
        'status',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'views' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        $query->where('status', 'published');

        return $query;
    }

    public function scopeOrdered(Builder $query): Builder
    {
        $query->orderBy('published_at', 'desc');
        $query->orderBy('id', 'desc');

        return $query;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (
            Str::startsWith($this->image, 'http://') ||
            Str::startsWith($this->image, 'https://')
        ) {
            return $this->image;
        }

        return asset($this->image);
    }

    public function getPublishedLabelAttribute(): string
    {
        if ($this->published_at) {
            return $this->published_at->format('Y/m/d \a\t g:i a');
        }

        return 'Not published';
    }
}