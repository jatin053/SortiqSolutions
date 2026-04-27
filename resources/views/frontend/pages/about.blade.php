@extends('layouts.frontend')

@section('title', 'About Sortiq Solutions')
@section('body_attributes') data-route="/about" @endsection

@section('content')
<main class="font-raleway"><div class="font-raleway text-gray-800 bg-white overflow-hidden"><div class="relative h-[160px] md:h-[220px] bg-[#00142e] flex items-center justify-center overflow-hidden"><div class="absolute inset-0 opacity-40 bg-[url('{{ asset('frontend-assets/media/pages/about/about-hero.webp') }}')] bg-cover bg-center"></div><div class="relative text-center z-10 px-4"><h1 class="text-white text-3xl md:text-5xl font-bold mb-2 tracking-tight">About Us</h1><div class="w-12 h-1 bg-orange-500 mx-auto rounded-full"></div></div></div><section class="max-w-7xl mx-auto py-12 md:py-24 px-6 lg:px-20"><div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20"><div class="w-full lg:w-3/5 space-y-6 text-center lg:text-left order-2 lg:order-1"><h2 class="text-[#00215e] text-2xl md:text-4xl font-bold">About Us</h2><div class="w-10 h-1 bg-orange-500 -mt-4 mx-auto lg:mx-0 rounded-full"></div><div class="space-y-4 text-gray-600 leading-relaxed text-base md:text-lg text-justify lg:text-left"><p>At <span class="font-semibold text-[#00215e]">Sortiq Solutions Pvt. Ltd.</span>, innovation, excellence, and customer success are at the heart of everything we do. We work closely with our clients to have an in-depth understanding of their business challenges and deliver tailored <span class="font-semibold text-[#00215e]">IT solutions</span> that add significant value.</p><p>Our approach goes beyond technology; we believe in ethics, transparency, and responsibility, ensuring our work positively impacts both businesses and the people they serve.</p><p>By consistently delivering reliable, high-quality solutions, we focus on building long-term partnerships rather than one-time projects. We stay ahead of emerging technologies to help businesses confidently navigate digital transformation.</p></div></div><div class="w-full lg:w-2/5 flex justify-center order-1 lg:order-2"><div class="relative p-3 md:p-4 bg-[#00215e] w-full max-w-[260px] sm:max-w-sm aspect-[4/5] shadow-2xl"><div class="absolute top-0 bottom-0 left-1/2 -translate-x-1/2 w-1/3 bg-orange-100/10 z-0"></div><img src="{{ asset('frontend-assets/media/pages/about/about-team-photo.webp') }}" alt="Our Team" class="relative z-10 w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000"></img></div></div></div></section><div class="max-w-7xl mx-auto px-6 lg:px-20 pb-16 md:pb-24"><div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-4 lg:gap-8 items-stretch"><div class="group bg-[#1a233a] text-white hover:bg-orange-600 p-8 md:p-10 rounded-br-[60px] md:rounded-br-[100px] shadow-lg flex flex-col items-center justify-center min-h-[320px] md:min-h-[400px] transition-all duration-500 ease-in-out hover:-translate-y-2"><h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Our Vision</h3><p class="text-sm md:text-base leading-relaxed text-gray-200 group-hover:text-white text-center transition-colors duration-500">To become a trusted global technology partner by enabling businesses of all sizes to embrace digital transformation with confidence and measurable results.</p></div><div class="group bg-[#e9cfc0] text-gray-900 hover:bg-orange-600 hover:text-white p-8 md:p-10 rounded-t-[60px] md:rounded-t-[100px] shadow-xl flex flex-col items-center justify-center min-h-[320px] md:min-h-[400px] md:-translate-y-4 transition-all duration-500 ease-in-out hover:md:-translate-y-8"><h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Our Mission</h3><p class="text-sm md:text-base leading-relaxed text-center font-medium group-hover:font-normal transition-colors duration-500">To deliver innovative, reliable, and scalable IT solutions that simplify digital challenges and help businesses achieve sustainable and measurable growth.</p></div><div class="group bg-[#1a233a] text-white hover:bg-orange-600 p-8 md:p-10 rounded-bl-[60px] md:rounded-bl-[100px] shadow-lg flex flex-col items-center justify-center min-h-[320px] md:min-h-[400px] transition-all duration-500 ease-in-out hover:-translate-y-2"><h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Our Core Values</h3><p class="text-sm md:text-base leading-relaxed text-gray-200 group-hover:text-white text-center transition-colors duration-500">Integrity, innovation, transparency, and customer success guide our decisions and strengthen our client relationships for a long-lasting impact.</p></div></div></div></div><section class="max-w-7xl mx-auto px-6 lg:px-20 py-16 font-sans"><div class="grid grid-cols-1 lg:grid-cols-2 gap-16"><div class="space-y-6"><h2 class="text-[#00215e] text-4xl font-bold">Why Choose Us?</h2><div class="w-12 h-1 bg-[#ff5a00]"></div><p class="text-gray-700 text-lg leading-relaxed">At <span class="font-semibold text-[#00215e]">Sortiq Solutions Pvt. Ltd.</span>, we don't just offer IT service, we create practical solutions that help businesses grow and perform better. What makes us different is our clear focus on results, quality, and long-term value.</p><ul class="space-y-6"><li class="flex items-start gap-3"><span class="text-[#00215e] font-bold mt-1">&bull;</span><p class="text-gray-800 text-lg"><span class="font-bold">Expertise with Vision</span> – Our experts stay updated with the latest technologies and industry practices to deliver smart, secure, and scalable solutions.</p></li><li class="flex items-start gap-3"><span class="text-[#00215e] font-bold mt-1">&bull;</span><p class="text-gray-800 text-lg"><span class="font-bold">Client-Centric Approach</span> – We take time to understand your business, challenges, and goals so we can build solutions that truly fit your needs.</p></li><li class="flex items-start gap-3"><span class="text-[#00215e] font-bold mt-1">&bull;</span><p class="text-gray-800 text-lg"><span class="font-bold">Reliable &amp; Scalable Solutions</span> – Whether you are a growing startup or an established enterprise, our solutions are built to adapt and scale as your business grow.</p></li><li class="flex items-start gap-3"><span class="text-[#00215e] font-bold mt-1">&bull;</span><p class="text-gray-800 text-lg"><span class="font-bold">Commitment to Quality</span> – We follow high standards across every project to ensure reliability, performance, and long-term stability.</p></li></ul></div><div class="space-y-6"><div class="text-center lg:text-left"><h2 class="text-[#00215e] text-4xl font-bold">Partner with Sortiq Solutions!</h2><div class="w-12 h-1 bg-[#ff5a00] mx-auto lg:mx-0 mt-4"></div></div>
  <form class="space-y-4 font-raleway">
    <input type="hidden" name="country_code" value="+91">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="relative">
        <iconify-icon icon="lucide:user" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
        <input name="name" type="text" placeholder="enter your name" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 outline-none focus:border-[#ff5a00]" required>
      </div>
      <div class="relative">
        <iconify-icon icon="lucide:mail" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
        <input name="email" type="email" placeholder="enter your email" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 outline-none focus:border-[#ff5a00]" required>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="relative flex items-center border rounded-md bg-gray-50/30 focus-within:border-[#ff5a00]">
        <div class="flex items-center gap-1 px-3 cursor-default border-r h-full py-3">
          <img src="{{ asset('frontend-assets/media/flags/india.webp') }}" alt="India flag" class="w-5" loading="lazy" decoding="async">
          <span class="text-sm font-normal">+91</span>
          <iconify-icon icon="lucide:chevron-down" width="14" height="14" class="opacity-70"></iconify-icon>
        </div>
        <input name="phone" type="tel" placeholder="phone number" class="w-full px-4 py-3 bg-transparent outline-none" required>
      </div>

      <div class="relative">
        <iconify-icon icon="lucide:list-checks" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
        <input name="subject" type="text" placeholder="subject" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 outline-none focus:border-[#ff5a00]" required>
      </div>
    </div>

    <div class="relative">
      <iconify-icon icon="lucide:message-square" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
      <textarea name="message" rows="5" placeholder="enter your message" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 resize-none outline-none focus:border-[#ff5a00]" required></textarea>
    </div>

    <div class="py-2">
      @include('components.recaptcha')
    </div>

    <button type="submit" class="w-full bg-[#ff5a00] text-white font-bold py-4 rounded-md hover:bg-[#e65100] transition-colors uppercase">
      send message
    </button>
  </form>
</div></div></section><section class="relative h-[600px] w-full overflow-hidden flex items-center justify-center font-sans"><div class="absolute inset-0 bg-cover bg-center z-0" style="background-image:url('{{ asset('frontend-assets/media/pages/about/about-hero.webp') }}')"><div class="absolute inset-0 bg-black/75 backdrop-blur-[1px]"></div></div><div class="relative z-10 w-full max-w-4xl px-6 text-center text-white h-[450px] overflow-hidden"><div class="animate-scroll-up-stop flex flex-col items-center"><h2 class="text-3xl md:text-4xl font-bold mb-4 tracking-wide">Join Us at Sortiq Solutions!</h2><div class="w-16 h-1 bg-white mx-auto mb-8"></div><div class="space-y-6 text-lg md:text-xl leading-relaxed text-gray-100 font-light"><p>Join Sortiq Solutions Pvt. Ltd. and take a step toward success! Whether you're an aspiring IT professional looking to break into the industry, a seasoned expert seeking to enhance your skills, or a business owner aiming to leverage technology for growth, we are here to support your journey.</p><p>Our expert-led training programs provide in-depth knowledge, while hands-on learning ensures you gain practical experience. We also offer career guidance, including resume assistance, to help you stand out in the competitive job market. For businesses, we provide customized IT solutions to streamline operations and drive innovation. At Sortiq Solutions, we believe in empowering individuals and organizations with the right tools and expertise to excel in the ever-evolving world of technology. Take control of your future and join us today!</p></div></div></div><style>
        @keyframes scrollUpStop {
          0% {
            /* Start completely below the container view */
            transform: translateY(100%);
            opacity: 0;
          }
          20% {
            opacity: 1;
          }
          100% {
            /* 0% means it stops exactly where the text is defined in the HTML */
            transform: translateY(0%);
            opacity: 1;
          }
        }

        .animate-scroll-up-stop {
          /* 12s duration, ease-out makes it slow down as it reaches the top */
          /* 'forwards' ensures it stays at the 100% keyframe forever */
          animation: scrollUpStop 10s ease-out forwards;
        }
      </style></section></main>
@endsection



