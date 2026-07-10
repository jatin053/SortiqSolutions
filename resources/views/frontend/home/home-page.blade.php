@extends('layouts.frontend')

@section('title', 'Sortiq Solutions Pvt. Ltd.')
@section('body_attributes') data-route="/" @endsection

@push('head')
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <style>
        .sortiq-home-slider-iframe {
          width: 100%;
          height: 600px;
          border: none;
          display: block;
        }
        @media (max-width: 991px) {
          .sortiq-home-slider-iframe {
            height: 520px;
          }
        }
        @media (max-width: 767px) {
          .sortiq-home-slider-iframe {
            height: 560px;
          }
        }

        /* Commented out existing local slider styles
        #root.sortiq-home-slider-root > main { margin: 0; }
        #root.sortiq-home-slider-root > main > section {
          width: 100%;
          display: flex;
          justify-content: center;
          margin-top: 0;
          background: #001b48;
        }
        #root.sortiq-home-slider-root > main > section > div {
          width: 100%;
          max-width: 1880px;
          height: 600px;
          display: flex;
          justify-content: space-between;
          position: relative;
          overflow: hidden;
          padding: 0 40px;
          background-image: url('/frontend-assets/slides/images/final.jpg');
          background-size: cover;
          background-position: center;
          box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25);
        }
        #root.sortiq-home-slider-root > main > section > div > div {
          width: 33.3333%;
          height: 100%;
        }
        #root.sortiq-home-slider-root canvas { display: block; }
        #root.sortiq-home-slider-root > main > section > div > div:first-child,
        #root.sortiq-home-slider-root > main > section > div > div:last-child {
          display: flex;
          align-items: center;
        }
        #root.sortiq-home-slider-root > main > section > div > div:nth-child(2) {
          align-self: flex-start;
          padding-top: 56px;
          color: #fff;
          text-align: center;
          z-index: 10;
        }
        #root.sortiq-home-slider-root h1 {
          margin: 0;
          color: #fff;
          font-size: 48px;
          line-height: 1.25;
          font-weight: 700;
        }
        #root.sortiq-home-slider-root p {
          margin-top: 12px;
          color: #fff;
        }
        @media (max-width: 991px) {
          #root.sortiq-home-slider-root > main > section > div {
            height: 520px;
            padding: 0 18px;
          }
          #root.sortiq-home-slider-root h1 { font-size: 34px; }
        }
        @media (max-width: 767px) {
          #root.sortiq-home-slider-root > main > section > div {
            height: 560px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 14px;
          }
          #root.sortiq-home-slider-root > main > section > div > div {
            width: 100%;
            height: 33.3333%;
          }
          #root.sortiq-home-slider-root > main > section > div > div:nth-child(2) {
            order: -1;
            height: auto;
            padding-top: 0;
          }
          #root.sortiq-home-slider-root h1 { font-size: 30px; }
        }
        */
        .hm-cert-slider { display: block; }
        .hm-cert-viewport { width: 100%; overflow: hidden; }
        .hm-cert-track {
          display: flex;
          gap: 24px;
          transition: transform .65s cubic-bezier(.22, 1, .36, 1);
          will-change: transform;
        }
        .hm-cert-card {
          flex: 0 0 calc((100% - 48px) / 3);
          min-width: 0;
        }
        .hm-cert-card img { display: block; width: 100%; height: auto; }
        .hm-cert-dots {
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 9px;
          margin-top: 28px;
        }
        .hm-cert-dot {
          appearance: none;
          width: 9px;
          height: 9px;
          padding: 0;
          border: 0;
          border-radius: 999px;
          background: rgba(255,255,255,.42);
          cursor: pointer;
          transition: width .35s ease, background-color .35s ease, transform .35s ease;
        }
        .hm-cert-dot.active {
          width: 28px;
          background: #ff6a00;
          transform: scaleY(1.1);
        }
        @media (max-width: 767px) {
          .hm-cert-track { gap: 16px; }
          .hm-cert-card { flex-basis: 100%; }
        }
        .hm-video-card,
        .hm-video-thumb { position: relative; pointer-events: auto !important; }
        .hm-video-card::before,
        .hm-video-card::after,
        .hm-video-thumb::before,
        .hm-video-thumb::after { pointer-events: none; }
        .hm-video-thumb iframe {
          position: relative;
          z-index: 20;
          display: block;
          pointer-events: auto !important;
        }
        .hm-clients-section .hm-section-head {
          position: relative;
          z-index: 5;
        }
        .hm-clients-section .hm-clients-title {
          position: relative;
          z-index: 6;
          color: #101a1f !important;
          background: transparent !important;
          background-image: none !important;
          -webkit-background-clip: initial !important;
          background-clip: initial !important;
          -webkit-text-fill-color: #101a1f !important;
          font-weight: 700 !important;
          opacity: 1 !important;
          filter: none !important;
          mix-blend-mode: normal !important;
          -webkit-mask-image: none !important;
          mask-image: none !important;
        }
        .hm-clients-section .hm-clients-title .hm-orange {
          color: #ff5a00 !important;
          background: transparent !important;
          background-image: none !important;
          -webkit-text-fill-color: #ff5a00 !important;
          opacity: 1 !important;
          filter: none !important;
          mix-blend-mode: normal !important;
          -webkit-mask-image: none !important;
          mask-image: none !important;
        }
        .hm-testimonials-section .hm-ts-card {
          position: relative;
          overflow: visible !important;
          padding: 26px 24px 52px !important;
          border: 0 !important;
          border-radius: 0 !important;
          background: #fff !important;
          box-shadow: none !important;
        }
        .hm-testimonials-section .hm-ts-stars {
          display: none !important;
        }
        .hm-testimonials-section .hm-ts-quote {
          max-width: 1180px;
          margin: 0 auto !important;
          color: #171717 !important;
          font-size: clamp(16px, 1.35vw, 20px) !important;
          font-style: normal !important;
          font-weight: 400 !important;
          line-height: 1.65 !important;
          text-align: center !important;
          opacity: 1 !important;
        }
        .hm-testimonials-section .hm-ts-card::before {
          content: "";
          position: absolute;
          bottom: 22px;
          left: 50%;
          width: 266px;
          height: 1px;
          background: #c5c5c5;
          transform: translateX(-50%);
        }
        .hm-testimonials-section .hm-ts-card::after {
          content: "";
          position: absolute;
          bottom: 14px;
          left: 50%;
          width: 16px;
          height: 16px;
          border-bottom: 1px solid #c5c5c5;
          border-left: 1px solid #c5c5c5;
          background: #fff;
          transform: translateX(-50%) rotate(-45deg);
        }
        .hm-testimonials-section {
          min-height: 440px;
          padding: 54px 0 58px !important;
          background: #fff !important;
        }
        .hm-testimonials-section .hm-ts-inner {
          width: 100%;
          max-width: 1500px;
          margin: 0 auto;
          padding: 0 24px;
        }
        .hm-testimonials-section .hm-section-head {
          margin: 0 0 12px !important;
          text-align: center !important;
        }
        .hm-testimonials-section .hm-section-head h2 {
          margin: 0 !important;
          color: #001b48 !important;
          font-size: clamp(27px, 2vw, 35px) !important;
          font-weight: 600 !important;
          line-height: 1.25 !important;
          text-align: center !important;
        }
        .hm-testimonials-section .hm-section-head .hm-line {
          width: 40px !important;
          height: 3px !important;
          margin: 28px auto 20px !important;
          background: #ff5a00 !important;
        }
        .hm-testimonials-section .hm-ts-slider {
          width: 100%;
          overflow: hidden;
        }
        .hm-testimonials-section .hm-ts-track {
          display: flex;
          align-items: stretch;
        }
        .hm-testimonials-section .hm-ts-card {
          flex: 0 0 100% !important;
          width: 100% !important;
          min-width: 100% !important;
        }
        .hm-testimonials-section .hm-ts-quote {
          max-width: 1120px !important;
          min-height: 88px;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .hm-testimonials-section .hm-ts-dots-container {
          margin-top: 20px !important;
        }
        .hm-testimonials-section .hm-ts-dots {
          display: flex !important;
          align-items: center;
          justify-content: center;
          gap: clamp(35px, 6vw, 95px) !important;
        }
        .hm-testimonials-section .hm-ts-thumb {
          align-items: center !important;
          gap: 14px !important;
          padding: 0 !important;
          border: 0 !important;
          background: transparent !important;
          color: #ff5a00 !important;
          font-size: 18px !important;
          font-weight: 600 !important;
          white-space: nowrap;
          cursor: pointer;
        }
        .hm-testimonials-section .hm-ts-thumb img {
          width: 54px !important;
          height: 54px !important;
          border: 2px solid transparent;
          border-radius: 50% !important;
          object-fit: cover;
        }
        .hm-testimonials-section .hm-ts-thumb.active img {
          border-color: #ff5a00 !important;
        }
        @media (max-width: 767px) {
          .hm-testimonials-section { min-height: 0; padding: 42px 0 !important; }
          .hm-testimonials-section .hm-ts-inner { padding: 0 16px; }
          .hm-testimonials-section .hm-ts-card { padding: 20px 8px 48px !important; }
          .hm-testimonials-section .hm-ts-quote { min-height: 0; font-size: 16px !important; }
          .hm-testimonials-section .hm-ts-dots { gap: 16px !important; }
          .hm-testimonials-section .hm-ts-thumb span { display: none; }
        }
      </style>
@endpush

@section('content')
<main class="sortiq-home font-raleway"><div class="font-raleway">
<!-- Vercel Deployed Slider Iframe -->
<iframe src="https://slides-jatin-choudhary.vercel.app/" class="sortiq-home-slider-iframe" title="Sortiq Home Slider" scrolling="no"></iframe>

<!-- Commented out existing local slider root
<div id="root" class="sortiq-home-slider-root"></div>
-->
<section class="hm-why-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full hm-why-container">
    <div class="hm-why-head">
      <h2>Why Choose Us</h2>
      <div class="hm-why-accent-bar" aria-hidden="true"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 lg:gap-10 justify-items-center w-full">
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/tech-expertise-image.webp') }}" alt="Tech Expertise"></div>
          <h5>Strategy-First Approach</h5>
          <p>We start with understanding your business goals and target audience. Every website and marketing campaign is built with a clear strategy to drive growth and leads.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/custom-solutions-image.webp') }}" alt="Custom Solutions"></div>
          <h5>ConverDriven Development</h5>
          <p>Our websites are designed to do more than just look good. We create user-focused, SEO-friendly content that turns visitors into paying clients.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/quality-and-timeless-image.webp') }}" alt="Quality &amp; Timeliness"></div>
          <h5>Data-Driven Marketing</h5>
          <p>To optimize campaigns, we rely on tracking, analytics, and actual performance data. Every decision is driven by insights to maximize ROI and reduce wasted ad spend.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/online-support-icon.webp') }}" alt="On-Going Support"></div>
          <h5>Long-Term Growth Partner</h5>
          <p>We don’t disappear after launch. From ongoing optimization and support to scaling your digital presence, we work as a long-term partner in your business growth.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== WIX PARTNER + CERTIFICATIONS (navy, same copy as live site) ===================== -->
<section class="hm-wix-section">

  <div class="max-w-[1200px] mx-auto px-4 w-full hm-wix-why-row">

    <div class="hm-section-head text-center lg:px-12">
      <h2 style="color: #fff;">Proud to be a Wix Partner</h2>
      <div class="hm-line mx-auto"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center w-full">

      <div class="w-full">
        <p class="hm-wix-text">
          At Sortiq Solutions Pvt. Ltd., we are honored to be recognized as a certified Wix Partner. This partnership empowers us to build high-performing, visually appealing, and fully responsive websites tailored to your business goals. With Wix’s powerful tools and our technical expertise, we bring your ideas to life—seamlessly, efficiently, and with stunning design precision.
        </p>

        <p class="hm-wix-text mb-0">
          Whether you’re a startup, SME, or an established brand, we’re here to create a digital presence that stands out. We simplify the digital journey so you can focus on growing your business. Let’s build something amazing together with Wix.
        </p>
      </div>

      <div class="w-full text-center">
        <div class="hm-wix-badge-wrap">
          <a href="https://www.wix.com/studio/community/partners/sortiq-solutions-pvt-ltd"
             target="_blank"
             rel="noopener noreferrer"
             aria-label="View Sortiq Solutions on Wix Studio">
            <img src="{{ asset('frontend-assets/media/home/badges/EN_legend_small.webp') }}"
                 alt="Wix Partner"
                 class="hm-wix-img">
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- CERTIFICATION SECTION -->
  <div class="hm-certs-inner">

    <div class="hm-section-head text-center hm-certs-head">
      <h2 style="color: #fff;">Global Certifications &amp; Recognitions</h2>
      <div class="hm-line mx-auto"></div>
    </div>

    <div class="hm-cert-slider">
      <!-- SLIDER -->
      <div class="hm-cert-viewport">

        <div class="hm-cert-track">

          <!-- CARD -->
          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/wix-web-designer-300x300.jpg') }}" alt="">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/Digital-Advertising-300x300.jpg') }}" alt="">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/social-media-certified-300x300.jpg') }}" alt="">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/wix-studio-300x300.jpg') }}" alt="">
          </div>

        </div>

      </div>

      <div class="hm-cert-dots" aria-label="Certificate slides"></div>

    </div>

  </div>

</section>

<!-- ===================== HOW WE MAKE IT HAPPEN (VIDEOS) ===================== -->
<section class="hm-videos-section">
  <div class="hm-videos-wrap">
    <div class="hm-section-head text-center hm-videos-head">
      <span class="hm-workflow-badge">Work Flow</span>
      <h2>How We Make It Happen</h2>
    </div>
    <div class="hm-video-grid">
            @foreach($homeVideos as $video)
        <div class="hm-video-card">
          <div class="hm-video-thumb">
            <iframe loading="lazy" src="{{ $video->playback_url }}" title="{{ $video->title ?? 'Video' }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
        @endforeach
      </div>
    <div class="hm-videos-footer">
      <a href="https://www.youtube.com/@SortiqSolutions" target="_blank" rel="noopener" class="hm-btn-orange">VIEW ALL</a>
    </div>
  </div>
</section>

<!-- ===================== WHAT WE OFFER (SERVICES) ===================== -->
<section class="hm-services-section hm-reveal-up">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <h2 style="color: #00173E;">What We Offer</h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-10 justify-items-center w-full">
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/graphic-design-icon.png') }}" alt="Website Designing"></div>
          <h5>Website Designing</h5>
          <p>We create visually stunning and user-friendly websites, tailored to meet your business needs and elevate your online presence.</p>
          <a href="{{ url('/website-designing-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/website-development-icon.png') }}" alt="Website Development"></div>
          <h5>Website Development</h5>
          <p>We provide customized, high-quality website development services to elevate your business online.</p>
          <a href="{{ url('/website-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/mobile-app-icon.png') }}" alt="Mobile App Dev"></div>
          <h5>Mobile App Dev</h5>
          <p>Transforming ideas into reality with cutting-edge mobile app development solutions tailored to your business needs.</p>
          <a href="{{ url('/app-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/graphic-design-icon.png') }}" alt="Graphic Design"></div>
          <h5>Graphic Design</h5>
          <p>Crafting visually stunning and impactful graphic designs to elevate your brand and captivate your audience.</p>
          <a href="{{ url('/graphic-designing-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/digital-marketing-icon.png') }}" alt="Digital Marketing"></div>
          <h5>Digital Marketing</h5>
          <p>Driving growth through strategic digital marketing solutions, tailored to boost your online presence and engagement.</p>
          <a href="{{ url('/digital-marketing-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/content-strategy-icon.png') }}" alt="Content Strategy"></div>
          <h5>Content Strategy</h5>
          <p>Crafting impactful content strategies to effectively communicate your brand's story and engage your audience.</p>
          <a href="{{ url('/seo-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/framework-development-icon.png') }}" alt="Framework"></div>
          <h5>Framework</h5>
          <p>Empowering web applications with robust frameworks like CodeIgniter and Laravel for seamless performance and scalability.</p>
          <a href="{{ url('/laravel-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/cms-icon.png') }}" alt="CMS Solutions"></div>
          <h5>CMS Solutions</h5>
          <p>Providing tailored CMS solutions with platforms like WordPress, ensuring flexibility, user-friendliness, and scalability for your website.</p>
          <a href="{{ url('/wordpress-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/mern-stack-development-icon.png') }}" alt="Mern Stack"></div>
          <h5>Mern Stack</h5>
          <p>We leverage the power of the MERN stack (MongoDB, Express.js, React.js, and Node.js) to build high-performance web applications.</p>
          <a href="{{ url('/mern-stack-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TRUSTED CLIENTS ===================== -->
<section class="hm-clients-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <span class="hm-sub-labelx">Worldwide Client Network</span>
      <h2 class="hm-clients-title">Our Trusted <span class="hm-orange">Clients</span></h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="hm-clients-wrap">
  <div class="hm-clients-track">

    <!-- Original Logos -->
      @foreach($homeClientLogos as $logo)
      <div class="hm-client-slide">
        <div class="hm-client-logo">
          <img src="{{ $logo->logo_url }}" alt="{{ $logo->name }}">
        </div>
      </div>
      @endforeach

      <!-- Duplicate Logos for Infinite Loop -->
      @foreach($homeClientLogos as $logo)
      <div class="hm-client-slide">
        <div class="hm-client-logo">
          <img src="{{ $logo->logo_url }}" alt="{{ $logo->name }}">
        </div>
      </div>
      @endforeach
    </div>
  </div>
      <div class="text-center mt-5">
      <a href="/clients/" class="hm-btn-orange">VIEW ALL</a>
    </div>
  </div>
</section>

<!-- ===================== EXPERTISE / BRINGING IDEAS TO LIFE ===================== -->
<section class="hm-expertise-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center w-full">
      <div class="w-full text-center hm-expertise-image">
        <img src="{{ asset('frontend-assets/media/home/Explore-our-Web-Desing-Development-Projects.png') }}" alt="Our Expertise" class="img-fluid hm-expertise-img">
      </div>
      <div class="w-full hm-expertise-copy">
        <span class="hm-sub-label">Our Expertise in IT Solutions</span>
        <h2 class="hm-expertise-title">Bringing <span class="hm-orange">Ideas to Life </span></h2>
        <!-- white accent line below heading -->
         <div class="hx-line" style="margin-bottom: 20px;"></div>
        <p class="hm-expertise-desc">Have a glimpse at the range of innovative IT solutions delivered by Sortiq Solutions Pvt Ltd. From cutting-edge web design to seamless development, we offer end-to-end services tailored to meet your business needs. Our team is dedicated to driving digital transformation through advanced technologies and creative strategies. With a focus on quality, we empower businesses to achieve sustainable growth.</p>
        <a href="/portfolios/" class="hm-btn-dark mt-3 d-inline-flex">BROWSE OUR PORTFOLIO <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon></a>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TESTIMONIALS ===================== -->
<section class="hm-testimonials-section">

  <div class="hm-ts-inner">

    <div class="hm-section-head">
      <h2>What Our Clients Are Saying</h2>
      <div class="hm-line"></div>
    </div>

    <div class="hm-ts-slider">

      <div class="hm-ts-track" id="hmTsTrack">

        @foreach($homeReviews as $testimonial)
          <div class="hm-ts-card">
            <div class="hm-ts-stars">
              @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)&#9733;@endfor
            </div>
            <p class="hm-ts-quote">
              &ldquo; {{ strip_tags($testimonial->content) }} &rdquo;
            </p>
          </div>
          @endforeach</div>

    </div>

    <!-- USERS -->
    <div class="hm-ts-dots-container">
      <div class="hm-ts-dots" id="hmTsDots">

      @foreach($homeReviews as $index => $testimonial)
        <button class="hm-ts-thumb {{ $index === 0 ? 'active' : '' }}">
          <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . (($index % 6) + 1) . '.jpg') }}" alt="{{ $testimonial->name }}">
          <span>{{ $testimonial->name }}</span>
        </button>
      @endforeach
      </div>
    </div>
  </div>

</section>

<!-- ===================== STATS BANNER ===================== -->
<section class="hm-stats-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center text-center w-full">
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/projects-icon.png') }}" alt="Projects"></div>
          <h2 class="hm-stat-num" data-target="750">0</h2><span class="hm-stat-plus">+</span>
          <p>PROJECTS</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/happy-clients.png') }}" alt="Clients"></div>
          <h2 class="hm-stat-num" data-target="225">0</h2><span class="hm-stat-plus">+</span>
          <p>CLIENTS</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/country-vector.png') }}" alt="Countries"></div>
          <h2 class="hm-stat-num" data-target="30">0</h2><span class="hm-stat-plus">+</span>
          <p>COUNTRIES</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/happy-face-icon.png') }}" alt="Happy Clients"></div>
          <h2 class="hm-stat-num" data-target="150">0</h2><span class="hm-stat-plus">+</span>
          <p>HAPPY CLIENTS</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== LATEST INSIGHTS (BLOG) ===================== -->
<section class="hm-blog-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <h2>Latest Insights</h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="hm-blog-grid-wrap mx-auto" style="max-width: 1100px;">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @foreach($homeInsights as $blog)
          @php
            $excerpt = $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 100);
            $category = $blog->category ?: 'Uncategorized';
          @endphp
          <div class="w-full">
            <div class="hm-blog-card">
              <div class="hm-blog-img">
                <a href="{{ route('frontend.blog.show', $blog->slug) }}">
                  <img src="{{ $blog->image_url ?: asset('frontend-assets/media/blog-placeholder.jpg') }}" alt="{{ $blog->title }}">
                </a>
              </div>
              <div class="hm-blog-body">
                <div class="hm-blog-meta">
                  <span style="display: inline-flex; align-items: center; gap: 4px;">
                    <iconify-icon icon="lucide:clock" style="color: #ff6a00;"></iconify-icon>
                    {{ $blog->published_at ? $blog->published_at->format('F d, Y') : '' }}
                  </span>
                  <span style="display: inline-flex; align-items: center; gap: 4px; margin-left: 12px;">
                    <iconify-icon icon="lucide:folder" style="color: #ff6a00;"></iconify-icon>
                    {{ $category }}
                  </span>
                </div>
                <h3><a href="{{ route('frontend.blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                <p>{{ $excerpt }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
      <div class="text-center mt-5">
      <a href="/blog/" class="hm-btn-orange" style="border-radius: 50px; padding: 8px 25px; font-weight: 700;">VIEW ALL</a>
    </div>
  </div>
</section>
</div></main>
@endsection
@push('scripts')
<!-- Commented out existing local slider module script
<script type="module" src="{{ asset('frontend-assets/slides/assets/index-Cb-szkCw.js') }}"></script>
-->
<script src="{{ asset('frontend-assets') }}/js/index.js"></script>

<script>
/* ---- Mobile Menu Toggle ---- */
(function() {
  const toggle = document.querySelector('.sq-mobile-open');
  const close = document.querySelector('.sq-mobile-close');
  const overlay = document.querySelector('.sq-mobile-overlay');
  const body = document.body;

  if (toggle) {
    toggle.addEventListener('click', () => body.classList.add('sq-mobile-active'));
  }
  if (close) {
    close.addEventListener('click', () => body.classList.remove('sq-mobile-active'));
  }
  if (overlay) {
    overlay.addEventListener('click', () => body.classList.remove('sq-mobile-active'));
  }

  // Accordion for mobile menu
  const accs = document.querySelectorAll('.sq-drawer-acc');
  accs.forEach(acc => {
    acc.addEventListener('click', function() {
      this.classList.toggle('is-active');
      const panel = this.nextElementSibling;
      if (panel) {
        panel.classList.toggle('is-open');
      }
    });
  });
})();

/* ============================================================
   HOMEPAGE SCRIPTS
   ============================================================ */

(function() {
  var track = document.querySelector('.hm-clients-track');
  if (!track) return;

  function scrollCards(direction) {
    var step = track.clientWidth * 0.8;
    var nextPos = direction === 'prev' ? track.scrollLeft - step : track.scrollLeft + step;
    if (nextPos >= track.scrollWidth - track.clientWidth) {
      nextPos = 0;
    }
    if (nextPos < 0) {
      nextPos = track.scrollWidth - track.clientWidth;
    }
    track.scrollTo({ left: nextPos, behavior: 'smooth' });
  }

  var autoId = setInterval(function() { scrollCards('next'); }, 3500);
  track.addEventListener('mouseenter', function() { clearInterval(autoId); });
  track.addEventListener('mouseleave', function() { autoId = setInterval(function() { scrollCards('next'); }, 3500); });
})();

/* ---- Counter Animation ---- */
(function() {
  var counters = document.querySelectorAll('.hm-stat-num');
  if (!counters.length) return;

  var observed = false;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting && !observed) {
        observed = true;
        counters.forEach(function(el) {
          var target = parseInt(el.getAttribute('data-target'), 10);
          var duration = 1800;
          var step = Math.ceil(target / (duration / 16));
          var current = 0;
          var timer = setInterval(function() {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = current;
          }, 16);
        });
      }
    });
  }, { threshold: 0.4 });

  var statsSection = document.querySelector('.hm-stats-section');
  if (statsSection) observer.observe(statsSection);
})();

(function() {
  var section = document.querySelector('.hm-expertise-section');
  if (!section) return;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        section.classList.add('is-visible');
        observer.unobserve(section);
      }
    });
  }, { threshold: 0.2 });
  observer.observe(section);
})();

/* ---- Services Reveal ---- */
(function() {
  var section = document.querySelector('.hm-services-section');
  if (!section) return;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        section.classList.add('is-visible');
        observer.unobserve(section);
      }
    });
  }, { threshold: 0.15 });
  observer.observe(section);
})();

document.addEventListener("DOMContentLoaded", function () {
  var track = document.querySelector(".hm-cert-track");
  var viewport = document.querySelector(".hm-cert-viewport");
  var dotsWrap = document.querySelector(".hm-cert-dots");
  var cards = track ? Array.from(track.querySelectorAll(".hm-cert-card")) : [];
  if (!track || !viewport || !dotsWrap || !cards.length) return;

  /* Repeat the first two cards so every desktop position still shows three. */
  cards.slice(0, 2).forEach(function (card) {
    var clone = card.cloneNode(true);
    clone.setAttribute("aria-hidden", "true");
    track.appendChild(clone);
  });

  var current = 0;
  var timer;

  function pageCount() {
    return cards.length;
  }

  function cardStep() {
    if (cards.length < 2) return cards[0].offsetWidth;
    return cards[1].offsetLeft - cards[0].offsetLeft;
  }

  function renderDots() {
    dotsWrap.innerHTML = "";
    for (var i = 0; i < pageCount(); i++) {
      var dot = document.createElement("button");
      dot.type = "button";
      dot.className = "hm-cert-dot" + (i === current ? " active" : "");
      dot.setAttribute("aria-label", "Show certificate set " + (i + 1));
      dot.dataset.index = i;
      dot.addEventListener("click", function () {
        goTo(Number(this.dataset.index));
        restartAutoplay();
      });
      dotsWrap.appendChild(dot);
    }
  }

  function goTo(index) {
    current = index % pageCount();
    track.style.transform = "translateX(-" + (current * cardStep()) + "px)";
    Array.from(dotsWrap.children).forEach(function (dot, i) {
      dot.classList.toggle("active", i === current);
    });
  }

  function restartAutoplay() {
    clearInterval(timer);
    if (pageCount() > 1) {
      timer = setInterval(function () { goTo(current + 1); }, 3500);
    }
  }

  window.addEventListener("resize", function () {
    current = Math.min(current, pageCount() - 1);
    renderDots();
    goTo(current);
    restartAutoplay();
  });

  renderDots();
  goTo(0);
  restartAutoplay();

  viewport.addEventListener("mouseenter", function () { clearInterval(timer); });
  viewport.addEventListener("mouseleave", restartAutoplay);
});

document.addEventListener("DOMContentLoaded", function() {
  var track = document.getElementById("hmTsTrack");
  var thumbs = document.querySelectorAll(".hm-ts-thumb");
  var cards = track ? Array.from(track.querySelectorAll(".hm-ts-card")) : [];
  var slider = document.querySelector(".hm-ts-slider");
  if (!track || !cards.length || !thumbs.length || !slider) return;

  // INFINITE LOOP SETUP: Clone elements for seamless transition
  var firstClone = cards[0].cloneNode(true);
  var lastClone = cards[cards.length - 1].cloneNode(true);
  track.appendChild(firstClone);
  track.insertBefore(lastClone, track.firstChild);

  // Update cards array to include clones
  var allCards = Array.from(track.querySelectorAll(".hm-ts-card"));
  var totalReal = cards.length;
  var current = 1; // Start at the first real card (after the lastClone)
  var isTransitioning = false;

  function getStep() {
    var style = window.getComputedStyle(allCards[0]);
    var margin = parseFloat(style.marginLeft || 0) + parseFloat(style.marginRight || 0);
    return allCards[0].offsetWidth + margin;
  }

  function moveSlide(index, animate = true) {
    if (isTransitioning && animate) return;
    if (animate) isTransitioning = true;

    current = index;
    var step = getStep();
    var sliderWidth = slider.offsetWidth;
    var cardWidth = allCards[current].offsetWidth;
    
    // Centering the current card
    var mainTranslateX = (sliderWidth / 2) - (cardWidth / 2) - (current * step);
    
    track.style.transition = animate ? "transform .85s cubic-bezier(.16, 1, .3, 1)" : "none";
    track.style.transform = "translateX(" + mainTranslateX + "px)";

    // Update active states
    var realIdx = (current - 1 + totalReal) % totalReal;
    
    allCards.forEach(function(card, idx) {
      card.classList.toggle("active", idx === current);
    });

    thumbs.forEach(function(thumb, idx) {
      var isCenter = (idx === realIdx);
      var isPrev = (idx === (realIdx - 1 + totalReal) % totalReal);
      var isNext = (idx === (realIdx + 1) % totalReal);
      
      thumb.classList.toggle("active", isCenter);
      
      // Only show current, previous and next
      if (isCenter || isPrev || isNext) {
        thumb.style.display = "flex";
        thumb.style.opacity = isCenter ? "1" : "0.4";
        thumb.style.filter = isCenter ? "blur(0)" : "blur(1px)";
        
        // Order them: prev, center, next
        if (isPrev) thumb.style.order = "1";
        if (isCenter) thumb.style.order = "2";
        if (isNext) thumb.style.order = "3";
      } else {
        thumb.style.display = "none";
      }
    });

    // Centers the 3-item dots container
    var dotsContainer = document.getElementById("hmTsDots");
    if (dotsContainer) {
      dotsContainer.style.justifyContent = "center";
      dotsContainer.style.transform = "none";
      dotsContainer.style.width = "auto";
      dotsContainer.style.margin = "auto";
    }
  }

  // Handle seamless snap-back at the end of transition
  track.addEventListener("transitionend", function() {
    isTransitioning = false;
    if (current === 0) {
      moveSlide(totalReal, false);
    } else if (current === totalReal + 1) {
      moveSlide(1, false);
    }
  });

  thumbs.forEach(function(thumb, idx) {
    thumb.addEventListener("click", function() {
      moveSlide(idx + 1);
    });
  });

  window.addEventListener("resize", function() {
    moveSlide(current, false);
  });

  // Initial call
  moveSlide(1, false);

  // Auto-play
  setInterval(function() {
    if (!isTransitioning) moveSlide(current + 1);
  }, 6000);
});
</script>
</body>
@endpush












