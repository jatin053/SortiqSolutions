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
            <dotlottie-player id="hero-slide-player" src="{{ asset('frontend-assets/media/animations/home/custom-software-development.lottie') }}" autoplay loop></dotlottie-player>
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
      <script type="application/json" id="hero-slides-data">{"slides":[{"title":"Custom Software Development","desc":"Tailored solutions that align with your business goals. We build scalable software that enhances efficiency and drives consistent growth for your brand.","animation":"{{ asset('frontend-assets/media/animations/home/custom-software-development.lottie') }}"},{"title":"Web & Mobile App Development","desc":"From responsive websites to mobile apps, we provide end-to-end development ensuring seamless performance across all platforms and devices.","animation":"{{ asset('frontend-assets/media/animations/home/web-mobile-app-development.lottie') }}"},{"title":"Digital Transformation","desc":"Empowering businesses with innovative digital tools to streamline processes and stay ahead in the highly competitive modern market.","animation":"{{ asset('frontend-assets/media/animations/home/digital-transformation.lottie') }}"}]}</script>
    </section>
  <section class="bg-gray-100 py-16 lg:py-20 overflow-hidden"><div class="max-w-[1400px] mx-auto px-6"><div class="text-center mb-14"><h2 class="text-3xl lg:text-4xl font-bold text-[#0a2540]">Why Choose Us</h2><div class="w-12 h-1 bg-orange-500 mx-auto mt-3 rounded"></div></div><div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 text-center"><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/pages/home/strategy-first-approach.webp') }}" alt="Strategy-First Approach" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Strategy-First Approach</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">We start with understanding your business goals and target audience. Every website and marketing campaign is built with a clear strategy to drive growth and leads.</p></div><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/pages/home/conversion-driven-development.webp') }}" alt="Conversion-Driven Development" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Conversion-Driven Development</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">Our websites are designed to do more than just look good. We create user-focused, SEO-friendly content that turns visitors into paying clients.</p></div><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/pages/home/data-driven-marketing.webp') }}" alt="Data-Driven Marketing" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Data-Driven Marketing</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">To optimize campaigns, we rely on tracking, analytics, and actual performance data. Every decision is driven by insights to maximize ROI.</p></div><div class="flex flex-col items-center space-y-4 p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 md:hover:-translate-y-2 w-full will-change-transform"><div class="w-28 h-28 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/pages/home/long-term-growth-partner.webp') }}" alt="Long-Term Growth Partner" loading="lazy" width="112" height="112" class="max-w-full max-h-full object-contain"></img></div><h3 class="text-lg font-semibold text-[#0a2540]">Long-Term Growth Partner</h3><p class="text-gray-600 text-sm text-justify leading-relaxed">We don’t disappear after launch. From ongoing optimization and support to scaling your digital presence, we work as a long-term partner.</p></div></div></div></section><section class="bg-[#05264e] text-white py-12 lg:py-20 overflow-hidden"><div class="max-w-[1200px] mx-auto px-6 mb-12 lg:mb-20"><div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center"><div class="flex justify-center will-change-transform"><img src="{{ asset('frontend-assets/media/brand/partners/wix-partner-showcase.webp') }}" alt="Wix Partner" width="320" height="150" loading="lazy" class="w-48 sm:w-64 lg:w-80 object-contain"></img></div><div class="text-center lg:text-left will-change-transform"><h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-4">Proud to be a Wix Partner</h2><div class="w-12 h-1 bg-orange-500 mb-6 rounded mx-auto lg:mx-0"></div><p class="text-gray-200 text-sm md:text-base leading-relaxed mb-4">At Sortiq Solutions Pvt. Ltd., we are honored to be recognized as a certified Wix Partner. This partnership empowers us to build high-performing, visually appealing, and fully responsive websites tailored to your business goals.</p><p class="text-gray-200 text-sm md:text-base leading-relaxed">Whether you're a startup, SME, or an established brand, we simplify your digital journey so you can focus on growth.</p></div></div></div><div class="max-w-[1200px] mx-auto px-4 md:px-6"><div class="text-center mb-10 lg:mb-14"><h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold">Global Certifications &amp; Recognitions</h3><div class="w-12 h-1 bg-orange-500 mx-auto mt-3 rounded"></div></div><div class="relative overflow-hidden w-full" data-certifications-slider><div class="flex gap-4 md:gap-6 will-change-transform" data-certifications-track><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/content-marketing-certificate.webp') }}" alt="Certification 0" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/semrush-academy-certificate.webp') }}" alt="Certification 1" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/google-analytics-certificate.webp') }}" alt="Certification 2" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/wix-studio-certificate.webp') }}" alt="Certification 3" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/certified-wix-studio-certificate.webp') }}" alt="Certification 4" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/justdial-certificate.webp') }}" alt="Certification 5" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/wix-web-designer-certificate.webp') }}" alt="Certification 6" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/content-marketing-certificate.webp') }}" alt="Certification 7" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/semrush-academy-certificate.webp') }}" alt="Certification 8" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/google-analytics-certificate.webp') }}" alt="Certification 9" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/wix-studio-certificate.webp') }}" alt="Certification 10" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/certified-wix-studio-certificate.webp') }}" alt="Certification 11" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/justdial-certificate.webp') }}" alt="Certification 12" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div><div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[31%] flex-shrink-0"><div class="bg-white rounded-lg shadow-xl p-3 h-64 flex items-center justify-center"><img src="{{ asset('frontend-assets/media/brand/certifications/wix-web-designer-certificate.webp') }}" alt="Certification 13" width="300" height="300" class="w-full h-full object-contain rounded" loading="lazy"></img></div></div></div></div></div></section>
    @php
      $workflowVideos = $homeVideos
        ->filter(fn ($video) => filled($video->playback_url))
        ->values();
    @endphp

  <section class="w-full overflow-hidden bg-white px-4 py-16 lg:py-20">
    <div class="mx-auto max-w-7xl">
      <header class="mb-12 text-center">
        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.35em] text-blue-600">Work Flow</span>
        <h2 class="text-3xl font-bold text-slate-900 md:text-5xl">How We Make It Happen</h2>
      </header>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4 xl:gap-7">
        @forelse ($workflowVideos as $video)
            <article class="group">
              <div
                id="{{ $video['slug'] }}"
                data-video-type="{{ $video->playback_type }}"
                data-video-src="{{ $video->playback_url }}"
                data-video-poster="{{ $video->thumbnail_url }}"
                data-video-title="{{ $video['title'] }}"
                class="relative aspect-[5/4] cursor-pointer overflow-hidden rounded-2xl border border-slate-200 bg-slate-950 shadow-[0_16px_35px_rgba(15,23,42,0.16)] transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-[0_24px_55px_rgba(15,23,42,0.24)]"
              >
                <img
                  src="{{ $video->thumbnail_url }}"
                  alt="{{ $video['title'] }}"
                  class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                  loading="lazy"
                  decoding="async"
                >
                <div class="absolute inset-0 bg-slate-950/35 transition-colors duration-300 group-hover:bg-slate-950/20"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-black/28 via-transparent to-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                  <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#ff2a23] shadow-[0_16px_40px_rgba(255,42,35,0.35)] transition-all duration-300 group-hover:scale-110 group-active:scale-95" aria-label="Play {{ $video['title'] }}">
                    <div class="ml-1 h-0 w-0 border-y-[10px] border-y-transparent border-l-[18px] border-l-white"></div>
                  </div>
                </div>
                <div class="sr-only">{{ $video['title'] }}</div>
              </div>
            </article>
        @empty
          <div class="col-span-full rounded-3xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-500 shadow-sm">
            Workflow videos will appear here after they are added from the admin panel.
          </div>
        @endforelse
      </div>

      <div class="mt-12 flex justify-center">
        <a href="/videos" aria-label="View all workflow videos" class="inline-flex min-w-[180px] items-center justify-center rounded-full bg-orange-600 px-10 py-4 text-xs font-bold uppercase tracking-[0.24em] text-white shadow-lg transition-all duration-300 hover:bg-orange-700 active:translate-y-0.5">View All</a>
      </div>
    </div>
  </section>
<section class="bg-gray-100 py-16 lg:py-20"><div class="max-w-[1200px] mx-auto px-6"><div class="text-center mb-14"><h2 class="text-3xl lg:text-4xl font-bold text-[#0a2540]">What We Offer</h2><div class="w-12 h-1 bg-orange-500 mx-auto mt-3 rounded"></div></div><div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/graphic-design-icon.webp') }}" alt="Website Designing" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Website Designing</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">We create visually stunning and user-friendly websites, tailored to meet your business needs and elevate your online presence.</p><a href="/services/design" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/website-development-icon.webp') }}" alt="Website Development" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Website Development</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">We provide customized, high-quality website development services to elevate your business online.</p><a href="/services/web" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/mobile-app-development-icon.webp') }}" alt="Mobile App Dev" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Mobile App Dev</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Transforming ideas into reality with cutting-edge mobile app development solutions tailored to your business needs.</p><a href="/services/apps" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/graphic-design-icon.webp') }}" alt="Graphic Design" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Graphic Design</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Crafting visually stunning and impactful graphic designs to elevate your brand and captivate your audience.</p><a href="/services/graphics" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/digital-marketing-icon.webp') }}" alt="Digital Marketing" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Digital Marketing</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Driving growth through strategic digital marketing solutions, tailored to boost your online presence and engagement.</p><a href="/services/marketing" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/content-strategy-icon.webp') }}" alt="Content Strategy" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Content Strategy</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Crafting impactful content strategies to effectively communicate your brand’s story and engage your audience.</p><a href="#" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/framework-development-icon.webp') }}" alt="Framework" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Framework</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Empowering web applications with robust frameworks like CodeIgniter and Laravel for seamless performance and scalability.</p><a href="/services/laravel" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/cms-solutions-icon.webp') }}" alt="CMS Solutions" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">CMS Solutions</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">Providing tailored CMS solutions with platforms like WordPress, ensuring flexibility, user-friendliness, and scalability.</p><a href="/services/wordpress" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div><div class="group bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center"><img src="{{ asset('frontend-assets/media/pages/home/icons/mern-stack-development-icon.webp') }}" alt="Mern Stack" class="w-16 h-16 mx-auto mb-6 object-contain transition-transform duration-300 group-hover:scale-110"></img><h3 class="text-lg font-semibold text-[#0a2540] mb-3">Mern Stack</h3><p class="text-gray-600 text-sm leading-relaxed mb-6">We leverage the power of the MERN stack (MongoDB, Express.js, React.js, and Node.js) to build high-performance web applications.</p><a href="/services/mern" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300">→</a></div></div></div></section>
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
  <section class="bg-[#05264e] text-white py-16 lg:py-20 overflow-hidden"><div class="max-w-[1200px] mx-auto px-6"><div class="grid lg:grid-cols-2 gap-10 items-center"><div class="flex justify-center"><img src="{{ asset('frontend-assets/media/pages/home/portfolio-showcase.webp') }}" alt="Portfolio" class="w-full max-w-[450px] object-contain" loading="lazy"></img></div><div><p class="text-sm text-gray-300 mb-2">Our Expertise in IT Solutions</p><h2 class="text-3xl lg:text-4xl font-bold mb-4">Bringing <span class="text-orange-500">Ideas to Life</span></h2><div class="w-12 h-1 bg-orange-500 mb-6 rounded"></div><p class="text-gray-300 leading-relaxed text-justify mb-6">Have a glimpse at the range of innovative IT solutions delivered by Sortiq Solutions Pvt. Ltd. From cutting-edge web design to seamless development, we offer end-to-end services tailored to meet your business needs. Our team is dedicated to driving digital transformation through advanced technologies and creative strategies.</p><a href="{{ route('frontend.portfolio') }}" class="inline-block bg-orange-500 hover:bg-orange-600 transition px-6 py-3 rounded font-semibold uppercase tracking-wider">BROWSE OUR PORTFOLIO</a></div></div></div></section>
  @include('components.frontend-testimonials')

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
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
      @forelse ($homeInsights as $blog)
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
                <span class="group-hover/btn:translate-x-2 transition-transform duration-300">&rarr;</span>
              </a>
            </div>
          </div>
        </article>
      @empty
        <div class="md:col-span-3 py-24 text-center text-[#002d5b] font-medium min-h-[200px]">
          No insights available at the moment.
        </div>
      @endforelse
    </div>
    <div class="text-center mt-16">
      <a href="/blog" class="bg-[#002d5b] hover:bg-[#ff6600] text-white px-10 py-4 rounded-full font-bold transition-all duration-300 shadow-lg active:scale-95">View All Insights</a>
    </div>
  </section>
</div></main>
@endsection
