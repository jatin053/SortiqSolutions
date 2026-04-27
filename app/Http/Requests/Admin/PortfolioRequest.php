<?php

namespace App\Http\Requests\Admin;

use App\Models\Portfolio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $categorySlug = $this->category_slug;
        $categoryName = Portfolio::CATEGORY_OPTIONS[$categorySlug] ?? $this->category_name;

        $slug = $this->slug ? $this->slug : Str::slug($this->title);

        $this->merge([
            'slug' => $slug,
            'category_name' => $categoryName ? trim($categoryName) : null,
            'summary' => $this->summary ? trim($this->summary) : null,
            'content' => $this->content ? trim($this->content) : null,
            'image' => $this->image ? trim($this->image) : null,
            'website_url' => $this->website_url ? trim($this->website_url) : null,
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
                Rule::unique('portfolios', 'slug')->ignore($this->route('portfolio')),
            ],

            'category_slug' => [
                'required',
                Rule::in(array_keys(Portfolio::CATEGORY_OPTIONS)),
            ],

            'category_name' => 'required|string|max:120',

            'image' => 'required_without:image_file|string|max:255',
            'image_file' => 'nullable|file|mimes:webp,png,jpg,jpeg|max:4096',

            'website_url' => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $url = trim((string) $value);

                    if ($url === '') {
                        return;
                    }

                    if (filter_var($url, FILTER_VALIDATE_URL)) {
                        return;
                    }

                    if (Str::startsWith($url, '/')) {
                        return;
                    }

                    $fail('The project URL must be a full URL or a site-relative path starting with "/".');
                },
            ],

            'summary' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'sort_order' => 'required|integer|min:0|max:9999',
        ];
    }
}
