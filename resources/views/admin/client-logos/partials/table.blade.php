<div class="reviews-table-wrap">
    <table class="reviews-table client-logo-table">
        <thead>
            <tr>
                <th class="client-logo-column">Logo</th>
                <th class="title-column">Client</th>
                <th>Website</th>
                <th>Status</th>
                <th class="count-column">Order</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientLogos as $clientLogo)
                <tr>
                    <td>
                        <div class="client-logo-thumb">
                            @if ($clientLogo->logo_url)
                                <img src="{{ $clientLogo->logo_url }}" alt="{{ $clientLogo['name'] }}">
                            @else
                                <span>{{ $clientLogo['name'] }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="review-title-cell">
                        <a href="{{ route('admin.client-logos.show', $clientLogo['slug']) }}" class="review-title">
                            {{ $clientLogo['name'] }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.client-logos.edit', $clientLogo['slug']) }}">Edit</a>
                            <span>|</span>
                            <a href="{{ $clientLogo['website'] ?: url('clients#' . $clientLogo['slug']) }}" target="_blank" rel="noopener">View</a>
                        </div>
                    </td>
                    <td>
                        @if ($clientLogo['website'])
                            <a href="{{ $clientLogo['website'] }}" target="_blank" rel="noopener">
                                {{ parse_url($clientLogo['website'], PHP_URL_HOST) }}
                            </a>
                        @else
                            <span class="muted-text">Not added</span>
                        @endif
                    </td>
                    <td><span class="status-pill {{ $clientLogo['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}">{{ ucfirst($clientLogo['status']) }}</span></td>
                    <td class="count-column">{{ $clientLogo['sort_order'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-state-cell">No client logos found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

