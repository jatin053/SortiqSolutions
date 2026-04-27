@php
    $testimonials = collect($frontendReviewFeed ?? [])
        ->map(function (array $testimonial) {
            $name = trim((string) ($testimonial['title'] ?? 'Happy Client'));
            $parts = preg_split('/\s+/', $name) ?: [];
            $initials = count($parts) > 1
                ? strtoupper(($parts[0][0] ?? 'S') . ($parts[count($parts) - 1][0] ?? ''))
                : strtoupper($parts[0][0] ?? 'S');

            return [
                'name' => $name !== '' ? $name : 'Happy Client',
                'text' => trim(strip_tags((string) ($testimonial['content'] ?? $testimonial['post_content'] ?? ''))),
                'initials' => $initials,
                'platform' => trim((string) ($testimonial['platform'] ?? '')),
                'position' => trim((string) ($testimonial['position'] ?? '')),
                'rating' => max(0, min(5, (int) ($testimonial['rating'] ?? 0))),
            ];
        })
        ->filter(fn (array $testimonial) => $testimonial['text'] !== '')
        ->take(6)
        ->values();
@endphp

<section data-testimonials-section class="testimonials-section">
  <div class="testimonials-shell">
    <div class="testimonials-header">
      <p class="testimonials-eyebrow">Client Success Stories</p>
      <h2 class="testimonials-title">Real Words From <span>Real Clients</span></h2>
    </div>

    @if ($testimonials->isNotEmpty())
      <div class="testimonials-stage" data-testimonial-stage>
        @foreach ($testimonials as $testimonial)
          <article
            id="testimonial-panel-{{ $loop->index }}"
            data-testimonial-panel
            aria-hidden="{{ $loop->first ? 'false' : 'true' }}"
            class="testimonials-panel {{ $loop->first ? 'is-active' : '' }}"
          >
            <div class="testimonials-card">
              <span class="testimonials-card-quote" aria-hidden="true">&ldquo;</span>

              <div class="testimonials-card-top">
                <span class="testimonials-card-platform">
                  {{ $testimonial['platform'] !== '' ? $testimonial['platform'] : 'Client Review' }}
                </span>

                @if ($testimonial['rating'] > 0)
                  <div class="testimonials-card-rating" aria-label="{{ $testimonial['rating'] }} out of 5 stars">
                    @foreach (range(1, 5) as $star)
                      <span class="testimonials-card-star {{ $star <= $testimonial['rating'] ? 'is-filled' : '' }}">&#9733;</span>
                    @endforeach
                  </div>
                @endif
              </div>

              <p class="testimonials-card-copy">&ldquo;{{ $testimonial['text'] }}&rdquo;</p>

              <div class="testimonials-card-footer">
                <div class="testimonials-card-avatar" aria-hidden="true">
                  {{ $testimonial['initials'] }}
                </div>

                <div class="testimonials-card-author">
                  <p class="testimonials-card-name">{{ $testimonial['name'] }}</p>
                  <div class="testimonials-card-meta">
                    <span class="testimonials-card-meta-dot"></span>
                    <span>{{ $testimonial['position'] !== '' ? $testimonial['position'] : 'Verified Client' }}</span>
                    @if ($testimonial['platform'] !== '')
                      <span class="testimonials-card-meta-separator"></span>
                      <span>{{ $testimonial['platform'] }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div class="testimonials-rail-guide" aria-hidden="true"></div>

      <div class="testimonials-rail-viewport" data-testimonial-viewport>
        <div class="testimonials-rail-track" data-testimonial-track>
          @foreach ($testimonials as $testimonial)
            <button
              type="button"
              data-testimonial-trigger
              data-testimonial-index="{{ $loop->index }}"
              aria-controls="testimonial-panel-{{ $loop->index }}"
              aria-pressed="{{ $loop->first ? 'true' : 'false' }}"
              class="testimonials-trigger {{ $loop->first ? 'is-active' : '' }}"
            >
              <span class="testimonials-trigger-avatar" aria-hidden="true">
                <span class="testimonials-trigger-initials">{{ $testimonial['initials'] }}</span>
                <span class="testimonials-trigger-badge"></span>
              </span>

              <span class="testimonials-trigger-copy">
                <span class="testimonials-trigger-name">{{ $testimonial['name'] }}</span>
                <span class="testimonials-trigger-verified">
                  <span class="testimonials-trigger-verified-dot"></span>
                  Verified Client
                </span>
              </span>
            </button>
          @endforeach
        </div>
      </div>
    @else
      <div class="testimonials-empty">Testimonials will appear here soon.</div>
    @endif
  </div>
</section>
