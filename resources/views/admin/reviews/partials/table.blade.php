<div class="reviews-table-wrap">
    <table class="reviews-table">
        <thead>
            <tr>
                <th class="title-column">Customer</th>
                <th>Platform</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Published</th>
                <th class="count-column">Views</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr>
                    <td class="review-title-cell">
                        <a href="{{ route('admin.reviews.show', $review) }}" class="review-title">
                            {{ $review->name }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.reviews.edit', $review) }}">Edit</a>
                            <span>|</span>
                            <a href="{{ route('frontend.reviews.show', $review) }}" target="_blank" rel="noopener">View</a>
                        </div>
                    </td>
                    <td>{{ $review->platform }}</td>
                    <td>
                        <span class="stars" aria-label="{{ $review->rating }} star rating">
                            @for ($star = 0; $star < $review->rating; $star++)
                                &#9733;
                            @endfor
                        </span>
                    </td>
                    <td><span class="status-pill {{ $review->status === 'published' ? 'status-pill-success' : 'status-pill-muted' }}">{{ ucfirst($review->status) }}</span></td>
                    <td>{{ $review->published_label }}</td>
                    <td class="count-column">{{ $review->views }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state-cell">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

