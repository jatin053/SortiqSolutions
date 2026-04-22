<div class="reviews-table-wrap">
    <table class="reviews-table videos-table">
        <thead>
            <tr>
                <th class="video-thumb-column">Preview</th>
                <th class="title-column">Title</th>
                <th>Published</th>
                <th>Status</th>
                <th class="count-column">Order</th>
                <th class="count-column">Views</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $video)
                <tr>
                    <td>
                        <div class="video-admin-thumb">
                            @if ($video->thumbnail_url)
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video['title'] }}">
                            @else
                                <span>No Preview</span>
                            @endif
                        </div>
                    </td>
                    <td class="review-title-cell">
                        <a href="{{ route('admin.videos.show', $video['slug']) }}" class="review-title">
                            {{ $video['title'] }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.videos.edit', $video['slug']) }}">Edit</a>
                            <span>|</span>
                            <a href="{{ url('videos#' . $video['slug']) }}" target="_blank" rel="noopener">View</a>
                        </div>
                    </td>
                    <td>{{ $video['published_label'] }}</td>
                    <td><span class="status-pill {{ $video['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}">{{ ucfirst($video['status']) }}</span></td>
                    <td class="count-column">{{ $video['sort_order'] }}</td>
                    <td class="count-column">{{ $video['views'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state-cell">No videos found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
