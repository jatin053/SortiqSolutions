<form action="{{ $action }}" method="post" class="video-form admin-entry-form" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <input type="hidden" name="slug" value="{{ old('slug', $video['slug']) }}">

    <div class="admin-entry-grid">
        <div class="admin-entry-stack">
            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Content</span>
                    <h3>Video basics</h3>
                </div>

                <div class="admin-subpanel-body">
                    <label class="admin-form-field" for="video-title">
                        <span>Title</span>
                        <input
                            id="video-title"
                            class="title-input @error('title') is-invalid @enderror"
                            name="title"
                            type="text"
                            value="{{ old('title', $video['title']) }}"
                            placeholder="Enter video title"
                        >
                    </label>
                    @error('title')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <div class="admin-permalink-box">
                        <span>Permalink</span>
                        <a href="{{ $permalink }}">{{ $permalink }}</a>
                    </div>

                    <label class="admin-form-field">
                        <span>Short Description</span>
                        <textarea
                            class="@error('summary') is-invalid @enderror"
                            name="summary"
                            rows="7"
                            placeholder="Short description shown for admin reference"
                        >{{ old('summary', $video['summary']) }}</textarea>
                    </label>
                    @error('summary')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Preview</span>
                    <h3>Thumbnail preview</h3>
                </div>

                <div class="admin-subpanel-body">
                    <div class="admin-media-preview">
                        @if ($video->thumbnail_url)
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video['title'] ?: 'Video preview' }}">
                        @else
                            <span class="admin-detail-placeholder">No preview available</span>
                        @endif
                    </div>

                    <p class="admin-microcopy">
                        The preview uses the custom thumbnail when available, otherwise it falls back to the generated video thumbnail.
                    </p>
                </div>
            </section>
        </div>

        <div class="admin-entry-stack">
            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Publish</span>
                    <h3>Publishing settings</h3>
                </div>

                <div class="admin-subpanel-body">
                    <label class="admin-form-field">
                        <span>Status</span>
                        <select name="status" class="@error('status') is-invalid @enderror">
                            <option value="published" @selected(old('status', $video['status']) === 'published')>Published</option>
                            <option value="draft" @selected(old('status', $video['status']) === 'draft')>Draft</option>
                        </select>
                    </label>
                    @error('status')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <label class="admin-form-field">
                        <span>Publish Date</span>
                        <input
                            class="@error('published_at') is-invalid @enderror"
                            name="published_at"
                            type="date"
                            value="{{ old('published_at', $video->published_at?->format('Y-m-d')) }}"
                        >
                    </label>
                    @error('published_at')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <label class="admin-form-field">
                        <span>Display Order</span>
                        <input
                            class="@error('sort_order') is-invalid @enderror"
                            name="sort_order"
                            type="number"
                            min="0"
                            value="{{ old('sort_order', $video['sort_order']) }}"
                        >
                    </label>
                    @error('sort_order')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <div class="admin-key-value">
                        <div>
                            <span>Visibility</span>
                            <strong>Public</strong>
                        </div>
                        <div>
                            <span>Action</span>
                            <strong>{{ $submitLabel }}</strong>
                        </div>
                    </div>
                </div>
            </section>

            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Source</span>
                    <h3>Video links</h3>
                </div>

                <div class="admin-subpanel-body">
                    <label class="admin-form-field">
                        <span>YouTube URL</span>
                        <input
                            class="@error('youtube_url') is-invalid @enderror"
                            name="youtube_url"
                            type="url"
                            value="{{ old('youtube_url', $video['youtube_url']) }}"
                            placeholder="https://www.youtube.com/watch?v=..."
                        >
                    </label>
                    @error('youtube_url')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <label class="admin-form-field">
                        <span>Custom Thumbnail URL or Path</span>
                        <input
                            class="@error('thumbnail') is-invalid @enderror"
                            name="thumbnail"
                            type="text"
                            value="{{ old('thumbnail', $video['thumbnail']) }}"
                            placeholder="Optional custom thumbnail"
                        >
                    </label>
                    @error('thumbnail')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </section>
        </div>
    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.videos.index') }}" class="btn">Cancel</a>
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</form>
