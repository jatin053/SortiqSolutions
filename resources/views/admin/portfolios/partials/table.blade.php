<div class="reviews-table-wrap">
    <table class="reviews-table blog-table">
        <thead>
            <tr>
                <th class="blog-image-column">Image</th>
                <th class="title-column">Project</th>
                <th>Category</th>
                <th>Status</th>
                <th>Published</th>
                <th class="count-column">Order</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($portfolios as $portfolio)
                <tr>
                    <td>
                        @if ($portfolio->image_url)
                            <img class="blog-thumb" src="{{ $portfolio->image_url }}" alt="{{ $portfolio['title'] }}">
                        @else
                            <span class="blog-thumb blog-thumb-empty">No Image</span>
                        @endif
                    </td>
                    <td class="blog-title-cell">
                        <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="review-title">
                            {{ $portfolio['title'] }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}">Edit</a>
                            <span>|</span>
                            <a href="{{ url('portfolio#' . $portfolio['slug']) }}" target="_blank" rel="noopener">View</a>
                            @if ($portfolio->website_href)
                                <span>|</span>
                                <a href="{{ $portfolio->website_href }}" target="_blank" rel="noopener">Project</a>
                            @endif
                        </div>
                    </td>
                    <td>{{ $portfolio['category_name'] }}</td>
                    <td>
                        <span class="status-pill {{ $portfolio['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}">
                            {{ ucfirst($portfolio['status']) }}
                        </span>
                    </td>
                    <td>{{ $portfolio['published_label'] }}</td>
                    <td class="count-column">{{ $portfolio['sort_order'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state-cell">No portfolio projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
