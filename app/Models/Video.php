<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'youtube_url',
        'thumbnail',
        'summary',
        'published_at',
        'status',
        'sort_order',
        'views',
    ];

    protected $casts = [
        'published_at' => 'date',
        'sort_order' => 'integer',
        'views' => 'integer',
    ];

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
        $query->orderBy('sort_order', 'asc');
        $query->orderBy('published_at', 'desc');
        $query->orderBy('id', 'desc');

        return $query;
    }

    public function getYoutubeIdAttribute(): ?string
    {
        $url = trim((string) $this->youtube_url);

        if ($url === '') {
            return null;
        }

        $pattern = '~(?:youtu\.be/|youtube\.com/watch\?v=|youtube\.com/embed/)([^&?/]+)~';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->youtube_id) {
            return 'https://www.youtube.com/embed/' . $this->youtube_id;
        }

        return null;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->thumbnail) {
            if (
                Str::startsWith($this->thumbnail, 'http://') ||
                Str::startsWith($this->thumbnail, 'https://')
            ) {
                return $this->thumbnail;
            }

            return asset($this->thumbnail);
        }

        if ($this->youtube_id) {
            return 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg';
        }

        return null;
    }

    public function getPublishedLabelAttribute(): string
    {
        if ($this->published_at) {
            return $this->published_at->format('Y/m/d \a\t g:i a');
        }

        return 'Not published';
    }
}