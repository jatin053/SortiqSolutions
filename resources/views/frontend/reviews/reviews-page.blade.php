@extends('layouts.frontend')

@section('title', 'Client Reviews &amp; Testimonials | Sortiq Solutions')
@section('body_attributes') data-route="/reviews" @endsection

@section('content')
<main class="bg-[#f9fafc] font-raleway min-h-screen">
    <section class="relative overflow-hidden bg-[#0d2a57] text-white">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute left-[-4%] top-10 h-48 w-48 rounded-3xl bg-white/10 blur-sm"></div>
            <div class="absolute left-[18%] top-4 h-40 w-40 rounded-full bg-[#3f5f95]/50"></div>
            <div class="absolute right-[16%] top-14 h-28 w-52 -skew-x-[28deg] rounded-2xl bg-white/10"></div>
            <div class="absolute right-[-5%] bottom-0 h-44 w-72 -skew-x-[32deg] rounded-3xl bg-[#274878]/60"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-6 py-16 md:py-20 lg:py-24 text-center">
            <h1 class="text-5xl font-extrabold tracking-tight md:text-7xl">Reviews</h1>
            <p class="mt-4 text-xl font-semibold text-white/75 md:text-2xl">
                What Our Clients Say About Us
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-12 md:py-14">
        @if ($reviews->count())
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($reviews as $review)
                    @php
                        $summary = $review->summary ?: \Illuminate\Support\Str::limit(strip_tags($review->content), 190);
                        $platformLabel = strtolower($review->platform ?: 'verified');
                    @endphp

                    <article class="relative flex h-full flex-col rounded-[2rem] border border-[#edf1f7] bg-white px-8 pb-8 pt-14 shadow-[0_18px_45px_rgba(13,42,87,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_24px_60px_rgba(13,42,87,0.1)]">
                        <div class="absolute left-8 top-0 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-[1.15rem] bg-[#ff6a00] text-white shadow-[0_12px_24px_rgba(255,106,0,0.3)]">
                            <iconify-icon icon="mdi:format-quote-open" width="26" height="26"></iconify-icon>
                        </div>

                        <div class="flex-1">
                            <p class="text-[1.02rem] leading-9 text-[#5a6475] {{ $loop->first ? 'italic' : '' }}">
                                {{ $summary }}
                            </p>
                        </div>

                        <div class="mt-10 border-t border-dashed border-[#e6ebf2] pt-7">
                            <div class="flex items-end justify-between gap-5">
                                <div>
                                    <h2 class="text-[1.9rem] font-extrabold leading-tight text-[#0e2348]">
                                        <a href="{{ route('frontend.reviews.show', $review) }}" class="transition-colors hover:text-[#ff6a00]">
                                            {{ $review->name }}
                                        </a>
                                    </h2>

                                    <div class="mt-2 flex items-center gap-1 text-sm text-[#ffc107]">
                                        @for ($star = 0; $star < $review->rating; $star++)
                                            <span aria-hidden="true">★</span>
                                        @endfor
                                    </div>
                                </div>

                                <a
                                    href="{{ route('frontend.reviews.show', $review) }}"
                                    class="inline-flex items-center gap-2 rounded-full border border-[#edf1f7] bg-[#fbfcfe] px-5 py-2.5 text-base font-bold lowercase text-[#55a630] shadow-sm transition-all hover:border-[#dfe8d8] hover:bg-white"
                                >
                                    <span>{{ $platformLabel }}</span>
                                    <span class="h-2 w-2 rounded-full bg-[#55a630]"></span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($reviews->hasPages())
                <nav class="mt-14 flex items-center justify-center gap-3" aria-label="Reviews pagination">
                    @if ($reviews->onFirstPage())
                        <span class="flex h-11 w-11 items-center justify-center rounded-full border border-[#edf1f7] text-[#c2c9d6]">
                            <iconify-icon icon="lucide:chevron-left" width="18" height="18"></iconify-icon>
                        </span>
                    @else
                        <a href="{{ $reviews->previousPageUrl() }}" class="flex h-11 w-11 items-center justify-center rounded-full border border-[#edf1f7] bg-white text-[#ff6a00] transition-colors hover:border-[#ff6a00]">
                            <iconify-icon icon="lucide:chevron-left" width="18" height="18"></iconify-icon>
                        </a>
                    @endif

                    @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                        <a
                            href="{{ $url }}"
                            class="flex h-11 w-11 items-center justify-center rounded-full border text-sm font-extrabold transition-all {{ $page === $reviews->currentPage() ? 'border-[#ff6a00] bg-[#ff6a00] text-white shadow-[0_10px_20px_rgba(255,106,0,0.24)]' : 'border-[#edf1f7] bg-white text-[#7d8798] hover:border-[#ff6a00] hover:text-[#ff6a00]' }}"
                        >
                            {{ $page }}
                        </a>
                    @endforeach

                    @if ($reviews->hasMorePages())
                        <a href="{{ $reviews->nextPageUrl() }}" class="flex h-11 w-11 items-center justify-center rounded-full border border-[#edf1f7] bg-white text-[#ff6a00] transition-colors hover:border-[#ff6a00]">
                            <iconify-icon icon="lucide:chevron-right" width="18" height="18"></iconify-icon>
                        </a>
                    @else
                        <span class="flex h-11 w-11 items-center justify-center rounded-full border border-[#edf1f7] text-[#c2c9d6]">
                            <iconify-icon icon="lucide:chevron-right" width="18" height="18"></iconify-icon>
                        </span>
                    @endif
                </nav>
            @endif
        @else
            <div class="rounded-[2rem] border border-[#edf1f7] bg-white p-12 text-center text-[#6b7280] shadow-sm">
                No reviews have been published yet.
            </div>
        @endif
    </section>
</main>
@endsection
