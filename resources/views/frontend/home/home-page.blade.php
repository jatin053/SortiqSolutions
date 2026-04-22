@extends('layouts.frontend')

@section('title', 'Sortiq Solutions Pvt. Ltd.')
@section('body_attributes') data-route="/" @endsection

@section('content')
<main class="font-raleway"><div class="font-raleway">
    <section class="relative h-[500px] sm:h-[550px] lg:h-[55vh] min-h-[450px] overflow-hidden bg-[#2563eb]">
      <div class="absolute inset-0">
        <div class="absolute inset-0 transform-gpu">
          <div class="w-full h-full bg-gradient-to-br from-[#2563eb] via-[#3b82f6] to-[#8b5cf6]"></div>
          <div class="absolute inset-0 bg-black/10 lg:bg-gradient-to-r lg:from-black/30 lg:to-transparent"></div>
        </div>
      </div>
      <div class="relative z-10 max-w-[1400px] mx-auto h-full px-6 md:px-12 flex flex-col lg:flex-row items-center justify-center lg:justify-between gap-6 lg:gap-12">
        <div class="hero-dotlottie w-full lg:flex-1 flex justify-center items-center order-1 lg:order-2">
          <div class="w-[180px] sm:w-[240px] md:w-[320px] lg:w-[480px]">
            <dotlottie-player id="hero-slide-player" src="https://lottie.host/7c684b81-ffa7-4674-a2df-44e15c42f65e/3oMb4N7959.lottie" autoplay loop></dotlottie-player>
          </div>
        </div>
        <div class="w-full lg:w-[50%] flex flex-col items-center lg:items-start space-y-4 md:space-y-6 order-2 lg:order-1">
          <h1 id="hero-slide-title" class="text-[26px] sm:text-[34px] md:text-[42px] lg:text-[48px] font-bold text-white leading-[1.2] max-w-[600px] text-center lg:text-left">Custom Software Development</h1>
          <p id="hero-slide-desc" class="text-gray-100 text-sm md:text-base leading-relaxed max-w-[480px] text-center lg:text-left">Tailored solutions that align with your business goals. We build scalable software that enhances efficiency and drives consistent growth for your brand.</p>
          <a href="/contact" class="bg-orange-500 px-10 py-3 rounded-full text-white font-bold text-sm md:text-base hover:bg-orange-600 transition-colors shadow-lg">Get Started</a>
        </div>
      </div>
      <div class="hidden lg:flex absolute top-1/2 w-full -translate-y-1/2 justify-between px-8 z-30 pointer-events-none">
        <button id="hero-prev" type="button" class="pointer-events-auto bg-white/10 p-4 rounded-full text-white backdrop-blur-md hover:bg-orange-500 transition-all border border-white/20 shadow-xl group" aria-label="Previous slide">
          <iconify-icon icon="lucide:chevron-left" width="24" height="24" class="group-hover:-translate-x-1 transition-transform"></iconify-icon>
        </button>
        <button id="hero-next" type="button" class="pointer-events-auto bg-white/10 p-4 rounded-full text-white backdrop-blur-md hover:bg-orange-500 transition-all border border-white/20 shadow-xl group" aria-label="Next slide">
          <iconify-icon icon="lucide:chevron-right" width="24" height="24" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
        </button>
      </div>
      <script type="application/json" id="hero-slides-data">{"slides":[{"title":"Custom Software Development","desc":"Tailored solutions that align with your business goals. We build scalable software that enhances efficiency and drives consistent growth for your brand.","animation":"https://lottie.host/7c684b81-ffa7-4674-a2df-44e15c42f65e/3oMb4N7959.lottie"},{"title":"Web & Mobile App Development","desc":"From responsive websites to mobile apps, we provide end-to-end development ensuring seamless performance across all platforms and devices.","animation":"https://lottie.host/30358dc5-7a85-4d2d-bf4b-5200226d4845/pvfI7Vi812.lottie"},{"title":"Digital Transformation","desc":"Empowering businesses with innovative digital tools to streamline processes and stay ahead in the highly competitive modern market.","animation":"https://lottie.host/d4bc01ea-c9c3-43e7-adf0-f1933e8f251a/vhqqVoh2og.lottie"}]}</script>
    </section>
  <section class="bg-gray-100 py-16 lg:py-20 overflow-hidden"><div class="max-w-[1400px] mx-auto px-6"><div class="text-center mb-14"><h2 class="text-3xl lg:text-4xl font-bold text-[#0a2540]">Why Choose Us</h2><div class="w-12 h-1 bg-orange-500 mx-auto mt-3 rounded"></div></div><div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 text-center"><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/03/tech-expertise-image.webp" alt="Strategy-First Approach" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Strategy-First Approach</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">We start with understanding your business goals and target audience. Every website and marketing campaign is built with a clear strategy to drive growth and leads.</p></div><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/03/custom-solutions-image.webp" alt="Conversion-Driven Development" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Conversion-Driven Development</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">Our websites are designed to do more than just look good. We create user-focused, SEO-friendly content that turns visitors into paying clients.</p></div><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/03/quality-and-timeless-image.webp" alt="Data-Driven Marketing" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Data-Driven Marketing</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">To optimize campaigns, we rely on tracking, analytics, and actual performance data. Every decision is driven by insights to maximize ROI.</p></div><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/03/online-support-icon.webp" alt="Long-Term Growth Partner" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Long-Term Growth Partner</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">We don’t disappear after launch. From ongoing optimization and support to scaling your digital presence, we work as a long-term partner.</p></div></div></div></section><section class="bg-[#05264e] text-white py-12 lg:py-20 overflow-hidden"><div class="max-w-[1200px] mx-auto px-6 mb-12 lg:mb-20"><div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center"><div class="flex justify-center will-change-transform"><img src="https://sortiqsolutions.com/wp-content/uploads/elementor/thumbs/wix-partner-rendr7au0yttdewf0w3mmbcwpb2d3jpuj8vy8thjyc.png" alt="Wix Partner" width="320" height="150" loading="lazy" class="w-48 sm:w-64 lg:w-80 object-contain"></img></div><div class="text-center lg:text-left will-change-transform"><h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-4">Proud to be a Wix Partner</h2><div class="w-12 h-1 bg-orange-500 mb-6 rounded mx-auto lg:mx-0"></div><p class="text-gray-200 text-sm md:text-base leading-relaxed mb-4">At Sortiq Solutions Pvt. Ltd., we are honored to be recognized as a certified Wix Partner. This partnership empowers us to build high-performing, visually appealing, and fully responsive websites tailored to your business goals.</p><p class="text-gray-200 text-sm md:text-base leading-relaxed">Whether you're a startup, SME, or an established brand, we simplify your digital journey so you can focus on growth.</p></div></div></div><div class="max-w-[1200px] mx-auto px-4 md:px-6"><div class="text-center mb-10 lg:mb-14"><h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold">Global Certifications &amp; Recognitions</h3><div class="w-12 h-1 bg-orange-500 mx-auto mt-3 rounded"></div></div><div class="relative overflow-hidden w-full" data-certifications-slider><div class="flex gap-4 md:gap-6 will-change-transform" data-certifications-track><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Untitled-2-300x300.jpg" alt="Certification 0" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Semrush-Academy-300x300.jpg" alt="Certification 1" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Acknowlages-Google-analytics-300x300.jpg" alt="Certification 2" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/wix-studio-300x300.jpg" alt="Certification 3" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Certified-by-wix-studio-300x300.jpg" alt="Certification 4" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/just-dial-300x300.jpg" alt="Certification 5" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/wix-web-designer-300x300.jpg" alt="Certification 6" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Untitled-2-300x300.jpg" alt="Certification 7" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Semrush-Academy-300x300.jpg" alt="Certification 8" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Acknowlages-Google-analytics-300x300.jpg" alt="Certification 9" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/wix-studio-300x300.jpg" alt="Certification 10" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/Certified-by-wix-studio-300x300.jpg" alt="Certification 11" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/just-dial-300x300.jpg" alt="Certification 12" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2026/03/wix-web-designer-300x300.jpg" alt="Certification 13" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div></div></div></div></section>
  @php
    $workflowVideos = $homeVideos
      ->filter(fn ($video) => filled($video->embed_url))
      ->values();
  @endphp

  <section class="w-full py-16 px-4 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto">
      
        <header class="text-center mb-12">
          <span class="text-blue-600 font-semibold text-xs tracking-widest uppercase block mb-2">Work Flow</span>
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900">How We Make It Happen</h2>
        </header>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($workflowVideos as $video)
          <article class="group">
            <div
              id="{{ $video['slug'] }}"
              data-video-url="{{ $video->embed_url }}"
              class="relative overflow-hidden rounded-md shadow-md bg-zinc-200 aspect-square cursor-pointer transform-gpu"
            >
              <img
                src="{{ $video->thumbnail_url }}"
                alt="{{ $video['title'] }}"
                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-300"
                loading="lazy"
                decoding="async"
              >
              <div class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/0 transition-colors">
                <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 group-active:scale-95 transition-all duration-300" aria-label="Play {{ $video['title'] }}">
                  <div class="w-0 h-0 border-t-[8px] border-t-transparent border-l-[14px] border-l-white border-b-[8px] border-b-transparent ml-1"></div>
                </div>
              </div>
              <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent px-4 pb-4 pt-12">
                <h3 class="text-white text-sm font-semibold leading-snug line-clamp-2">{{ $video['title'] }}</h3>
              </div>
            </div>
            @if ($video['summary'])
              <p class="mt-3 text-sm leading-6 text-slate-600 line-clamp-2">{{ $video['summary'] }}</p>
            @endif
          </article>
        @empty
          <div class="col-span-full rounded-3xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-500 shadow-sm">
            Workflow videos will appear here after they are added from the admin panel.
          </div>
        @endforelse
      </div>
      
        <div class="flex justify-center mt-12">
          <a href="/videos" aria-label="View all workflow videos" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-12 rounded-full transition-all duration-300 uppercase text-xs tracking-wider shadow-lg active:translate-y-0.5">View All</a>
        </div>
      
    </div>
  </section>
<section class="bg-gray-100 py-16 lg:py-20"><div class="max-w-[1200px] mx-auto px-6"><div class="text-center mb-14"><h2 class="text-3xl lg:text-4xl font-bold text-[#0a2540]">What We Offer</h2><div class="w-12 h-1 bg-orange-500 mx-auto mt-3 rounded"></div></div><div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/graphic-design-icon.png" alt="Website Designing" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Website Designing</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">We create visually stunning and user-friendly websites, tailored to meet your business needs and elevate your online presence.</p><a href="/services/design" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/website-development-icon.png" alt="Website Development" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Website Development</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">We provide customized, high-quality website development services to elevate your business online.</p><a href="/services/web" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/mobile-app-icon.png" alt="Mobile App Dev" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Mobile App Dev</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Transforming ideas into reality with cutting-edge mobile app development solutions tailored to your business needs.</p><a href="/services/apps" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/graphic-design-icon.png" alt="Graphic Design" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Graphic Design</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Crafting visually stunning and impactful graphic designs to elevate your brand and captivate your audience.</p><a href="/services/graphics" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/digital-marketing-icon.png" alt="Digital Marketing" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Digital Marketing</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Driving growth through strategic digital marketing solutions, tailored to boost your online presence and engagement.</p><a href="/services/marketing" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/content-strategy-icon.png" alt="Content Strategy" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Content Strategy</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Crafting impactful content strategies to effectively communicate your brand’s story and engage your audience.</p><a href="#" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/framework-development-icon.png" alt="Framework" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Framework</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Empowering web applications with robust frameworks like CodeIgniter and Laravel for seamless performance and scalability.</p><a href="/services/laravel" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/cms-icon.png" alt="CMS Solutions" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">CMS Solutions</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Providing tailored CMS solutions with platforms like WordPress, ensuring flexibility, user-friendliness, and scalability.</p><a href="/services/wordpress" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/02/mern-stack-development-icon.png" alt="Mern Stack" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Mern Stack</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">We leverage the power of the MERN stack (MongoDB, Express.js, React.js, and Node.js) to build high-performance web applications.</p><a href="/services/mern" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div></div></div></section>
    @php
      $networkLogos = $homeClientLogos
        ->filter(fn ($clientLogo) => filled($clientLogo->logo_url))
        ->values();
      $shouldAnimateNetworkLogos = $networkLogos->count() > 4;
      $networkMarqueeDuration = max(18, $networkLogos->count() * 4);
    @endphp

    <section class="client-network-section">
      <div class="client-network-shell">
        <div class="client-network-heading">
          <p class="client-network-eyebrow">Worldwide Client Network</p>
          <h2 class="client-network-title">Our Trusted <span>Clients</span></h2>
        </div>

        @if ($networkLogos->isNotEmpty())
          @if ($shouldAnimateNetworkLogos)
            <div class="client-marquee" style="--client-marquee-duration: {{ $networkMarqueeDuration }}s;">
              <div class="client-marquee-track">
                @foreach ([0, 1] as $duplicateIndex)
                  @foreach ($networkLogos as $clientLogo)
                    <div class="client-marquee-item" @if ($duplicateIndex === 1) aria-hidden="true" @endif>
                      <img
                        src="{{ $clientLogo->logo_url }}"
                        alt="{{ $duplicateIndex === 0 ? $clientLogo['name'] : '' }}"
                        class="client-marquee-logo"
                        loading="lazy"
                        decoding="async"
                      >
                    </div>
                  @endforeach
                @endforeach
              </div>
            </div>
          @else
            <div class="client-logo-showcase-grid">
              @foreach ($networkLogos as $clientLogo)
                <div class="client-logo-showcase-item">
                  <img
                    src="{{ $clientLogo->logo_url }}"
                    alt="{{ $clientLogo['name'] }}"
                    class="client-logo-showcase-image"
                    loading="lazy"
                    decoding="async"
                  >
                </div>
              @endforeach
            </div>
          @endif
        @else
          <div class="client-network-empty">
            Client logos will appear here after they are added from the admin panel.
          </div>
        @endif

        <div class="client-network-actions">
          <a href="/clients" class="client-network-link">View All</a>
        </div>
      </div>
    </section>
  <section class="bg-[#05264e] text-white py-16 lg:py-20 overflow-hidden"><div class="max-w-[1200px] mx-auto px-6"><div class="grid lg:grid-cols-2 gap-10 items-center"><div class="flex justify-center"><img src="https://sortiqsolutions.com/wp-content/uploads/2025/01/Explore-our-Web-Desing-Development-Projects.png" alt="Portfolio" class="w-full max-w-[450px] object-contain" loading="lazy"></img></div><div><p class="text-sm text-gray-300 mb-2">Our Expertise in IT Solutions</p><h2 class="text-3xl lg:text-4xl font-bold mb-4">Bringing <span class="text-orange-500">Ideas to Life</span></h2><div class="w-12 h-1 bg-orange-500 mb-6 rounded"></div><p class="text-gray-300 leading-relaxed text-justify mb-6">Have a glimpse at the range of innovative IT solutions delivered by Sortiq Solutions Pvt. Ltd. From cutting-edge web design to seamless development, we offer end-to-end services tailored to meet your business needs. Our team is dedicated to driving digital transformation through advanced technologies and creative strategies.</p><a href="/portfolio" class="inline-block bg-orange-500 hover:bg-orange-600 transition px-6 py-3 rounded font-semibold uppercase tracking-wider">BROWSE OUR PORTFOLIO</a></div></div></div></section>
  <section data-testimonials-section class="bg-[#fcfdff] py-20 text-center px-4 overflow-hidden font-sans" style="word-spacing:0.6rem">
    <div class="mb-12">
      <h2 class="text-[32px] md:text-[46px] font-extrabold text-[#002d5b] tracking-tight">Client Success Stories</h2>
      <div class="w-16 h-1 bg-[#ff6a00] mx-auto mt-4 rounded-full"></div>
    </div>
    <div class="py-16 text-center text-[#002d5b] font-medium">Loading testimonials...</div>
  </section>

    <div class="bg-[#0b2341] py-16 text-white font-raleway">
      <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
        
          <div class="group hover:scale-105 transition duration-300 flex flex-col items-center">
            <div class="text-[#ff6a00] mb-4">
              <iconify-icon icon="lucide:briefcase-business" width="48" height="48"></iconify-icon>
            </div>
            <h2 data-count-end="756" class="text-4xl font-bold">0+</h2>
            <p class="mt-2 text-sm font-semibold tracking-wider text-gray-300 uppercase">Projects</p>
          </div>
        
          <div class="group hover:scale-105 transition duration-300 flex flex-col items-center">
            <div class="text-[#ff6a00] mb-4">
              <iconify-icon icon="lucide:users" width="48" height="48"></iconify-icon>
            </div>
            <h2 data-count-end="226" class="text-4xl font-bold">0+</h2>
            <p class="mt-2 text-sm font-semibold tracking-wider text-gray-300 uppercase">Clients</p>
          </div>
        
          <div class="group hover:scale-105 transition duration-300 flex flex-col items-center">
            <div class="text-[#ff6a00] mb-4">
              <iconify-icon icon="lucide:globe" width="48" height="48"></iconify-icon>
            </div>
            <h2 data-count-end="30" class="text-4xl font-bold">0+</h2>
            <p class="mt-2 text-sm font-semibold tracking-wider text-gray-300 uppercase">Countries</p>
          </div>
        
          <div class="group hover:scale-105 transition duration-300 flex flex-col items-center">
            <div class="text-[#ff6a00] mb-4">
              <iconify-icon icon="lucide:smile" width="48" height="48"></iconify-icon>
            </div>
            <h2 data-count-end="151" class="text-4xl font-bold">0+</h2>
            <p class="mt-2 text-sm font-semibold tracking-wider text-gray-300 uppercase">Happy Clients</p>
          </div>
        
      </div>
    </div>
  
  <section class="bg-gray-50 py-20 px-4">
    <div class="text-center mb-16">
      <h2 class="text-[32px] md:text-[42px] font-bold text-[#002d5b]">Latest Insights</h2>
      <div class="w-12 h-[3px] bg-[#ff6a00] mx-auto mt-4"></div>
    </div>
    <div id="blog-insights-grid" class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="md:col-span-3 py-24 text-center text-[#002d5b] font-medium min-h-[200px]">Loading Insights...</div>
    </div>
    <div class="text-center mt-16">
      <a href="/blog" class="bg-[#002d5b] hover:bg-[#ff6600] text-white px-10 py-4 rounded-full font-bold transition-all duration-300 shadow-lg active:scale-95">View All Insights</a>
    </div>
  </section>
</div></main>
@endsection

