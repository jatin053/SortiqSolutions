@extends('layouts.frontend')

@section('title', $blog['title'] . ' | Sortiq Solutions')
@section('body_attributes') data-route="/blog" @endsection

@section('content')
<main class="font-raleway">
  <div class="bg-white min-h-screen pb-20 font-raleway">
    <div class="max-w-[800px] mx-auto pt-6 px-5">
      <a href="{{ route('frontend.blog.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#ff6600] transition-colors text-[15px]">
        <span aria-hidden="true">‹</span>
        <span>back to the blogs</span>
      </a>

      <article class="pt-10">
        @if ($blog->image_url)
          <img src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}" class="w-full rounded-xl shadow-sm object-cover">
        @endif

        <div class="mt-10 flex flex-wrap items-center gap-2 text-[15px] text-[#2563eb]">
          <span class="text-[#f59e0b]">📁</span>
          <span>{{ $blog['category'] ?: 'Blog' }}</span>
        </div>

        <h1 class="mt-6 text-[#002d5b] text-[34px] md:text-[38px] leading-tight font-extrabold">
          {{ $blog['title'] }}
        </h1>

        @if ($blog['excerpt'])
          <p class="mt-6 text-[#334155] text-[15px] md:text-[16px] leading-8">
            {{ $blog['excerpt'] }}
          </p>
        @endif

        <div class="mt-8 text-[#334155] text-[15px] md:text-[16px] leading-8 space-y-6">
          @foreach (preg_split("/\\r\\n|\\r|\\n/", trim($blog['content'])) as $paragraph)
            @if (trim($paragraph) !== '')
              <p>{{ $paragraph }}</p>
            @endif
          @endforeach
        </div>
      </article>

      <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-[#00142e] font-bold text-lg">Share</div>
        <div class="bg-[#002d5b] px-6 py-3 rounded-full shadow-lg">
          <div class="flex items-center gap-4">
            <a href="https://www.facebook.com/SortiqSolutions/" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="Facebook">
              <iconify-icon icon="fa6-brands:facebook-f" width="14" height="14"></iconify-icon>
            </a>
            <a href="https://www.linkedin.com/company/sortiq-solutions/" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="LinkedIn">
              <iconify-icon icon="fa6-brands:linkedin-in" width="14" height="14"></iconify-icon>
            </a>
            <a href="https://www.instagram.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="Instagram">
              <iconify-icon icon="fa6-brands:instagram" width="14" height="14"></iconify-icon>
            </a>
            <a href="https://www.youtube.com/@SortiqSolutions" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="YouTube">
              <iconify-icon icon="fa6-brands:youtube" width="14" height="14"></iconify-icon>
            </a>
            <a href="https://x.com/SortiqSolutions" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="Twitter">
              <iconify-icon icon="fa6-brands:x-twitter" width="14" height="14"></iconify-icon>
            </a>
            <a href="https://in.pinterest.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="Pinterest">
              <iconify-icon icon="fa6-brands:pinterest-p" width="14" height="14"></iconify-icon>
            </a>
            <a href="https://medium.com/@sortiqsolutions" target="_blank" rel="noopener noreferrer" class="text-white transition-all duration-300 hover:text-orange-500 hover:scale-125" aria-label="Medium">
              <iconify-icon icon="fa6-brands:medium" width="14" height="14"></iconify-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
