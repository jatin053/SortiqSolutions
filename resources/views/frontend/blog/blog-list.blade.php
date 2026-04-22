@extends('layouts.frontend')

@section('title', 'Blogs on IT Web Design &amp; Web Development | Sortiq Solutions')
@section('body_attributes') data-route="/blog" @endsection

@section('content')
<main class="font-raleway">
  <div class="bg-gray-50 min-h-screen font-sans">
    <div class="container mx-auto px-4 py-8 md:py-16 flex flex-col lg:flex-row gap-8">
      <div class="lg:w-3/4 order-2 lg:order-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($blogs as $blog)
            @php
              $excerpt = $blog['excerpt'] ?: \Illuminate\Support\Str::limit(strip_tags($blog['content']), 140);
              $category = $blog['category'] ?: 'Tech';
            @endphp
            <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 group flex flex-col h-full">
              <a href="{{ route('frontend.blog.show', $blog['slug']) }}" class="relative overflow-hidden rounded-t-2xl h-60 w-full bg-gray-200 block">
                @if ($blog->image_url)
                  <img src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                  <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#002d5b] to-[#004080]">
                    <span class="text-white text-sm font-semibold px-4 text-center opacity-70 line-clamp-3">{{ $blog['title'] }}</span>
                  </div>
                @endif
                <div class="absolute top-4 left-4 bg-[#ff6a00] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">{{ $category }}</div>
              </a>

              <div class="p-8 flex flex-col flex-grow">
                <p class="text-gray-400 text-xs mb-3 font-medium">{{ $blog->published_at?->format('F d, Y') }}</p>
                <h3 class="text-xl font-bold text-[#002d5b] mb-4 line-clamp-2 leading-tight group-hover:text-[#ff6a00] transition-colors">
                  <a href="{{ route('frontend.blog.show', $blog['slug']) }}">{{ $blog['title'] }}</a>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">{{ $excerpt }}</p>
                <div class="mt-auto">
                  <a href="{{ route('frontend.blog.show', $blog['slug']) }}" class="text-[#ff6a00] font-bold text-sm inline-flex items-center gap-2 group/btn">
                    Read More
                    <span class="group-hover/btn:translate-x-2 transition-transform duration-300">→</span>
                  </a>
                </div>
              </div>
            </article>
          @empty
            <div class="col-span-full py-20 text-center text-gray-500 font-bold bg-white rounded-lg shadow-sm border border-gray-100">
              No blogs found.
            </div>
          @endforelse
        </div>

        @if ($blogs->hasPages())
          <div class="flex flex-wrap gap-2 mt-12 justify-center items-center">
            @if ($blogs->onFirstPage())
              <span class="w-10 h-10 rounded-full flex items-center justify-center border bg-white text-[#ff6600] opacity-30">‹</span>
            @else
              <a href="{{ $blogs->previousPageUrl() }}" class="w-10 h-10 rounded-full flex items-center justify-center border bg-white text-[#ff6600] hover:bg-orange-50 transition-colors">‹</a>
            @endif

            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
              <a href="{{ $url }}" class="w-10 h-10 rounded-full font-bold text-sm transition-all border flex items-center justify-center {{ $blogs->currentPage() === $page ? 'bg-[#ff6600] text-white border-[#ff6600]' : 'bg-white text-gray-500 border-gray-200 hover:border-[#ff6600] hover:text-[#ff6600]' }}">
                {{ $page }}
              </a>
            @endforeach

            @if ($blogs->hasMorePages())
              <a href="{{ $blogs->nextPageUrl() }}" class="w-10 h-10 rounded-full flex items-center justify-center border bg-white text-[#ff6600] hover:bg-orange-50 transition-colors">›</a>
            @else
              <span class="w-10 h-10 rounded-full flex items-center justify-center border bg-white text-[#ff6600] opacity-30">›</span>
            @endif
          </div>
        @endif
      </div>

      <div class="lg:w-1/4 space-y-6 order-1 lg:order-2">
        <form action="{{ route('frontend.blog.index') }}" method="get" class="bg-white p-3 shadow-sm border border-gray-100 flex rounded-lg overflow-hidden focus-within:ring-2 ring-orange-100 transition-all">
          @if ($activeCategory)
            <input type="hidden" name="category" value="{{ $activeCategory }}">
          @endif
          <input name="search" value="{{ $searchTerm }}" type="text" placeholder="Search Here..." class="flex-1 px-3 py-2 outline-none text-sm">
          <button type="submit" class="bg-[#ff6600] px-4 py-2 text-white rounded-md hover:bg-orange-600 transition-colors">
            <iconify-icon icon="lucide:search" width="18" height="18"></iconify-icon>
          </button>
        </form>

        <div class="bg-white p-6 shadow-sm border border-gray-100 rounded-lg">
          <h3 class="font-extrabold text-lg text-[#00142e] mb-5 border-b border-gray-100 pb-3">Recent Posts</h3>
          <ul class="space-y-4">
            @forelse ($recentBlogs as $recentBlog)
              <li class="group cursor-pointer">
                <a href="{{ route('frontend.blog.show', $recentBlog['slug']) }}" class="text-sm font-semibold text-gray-600 group-hover:text-[#ff6600] transition-colors line-clamp-2 leading-snug">• {{ $recentBlog['title'] }}</a>
                <div class="h-[1px] w-0 group-hover:w-full bg-orange-100 transition-all duration-300 mt-2"></div>
              </li>
            @empty
              <li class="text-sm text-gray-500">No recent posts available.</li>
            @endforelse
          </ul>
        </div>

        <div class="bg-white p-6 shadow-sm border border-gray-100 rounded-lg">
          <h3 class="font-extrabold text-lg text-[#00142e] mb-5 border-b border-gray-100 pb-3">Categories</h3>
          <ul class="space-y-4">
            @forelse ($categories as $category)
              <li>
                <a href="{{ route('frontend.blog.index', array_filter(['category' => $category->slug, 'search' => $searchTerm])) }}" class="flex justify-between text-sm font-bold transition-colors py-1 group {{ $activeCategory === $category->slug ? 'text-[#ff6600]' : 'text-gray-600 hover:text-[#ff6600]' }}">
                  <span class="flex items-center gap-2">
                    <span class="blog-category-dot w-1.5 h-1.5 rounded-full {{ $activeCategory === $category->slug ? 'bg-[#ff6600]' : 'bg-gray-300 group-hover:bg-[#ff6600]' }}"></span>
                    {{ $category->name }}
                  </span>
                  <span class="text-gray-400 font-medium">({{ $category->total }})</span>
                </a>
              </li>
            @empty
              <li class="text-sm text-gray-500">No categories available.</li>
            @endforelse

            @if ($activeCategory)
              <li class="mt-4 pt-4 border-t border-dashed border-gray-200 text-xs text-[#ff6600] font-bold text-center uppercase tracking-widest">
                <a href="{{ route('frontend.blog.index', array_filter(['search' => $searchTerm])) }}" class="hover:underline">Clear Filter</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
