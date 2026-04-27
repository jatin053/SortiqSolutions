@extends('layouts.frontend')

@section('title', 'Portfolio | Sortiq Solutions')
@section('body_attributes') data-route="/portfolios" @endsection

@section('content')
<main class="font-raleway">
  <div class="bg-white pb-20 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 pt-10">
      <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-black text-[#001a3d]">Creative Portfolio</h1>
        <div class="w-20 h-1 bg-[#ff6600] mx-auto rounded-full mt-3"></div>
      </div>

      <div class="flex flex-wrap justify-center gap-3 pb-10" id="portfolio-filters">
        @foreach ($portfolioCategories as $category)
          <button
            type="button"
            data-portfolio-filter="{{ $category['slug'] }}"
            class="px-6 py-2 rounded-full text-sm font-bold transition-all border {{ $activePortfolioCategory === $category['slug'] ? 'bg-[#001a3d] text-white border-[#001a3d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200' }}"
          >
            {{ $category['name'] }}
          </button>
        @endforeach
      </div>

      <div class="flex flex-col items-center">
        <div id="portfolio-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
          @forelse ($visiblePortfolioItems as $item)
            <button
              type="button"
              data-portfolio-item
              data-portfolio-title="{{ $item['title'] }}"
              data-portfolio-image="{{ $item['image_url'] }}"
              class="group relative overflow-hidden rounded-2xl aspect-[4/3] cursor-pointer bg-gray-100 shadow-sm text-left"
            >
              @if ($item['image_url'])
                <img
                  src="{{ $item['image_url'] }}"
                  class="w-full h-full object-cover transition-transform group-hover:scale-105"
                  alt="{{ $item['title'] }}"
                  loading="lazy"
                  decoding="async"
                >
              @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 px-6 text-center text-white font-bold">
                  {{ $item['title'] }}
                </div>
              @endif

              <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6">
                <h3 class="text-white font-bold">{{ $item['title'] }}</h3>
              </div>
            </button>
          @empty
            <div class="col-span-full rounded-3xl border border-gray-200 bg-white px-6 py-16 text-center text-gray-500 shadow-sm">
              <h3 class="text-xl font-black text-[#001a3d]">No portfolio projects are available right now.</h3>
            </div>
          @endforelse
        </div>

        <div id="portfolio-pagination" class="flex justify-center items-center gap-4 mt-12 mb-10{{ $visiblePortfolioTotalPages > 1 ? '' : ' hidden' }}">
          <button
            id="portfolio-prev"
            type="button"
            class="p-2 border rounded-full disabled:opacity-20 hover:bg-gray-50 transition-colors"
            disabled
            aria-label="Previous portfolio page"
          >
            <iconify-icon icon="lucide:chevron-left" width="20" height="20"></iconify-icon>
          </button>
          <span id="portfolio-page-state" class="font-bold text-gray-600">1 / {{ $visiblePortfolioTotalPages }}</span>
          <button
            id="portfolio-next"
            type="button"
            class="p-2 border rounded-full disabled:opacity-20 hover:bg-gray-50 transition-colors"
            @disabled($visiblePortfolioTotalPages <= 1)
            aria-label="Next portfolio page"
          >
            <iconify-icon icon="lucide:chevron-right" width="20" height="20"></iconify-icon>
          </button>
        </div>

        <div id="portfolio-behance-wrap" class="mt-8{{ $visiblePortfolioTotalPages <= 1 ? ' pt-10' : '' }}">
          <a href="https://www.behance.net/sortiqsolutions71" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3 bg-[#001a3d] text-white px-8 py-4 rounded-full font-black text-sm uppercase tracking-widest shadow-lg hover:bg-[#ff6600] transition-all duration-300 transform hover:-translate-y-1">
            View More on Behance
            <iconify-icon icon="lucide:external-link" width="18" height="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
          </a>
        </div>
      </div>
    </div>

    <div id="portfolio-modal" class="portfolio-modal fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80" hidden>
      <div class="bg-white max-w-4xl w-full rounded-xl overflow-hidden relative">
        <button id="portfolio-modal-close" type="button" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-md z-10" aria-label="Close portfolio preview">
          <iconify-icon icon="lucide:x" width="20" height="20"></iconify-icon>
        </button>
        <div id="portfolio-modal-content" class="overflow-y-auto max-h-[85vh]"></div>
      </div>
    </div>

    <script type="application/json" id="portfolio-page-data">@json($portfolioPagePayload)</script>
  </div>
</main>
@endsection
