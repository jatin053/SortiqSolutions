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
          <button
            type="button"
            data-portfolio-category="all"
            class="px-6 py-2 rounded-full text-sm font-bold transition-all border bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200"
          >
            All
          </button>
          @foreach ($portfolioCategories as $category)
            <button
              type="button"
              data-portfolio-category="{{ $category['slug'] }}"
              class="px-6 py-2 rounded-full text-sm font-bold transition-all border bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200"
            >
              {{ $category['name'] }}
            </button>
          @endforeach
        </div>

        <div id="portfolio-loading" class="py-20 text-center">
          <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-[#ff6600] mx-auto"></div>
        </div>

        <div class="flex flex-col items-center">
          <div id="portfolio-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full"></div>
          <div id="portfolio-pagination" class="flex justify-center items-center gap-4 mt-12 mb-10"></div>
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

      <script type="application/json" id="portfolio-items-data">@json(['portfolios' => $portfolioItems])</script>
    </div>
  </main>
@endsection
