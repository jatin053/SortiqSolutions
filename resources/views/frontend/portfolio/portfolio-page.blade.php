@extends('layouts.frontend')

@section('title', 'Our Creative Work | Sortiq Solutions')
@section('body_attributes') data-route="/portfolio" @endsection

@section('content')
<main class="font-raleway">
    <div class="bg-white pb-20 min-h-screen font-sans">
      <div class="relative h-64 w-full flex flex-col items-center justify-center text-white">
        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1600&q=80" class="absolute inset-0 w-full h-full object-cover" alt="Header">
        <div class="absolute inset-0 bg-[#001a3d]/80"></div>
        <div class="text-center z-10">
          <h2 class="text-4xl font-black mb-2">Our Creative <span class="text-blue-500">Work</span></h2>
          <div class="w-20 h-1 bg-[#ff6600] mx-auto rounded-full"></div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-3 py-10">
          <a
            href="{{ route('frontend.portfolio') }}"
            class="px-6 py-2 rounded-full text-sm font-bold transition-all border {{ $activePortfolioCategory === '' ? 'bg-[#001a3d] text-white border-[#001a3d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200' }}"
          >
            All
          </a>
          @foreach ($portfolioCategories as $category)
            <a
              href="{{ route('frontend.portfolio', ['category' => $category['slug']]) }}"
              class="px-6 py-2 rounded-full text-sm font-bold transition-all border {{ $activePortfolioCategory === $category['slug'] ? 'bg-[#001a3d] text-white border-[#001a3d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200' }}"
            >
              {{ $category['name'] }}
            </a>
          @endforeach
        </div>

        <div class="flex flex-col items-center">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
            @forelse ($portfolioItems as $item)
              <button
                type="button"
                data-portfolio-item
                data-portfolio-title="{{ $item['title'] }}"
                data-portfolio-summary="{{ $item['summary'] }}"
                data-portfolio-content="{{ $item['content'] }}"
                data-portfolio-image="{{ $item['featured_media_url'] }}"
                data-portfolio-url="{{ $item['website_url'] }}"
                data-portfolio-category="{{ $item['category_name'] }}"
                class="group relative overflow-hidden rounded-2xl aspect-[4/3] cursor-pointer bg-gray-100 shadow-sm text-left"
              >
                @if ($item['featured_media_url'])
                  <img src="{{ $item['featured_media_url'] }}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="{{ $item['title'] }}">
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
                <h3 class="text-xl font-black text-[#001a3d]">No portfolio projects available yet.</h3>
                <p class="mx-auto mt-3 max-w-2xl text-sm leading-6">
                  Portfolio items will appear here after the live database is connected and published projects are added.
                </p>
              </div>
            @endforelse
          </div>

          @if ($portfolioPaginator->hasPages())
            <div class="flex justify-center items-center gap-4 mt-12 mb-10">
              @if ($portfolioPaginator->onFirstPage())
                <span class="p-2 border rounded-full opacity-20">&#8249;</span>
              @else
                <a href="{{ $portfolioPaginator->previousPageUrl() }}" class="p-2 border rounded-full hover:bg-gray-50 transition-colors">&#8249;</a>
              @endif

              <span class="font-bold text-gray-600">{{ $portfolioPaginator->currentPage() }} / {{ $portfolioPaginator->lastPage() }}</span>

              @if ($portfolioPaginator->hasMorePages())
                <a href="{{ $portfolioPaginator->nextPageUrl() }}" class="p-2 border rounded-full hover:bg-gray-50 transition-colors">&#8250;</a>
              @else
                <span class="p-2 border rounded-full opacity-20">&#8250;</span>
              @endif
            </div>
          @endif

          <div class="mt-8">
            <a href="https://www.behance.net/sortiqsolutions71" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3 bg-[#001a3d] text-white px-8 py-4 rounded-full font-black text-sm uppercase tracking-widest shadow-lg hover:bg-[#ff6600] transition-all duration-300 transform hover:-translate-y-1">
              View More on Behance
              <iconify-icon icon="lucide:external-link" width="18" height="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
            </a>
          </div>
        </div>
      </div>

      <div id="portfolio-modal" class="portfolio-modal fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80" hidden>
        <div class="bg-white max-w-4xl w-full rounded-xl overflow-hidden relative">
          <button id="portfolio-modal-close" type="button" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-md z-10">
            <iconify-icon icon="lucide:x" width="20" height="20"></iconify-icon>
          </button>
          <div id="portfolio-modal-content" class="overflow-y-auto max-h-[85vh]"></div>
        </div>
      </div>
    </div>
  </main>
@endsection
