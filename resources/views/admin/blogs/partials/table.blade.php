<div class="reviews-table-wrap">
    <table class="reviews-table blog-table">
        <thead>
            <tr>
                <th class="blog-image-column">Image</th>
                <th class="title-column">Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Published</th>
                <th class="count-column">Views</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blogs as $blog)
                <tr>
                    <td>
                        @if ($blog->image_url)
                            <img class="blog-thumb" src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}">
                        @else
                            <span class="blog-thumb blog-thumb-empty">No Image</span>
                        @endif
                    </td>
                    <td class="blog-title-cell">
                        <a href="{{ route('admin.blogs.show', $blog['slug']) }}" class="review-title">
                            {{ $blog['title'] }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.blogs.edit', $blog['slug']) }}">Edit</a>
                            <span>|</span>
                            <a href="{{ route('frontend.blog.show', $blog['slug']) }}" target="_blank" rel="noopener">View</a>
                        </div>
                    </td>
                    <td>{{ $blog['category'] ?: 'Uncategorized' }}</td>
                    <td>
                        <span class="status-pill {{ $blog['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}">{{ ucfirst($blog['status']) }}</span>
                    </td>
                    <td>
                        {{ $blog['published_label'] }}
                    </td>
                    <td class="count-column">{{ $blog['views'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state-cell">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

