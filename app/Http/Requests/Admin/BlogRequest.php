<?php

namespace App\Http\Requests\Admin;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title')),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'slug' => [
                'required',
                'alpha_dash:ascii',
                'max:180',
                Rule::unique('blogs', 'slug')->ignore($this->route('blog')),
            ],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'file', 'mimes:webp,png,jpg,jpeg', 'max:4096'],
            'category' => ['nullable', Rule::in(Blog::CATEGORIES)],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:20', 'max:8000'],
            'published_at' => ['required', 'date'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function attributes(): array
    {
        return [
            'published_at' => 'publish date',
        ];
    }
}
