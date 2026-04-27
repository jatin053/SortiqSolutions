<form action="{{ $action }}" method="post" class="blog-form" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    @php
        $title = old('title', $blog['title']);
        $slug = old('slug', $blog['slug']);
        $content = old('content', $blog['content']);
        $image = old('image', $blog['image']);
        $categoryValue = old('category', $blog['category']);
        $publishedAt = old('published_at', $blog->published_at?->format('Y-m-d'));
        $excerpt = old('excerpt', $blog['excerpt']);
    @endphp

    <div class="review-edit-grid blog-edit-grid">
        <section class="review-editor-main">
            <label class="screen-reader-text" for="blog-title">Blog title</label>
            <input
                id="blog-title"
                class="title-input @error('title') is-invalid @enderror"
                name="title"
                type="text"
                value="{{ $title }}"
                placeholder="Enter blog title"
            >
            @error('title')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <p class="permalink">
                Permalink:
                <a href="{{ $permalink }}">{{ $permalink }}</a>
            </p>

            <input type="hidden" name="slug" value="{{ $slug }}">

            <div class="classic-editor">
                <div class="editor-media">
                    <span class="small-btn">Content</span>
                </div>

                <div class="editor-toolbar">
                    <select aria-label="Text style">
                        <option>Paragraph</option>
                    </select>
                    <button type="button">B</button>
                    <button type="button"><em>I</em></button>
                    <button type="button">&#8226;</button>
                    <button type="button">1.</button>
                    <button type="button">&ldquo;</button>
                    <button type="button">&#8801;</button>
                    <button type="button">&#128279;</button>
                    <button type="button">&#9636;</button>
                </div>

                <textarea
                    class="review-content blog-content @error('content') is-invalid @enderror"
                    name="content"
                    aria-label="Blog content"
                >{{ $content }}</textarea>

                <div class="editor-footer">
                    <span>Word count: {{ str_word_count($content) }}</span>
                    <span>Blog article content</span>
                </div>
            </div>
            @error('content')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </section>

        <aside class="review-side">
            @include('admin.blogs.partials.publish-box', [
                'blog' => $blog,
                'submitLabel' => $submitLabel,
            ])

            <div class="meta-box">
                <div class="meta-title">Blog Details</div>
                <div class="meta-body review-fields blog-fields">
                    <label>
                        Featured Image
                        <input type="hidden" name="image" value="{{ $image }}">
                        <input
                            class="@error('image_file') is-invalid @enderror"
                            name="image_file"
                            type="file"
                            accept="image/webp,image/png,image/jpeg"
                        >
                        <span class="field-help">Upload a local blog image. The current image stays in place until you replace it.</span>
                        @error('image_file')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    @if ($blog->image_url)
                        <p class="current-logo-path">
                            Current file: <strong>{{ $blog['image'] }}</strong>
                        </p>
                    @endif

                    <label>
                        Category
                        <select name="category" class="@error('category') is-invalid @enderror">
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected($categoryValue === $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Publish Date
                        <input
                            class="@error('published_at') is-invalid @enderror"
                            name="published_at"
                            type="date"
                            value="{{ $publishedAt }}"
                        >
                        @error('published_at')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Short Description
                        <textarea
                            class="@error('excerpt') is-invalid @enderror"
                            name="excerpt"
                            placeholder="Short line shown in blog cards"
                        >{{ $excerpt }}</textarea>
                        @error('excerpt')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </aside>
    </div>
</form>
