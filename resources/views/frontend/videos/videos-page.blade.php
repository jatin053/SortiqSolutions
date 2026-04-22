@extends('layouts.frontend')

@section('title', 'Videos | Explore IT Insights by Sortiq Solutions')
@section('body_attributes') data-route="/videos" @endsection

@section('content')
<main class="font-raleway">
    <div class="bg-[#f9fafb] min-h-screen font-sans">
      <div class="h-[180px] relative bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&q=80&w=1200')">
        <div class="absolute inset-0 bg-black/60 flex flex-col justify-center items-center text-center px-4">
          <h1 class="text-white text-3xl md:text-4xl font-extrabold lowercase mb-2">Our Video Gallery</h1>
          <p class="text-white text-lg opacity-90 lowercase font-semibold">Explore our latest video content</p>
        </div>
      </div>
      <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @forelse ($videos as $video)
            <div id="{{ $video['slug'] }}" data-video-url="{{ $video->embed_url }}" class="bg-white rounded-xl shadow-md overflow-hidden h-[230px] transition-transform hover:scale-[1.02] relative group cursor-pointer">
              <img src="{{ $video->thumbnail_url }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover" loading="lazy">
              <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                <div class="w-14 h-14 bg-[#ff6600] rounded-full flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                  <iconify-icon icon="lucide:play" width="28" height="28"></iconify-icon>
                </div>
              </div>
            </div>
          @empty
            <div class="col-span-full bg-white rounded-xl border border-gray-200 p-10 text-center text-gray-500 shadow-sm">
              No videos published yet.
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </main>
@endsection
