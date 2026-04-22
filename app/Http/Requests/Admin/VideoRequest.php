<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Generate slug if not provided
        $slug = $this->input('slug') ?: Str::slug($this->input('title'));

        $this->merge([
            'slug' => $slug,
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:160',

            'slug' => [
                'required',
                'alpha_dash',
                'max:180',
                Rule::unique('videos', 'slug')
                    ->ignore($this->route('video')),
            ],

            'youtube_url' => 'required|url|max:255',
            'thumbnail' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:500',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'sort_order' => 'required|integer|min:0|max:9999',
        ];
    }
}