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
            ];
        })
        ->filter(fn (array $testimonial) => $testimonial['text'] !== '')
        ->take(6)
        ->values();
@endphp

<section data-testimonials-section class="bg-[#fcfdff] py-20 text-center px-4 overflow-hidden font-sans" style="word-spacing:0.6rem">
  <div class="mb-12">
    <h2 class="text-[32px] md:text-[46px] font-extrabold text-[#002d5b] tracking-tight">Client Success Stories</h2>
    <div class="w-16 h-1 bg-[#ff6a00] mx-auto mt-4 rounded-full"></div>
  </div>

  @if ($testimonials->isNotEmpty())
    <div class="max-w-4xl mx-auto relative">
      @foreach ($testimonials as $testimonial)
        <div data-testimonial-panel @if (! $loop->first) hidden @endif>
          <div class="bg-white rounded-[2.5rem] p-8 md:p-14 shadow-[0_20px_50px_rgba(0,45,91,0.04)] border border-gray-50 min-h-[250px] flex items-center justify-center">
            <p class="text-[#334155] text-xl md:text-2xl italic font-medium leading-relaxed">&ldquo; {{ $testimonial['text'] }} &rdquo;</p>
          </div>
          <div class="relative flex justify-center">
            <div class="w-8 h-8 bg-white rotate-45 -mt-4 border-r border-b border-gray-50"></div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="max-w-5xl mx-auto flex justify-center items-center gap-4 md:gap-8 mt-12 flex-wrap">
      @foreach ($testimonials as $testimonial)
        <button
          type="button"
          data-testimonial-trigger
          data-testimonial-index="{{ $loop->index }}"
          aria-pressed="{{ $loop->first ? 'true' : 'false' }}"
          class="flex items-center gap-4 cursor-pointer transition-all {{ $loop->first ? '' : 'opacity-40' }}"
        >
          <div
            data-testimonial-avatar
            class="relative w-14 h-14 md:w-20 md:h-20 rounded-full flex items-center justify-center transition-all {{ $loop->first ? 'bg-[#002d5b] ring-[6px] ring-[#ff6a00]' : 'bg-slate-300' }}"
          >
            <span data-testimonial-initials class="font-bold {{ $loop->first ? 'text-white text-xl md:text-2xl' : 'text-gray-100 text-base md:text-lg' }}">
              {{ $testimonial['initials'] }}
            </span>
            <span data-testimonial-badge class="absolute -top-1 -right-1 w-5 h-5 bg-[#ff6a00] border-2 border-white rounded-full {{ $loop->first ? '' : 'hidden' }}"></span>
          </div>
          <div class="text-left">
            <span data-testimonial-name class="block text-lg md:text-xl font-black transition-colors {{ $loop->first ? 'text-[#002d5b]' : 'text-[#94a3b8]' }}">
              {{ $testimonial['name'] }}
            </span>
            <span data-testimonial-verified class="flex items-center gap-1 {{ $loop->first ? '' : 'hidden' }}">
              <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
              <span class="text-[#ff6a00] text-[10px] font-black uppercase tracking-widest">Verified Client</span>
            </span>
          </div>
        </button>
      @endforeach
    </div>
  @else
    <div class="py-16 text-center text-[#002d5b] font-medium">Testimonials will appear here soon.</div>
  @endif
</section>
