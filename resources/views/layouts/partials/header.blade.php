<header class="site-header w-full font-raleway sticky top-0 z-50 bg-white shadow-sm">
  <div class="w-full bg-[#001a3d] text-white">
    <div class="max-w-[1536px] mx-auto px-4 py-2.5 lg:px-10">
      <div class="flex flex-col gap-2 text-[12px] md:flex-row md:items-center md:justify-between">
        <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2 font-medium md:justify-start lg:gap-x-6">
          <a href="tel:+919646522110" class="flex items-center gap-2 hover:text-[#ff6600] transition-colors">
            <iconify-icon icon="lucide:phone" width="14" height="14"></iconify-icon> +91 9646522110
          </a>
          <span class="hidden xs:inline text-white/20">|</span>
          <a href="mailto:info@sortiqsolutions.com" class="hidden md:flex items-center gap-2 hover:text-[#ff6600] transition-colors">
            <iconify-icon icon="lucide:mail" width="14" height="14"></iconify-icon>
            <span class="ml-2">info@sortiqsolutions.com</span>
          </a>
          <span class="hidden sm:inline text-white/20">|</span>
          <a href="/internship" class="flex items-center gap-2 text-[#ffffff] font-bold group">
            <iconify-icon icon="lucide:send" width="14" height="14" class="rotate-[-20deg] animate-bounce"></iconify-icon>
            <span class="animate-pulse text-orange-500">Apply Internship</span>
          </a>
        </div>
        <div class="flex flex-wrap items-center justify-center gap-3 py-1 md:justify-end lg:gap-5">
          <a href="https://www.facebook.com/SortiqSolutions/" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="Facebook">
            <iconify-icon icon="fa6-brands:facebook-f" width="14" height="14"></iconify-icon>
          </a>
          <a href="https://www.linkedin.com/company/sortiq-solutions/" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="LinkedIn">
            <iconify-icon icon="fa6-brands:linkedin-in" width="14" height="14"></iconify-icon>
          </a>
          <a href="https://www.instagram.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="Instagram">
            <iconify-icon icon="fa6-brands:instagram" width="14" height="14"></iconify-icon>
          </a>
          <a href="https://www.youtube.com/@SortiqSolutions" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="YouTube">
            <iconify-icon icon="fa6-brands:youtube" width="14" height="14"></iconify-icon>
          </a>
          <a href="https://x.com/SortiqSolutions" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="Twitter">
            <iconify-icon icon="fa6-brands:x-twitter" width="14" height="14"></iconify-icon>
          </a>
          <a href="https://in.pinterest.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="Pinterest">
            <iconify-icon icon="fa6-brands:pinterest-p" width="14" height="14"></iconify-icon>
          </a>
          <a href="https://medium.com/@sortiqsolutions" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500 hover:scale-125 transition-all duration-300" aria-label="Medium">
            <iconify-icon icon="fa6-brands:medium" width="14" height="14"></iconify-icon>
          </a>
        </div>
      </div>
    </div>
  </div>

  <nav class="w-full px-4 py-3 lg:px-10 lg:py-4 flex items-center gap-4 lg:gap-8 xl:gap-12">
    <a href="/" class="shrink-0 flex items-center" aria-label="Sortiq Solutions home">
      <img
        src="{{ asset('frontend-assets/media/admin-use.png') }}"
        alt="Sortiq Solutions"
        width="185"
        height="77"
        class="h-11 w-auto lg:h-12 xl:h-14"
      >
    </a>
    <ul class="hidden xl:flex items-center gap-x-8 text-[15px] font-bold text-[#333] ml-8 2xl:ml-12">
      <li><a href="/" class="{{ request()->routeIs('frontend.home') ? 'text-[#ff6600]' : 'hover:text-[#ff6600]' }}">Home</a></li>

      <li class="relative group py-2 flex items-center gap-1 cursor-pointer">
        <span class="{{ request()->routeIs('frontend.about') || request()->routeIs('frontend.clients') || request()->routeIs('frontend.why-us') || request()->routeIs('frontend.expertise') || request()->routeIs('frontend.careers') || request()->routeIs('frontend.videos') ? 'text-[#ff6600]' : '' }}">About Us</span>
        <iconify-icon icon="lucide:chevron-down" width="14" height="14" class="transition-transform group-hover:rotate-180 "></iconify-icon>
        <div class="absolute top-full pt-4 left-0 hidden group-hover:block z-50">
          <div class="bg-white shadow-xl rounded-lg border-t-4 border-[#ff6600] p-4 w-[260px]">
            <a href="/about" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:file-text" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Company Overview</span>
            </a>
            <a href="/clients" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:users" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Our Clients</span>
            </a>
            <a href="/why-us" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:circle-help" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Why Choose Us</span>
            </a>
            <a href="/expertise" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:zap" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Our Expertise</span>
            </a>
            <a href="/careers" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:briefcase-business" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Career with Us</span>
            </a>
            <a href="/videos" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:video" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Our Videos</span>
            </a>
          </div>
        </div>
      </li>

      <li class="relative group py-2 flex items-center gap-1 cursor-pointer">
        <span class="{{ request()->routeIs('frontend.services.*') ? 'text-[#ff6600]' : '' }}">Services</span>
        <iconify-icon icon="lucide:chevron-down" width="14" height="14" class="transition-transform group-hover:rotate-180 "></iconify-icon>
        <div class="absolute top-full pt-4 left-1/2 -translate-x-1/2 hidden group-hover:block z-50">
          <div class="bg-white shadow-xl rounded-lg border-t-4 border-[#ff6600] p-4 w-[520px] grid grid-cols-2 gap-x-2 gap-y-1">
            <a href="/services/web" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:code" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Web Development</span>
            </a>
            <a href="/services/design" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:brush" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Website Designing</span>
            </a>
            <a href="/services/laravel" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:layers-3" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Laravel Development</span>
            </a>
            <a href="/services/wordpress" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:settings" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Wordpress Development</span>
            </a>
            <a href="/services/ecommerce" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:shopping-cart" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">E-commerce Solutions</span>
            </a>
            <a href="/services/marketing" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:globe" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Digital Marketing</span>
            </a>
            <a href="/services/seo" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:target" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">SEO Optimization</span>
            </a>
            <a href="/services/smo" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:share-2" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">SMO Services</span>
            </a>
            <a href="/services/graphics" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:pen-tool" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Graphic Designing</span>
            </a>
            <a href="/services/banners" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:monitor" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Banner Design</span>
            </a>
            <a href="/services/logos" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:target" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Logo Design</span>
            </a>
            <a href="/services/maintenance" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:settings" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Web Maintenance</span>
            </a>
          </div>
        </div>
      </li>

      <li class="relative group py-2 flex items-center gap-1 cursor-pointer">
        <span class="{{ request()->routeIs('frontend.portfolio') || request()->routeIs('frontend.cases') ? 'text-[#ff6600]' : '' }}">Our Work</span>
        <iconify-icon icon="lucide:chevron-down" width="14" height="14" class="transition-transform group-hover:rotate-180 "></iconify-icon>
        <div class="absolute top-full pt-4 left-0 hidden group-hover:block z-50">
          <div class="bg-white shadow-xl rounded-lg border-t-4 border-[#ff6600] p-4 w-[260px]">
            <a href="{{ route('frontend.portfolio') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:folder-open" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Portfolio</span>
            </a>
            <a href="/cases" class="flex items-center gap-3 px-4 py-3 hover:bg-orange-50 rounded-md text-[13px] text-gray-700 font-bold transition-colors">
              <iconify-icon icon="lucide:book-open" width="18" height="18" class="text-[#ff6600] flex-shrink-0"></iconify-icon>
              <span class="whitespace-nowrap">Case Studies</span>
            </a>
          </div>
        </div>
      </li>

      <li>
        <a href="/blog" class="{{ request()->routeIs('frontend.blog.*') ? 'text-[#ff6600]' : 'hover:text-[#ff6600]' }}">Blog</a>
      </li>

      <li>
        <a href="/contact" class="{{ request()->routeIs('frontend.contact') ? 'text-[#ff6600]' : 'hover:text-[#ff6600]' }}">Contact Us</a>
      </li>
    </ul>

    <div class="hidden xl:flex items-center gap-4 ml-auto shrink-0">
      <a href="/reviews" class="text-[#ff6600] font-bold flex items-center gap-2">
        <span class="flex h-2 w-2 rounded-full bg-[#ff6600] animate-ping"></span> Reviews
      </a>
      <button type="button" data-open-fresher class="bg-[#ff6600] text-white px-6 py-2.5 rounded-full font-bold text-sm hover:bg-[#001a3d] transition-colors shadow-md">
        Fresher Hiring
      </button>
      <a href="/contact" class="bg-[#001a3d] text-white px-6 py-2.5 rounded-full font-bold text-sm hover:bg-[#ff6600] transition-colors shadow-md">
        Enquiry Now
      </a>
    </div>

    <button type="button" data-mobile-open class="xl:hidden p-2 text-[#001a3d] ml-auto" aria-label="Open mobile menu">
      <iconify-icon icon="lucide:menu" width="30" height="30"></iconify-icon>
    </button>
  </nav>

  <div id="mobile-overlay" class="mobile-overlay fixed inset-0 bg-black/60 z-[100]"></div>
  <div id="mobile-drawer" class="mobile-drawer fixed top-0 right-0 h-full w-full max-w-[380px] bg-white z-[101] shadow-2xl">
    <div class="p-5 flex justify-between items-center border-b">
      <a href="/" class="shrink-0 flex items-center" aria-label="Sortiq Solutions home">
        <img
          src="{{ asset('frontend-assets/media/admin-use.png') }}"
          alt="Sortiq Solutions"
          width="185"
          height="77"
          class="h-10 w-auto"
        >
      </a>
      <button type="button" data-mobile-close class="p-2 bg-gray-100 rounded-full" aria-label="Close mobile menu">
        <iconify-icon icon="lucide:x" width="24" height="24"></iconify-icon>
      </button>
    </div>
    <div class="p-4 overflow-y-auto h-[calc(100vh-180px)]">
      <ul class="space-y-1">
        <li><a href="/" class="block py-3 px-4 font-bold text-gray-800 hover:bg-orange-50 rounded-lg border-b">Home</a></li>

        <li>
          <button type="button" data-mobile-accordion="mobile-accordion-0" aria-expanded="false" class="w-full flex justify-between items-center py-3 px-4 font-bold text-gray-800 hover:bg-orange-50 rounded-lg border-b">
            About Us
            <iconify-icon icon="lucide:chevron-down" width="18" height="18"></iconify-icon>
          </button>
          <div id="mobile-accordion-0" data-mobile-accordion-panel class="hidden bg-gray-50 rounded-lg m-2">
            <a href="/about" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:file-text" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Company Overview
            </a>
            <a href="/clients" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:users" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Our Clients
            </a>
            <a href="/why-us" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:circle-help" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Why Choose Us
            </a>
            <a href="/expertise" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:zap" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Our Expertise
            </a>
            <a href="/careers" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:briefcase-business" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Career with Us
            </a>
            <a href="/videos" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:video" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Our Videos
            </a>
          </div>
        </li>

        <li>
          <button type="button" data-mobile-accordion="mobile-accordion-1" aria-expanded="false" class="w-full flex justify-between items-center py-3 px-4 font-bold text-gray-800 hover:bg-orange-50 rounded-lg border-b">
            Services
            <iconify-icon icon="lucide:chevron-down" width="18" height="18"></iconify-icon>
          </button>
          <div id="mobile-accordion-1" data-mobile-accordion-panel class="hidden bg-gray-50 rounded-lg m-2">
            <a href="/services/web" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:code" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Web Development
            </a>
            <a href="/services/design" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:brush" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Website Designing
            </a>
            <a href="/services/laravel" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:layers-3" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Laravel Development
            </a>
            <a href="/services/wordpress" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:settings" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Wordpress Development
            </a>
            <a href="/services/ecommerce" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:shopping-cart" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              E-commerce Solutions
            </a>
            <a href="/services/marketing" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:globe" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Digital Marketing
            </a>
            <a href="/services/seo" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:target" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              SEO Optimization
            </a>
            <a href="/services/smo" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:share-2" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              SMO Services
            </a>
            <a href="/services/graphics" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:pen-tool" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Graphic Designing
            </a>
            <a href="/services/banners" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:monitor" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Banner Design
            </a>
            <a href="/services/logos" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:target" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Logo Design
            </a>
            <a href="/services/maintenance" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:settings" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Web Maintenance
            </a>
          </div>
        </li>

        <li>
          <button type="button" data-mobile-accordion="mobile-accordion-2" aria-expanded="false" class="w-full flex justify-between items-center py-3 px-4 font-bold text-gray-800 hover:bg-orange-50 rounded-lg border-b">
            Our Work
            <iconify-icon icon="lucide:chevron-down" width="18" height="18"></iconify-icon>
          </button>
          <div id="mobile-accordion-2" data-mobile-accordion-panel class="hidden bg-gray-50 rounded-lg m-2">
            <a href="{{ route('frontend.portfolio') }}" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:folder-open" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Portfolio
            </a>
            <a href="/cases" class="flex items-center gap-3 p-3 text-[13px] font-semibold text-gray-700">
              <iconify-icon icon="lucide:book-open" width="18" height="18" class="text-[#ff6600]"></iconify-icon>
              Case Studies
            </a>
          </div>
        </li>
        <li><a href="/blog" class="block py-3 px-4 font-bold text-gray-800 hover:bg-orange-50 rounded-lg border-b">Blog</a></li>
        <li><a href="/contact" class="block py-3 px-4 font-bold text-gray-800 hover:bg-orange-50 rounded-lg border-b">Contact Us</a></li>
      </ul>
    </div>
    <div class="p-4 bg-white border-t space-y-3">
      <button type="button" data-open-fresher class="w-full bg-[#ff6600] text-white py-3.5 rounded-xl font-bold">Fresher Hiring</button>
      <a href="/contact" class="block w-full bg-[#001a3d] text-white py-3.5 rounded-xl font-bold text-center">Enquiry Now</a>
    </div>
  </div>
</header>
