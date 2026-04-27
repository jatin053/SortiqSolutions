@extends('layouts.frontend')

@section('title', 'Why Choose us for Web &amp; App Development | Sortiq Solutions')
@section('body_attributes') data-route="/why-us" @endsection

@section('content')
<main class="font-raleway">
  <section class="bg-gray-50 px-4 py-16 font-sans overflow-hidden sm:px-6 md:py-24">
    <div class="mx-auto max-w-6xl">
      <div class="mb-12 text-center md:mb-20">
        <h2 class="mb-4 text-3xl font-bold text-[#00215e] md:text-4xl lg:text-5xl">Why Choose Us</h2>
        <div class="mx-auto mb-6 h-1 w-16 rounded-full bg-orange-500"></div>
        <p class="mx-auto max-w-2xl text-base leading-relaxed text-gray-600 md:text-lg">
          We combine innovation with execution to help your business scale efficiently in a competitive digital landscape.
        </p>
      </div>

      <div class="grid grid-cols-1 gap-8 md:gap-10 sm:grid-cols-2 lg:grid-cols-3">
        <div class="group flex flex-col items-center rounded-2xl border border-gray-100 bg-white p-8 text-center shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 shadow-sm transition-all duration-300 group-hover:rotate-6 group-hover:bg-[#00215e] group-hover:shadow-lg">
            <div class="flex items-center justify-center text-orange-500 transition-colors duration-300 group-hover:text-white">
              <iconify-icon icon="lucide:target" width="16" height="16" class="h-8 w-8"></iconify-icon>
            </div>
          </div>
          <h3 class="mb-3 text-xl font-bold text-[#00215e] transition-colors group-hover:text-orange-500">Strategic Expertise</h3>
          <p class="text-sm leading-relaxed text-gray-500 md:text-base">
            Our team brings decades of combined experience to solve your most complex business challenges.
          </p>
        </div>

        <div class="group flex flex-col items-center rounded-2xl border border-gray-100 bg-white p-8 text-center shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 shadow-sm transition-all duration-300 group-hover:rotate-6 group-hover:bg-[#00215e] group-hover:shadow-lg">
            <div class="flex items-center justify-center text-orange-500 transition-colors duration-300 group-hover:text-white">
              <iconify-icon icon="lucide:zap" width="16" height="16" class="h-8 w-8"></iconify-icon>
            </div>
          </div>
          <h3 class="mb-3 text-xl font-bold text-[#00215e] transition-colors group-hover:text-orange-500">Tailored Solutions</h3>
          <p class="text-sm leading-relaxed text-gray-500 md:text-base">
            We don't believe in one-size-fits-all. Every strategy is custom-built for your specific goals.
          </p>
        </div>

        <div class="group flex flex-col items-center rounded-2xl border border-gray-100 bg-white p-8 text-center shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 shadow-sm transition-all duration-300 group-hover:rotate-6 group-hover:bg-[#00215e] group-hover:shadow-lg">
            <div class="flex items-center justify-center text-orange-500 transition-colors duration-300 group-hover:text-white">
              <iconify-icon icon="lucide:bar-chart3" width="16" height="16" class="h-8 w-8"></iconify-icon>
            </div>
          </div>
          <h3 class="mb-3 text-xl font-bold text-[#00215e] transition-colors group-hover:text-orange-500">Data-Driven Results</h3>
          <p class="text-sm leading-relaxed text-gray-500 md:text-base">
            We back every decision with deep analytics to ensure your investment yields measurable ROI.
          </p>
        </div>

        <div class="group flex flex-col items-center rounded-2xl border border-gray-100 bg-white p-8 text-center shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 shadow-sm transition-all duration-300 group-hover:rotate-6 group-hover:bg-[#00215e] group-hover:shadow-lg">
            <div class="flex items-center justify-center text-orange-500 transition-colors duration-300 group-hover:text-white">
              <iconify-icon icon="lucide:users" width="16" height="16" class="h-8 w-8"></iconify-icon>
            </div>
          </div>
          <h3 class="mb-3 text-xl font-bold text-[#00215e] transition-colors group-hover:text-orange-500">Client-Centric Focus</h3>
          <p class="text-sm leading-relaxed text-gray-500 md:text-base">
            Your success is our priority. We work as an extension of your team, not just a vendor.
          </p>
        </div>

        <div class="group flex flex-col items-center rounded-2xl border border-gray-100 bg-white p-8 text-center shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 shadow-sm transition-all duration-300 group-hover:rotate-6 group-hover:bg-[#00215e] group-hover:shadow-lg">
            <div class="flex items-center justify-center text-orange-500 transition-colors duration-300 group-hover:text-white">
              <iconify-icon icon="lucide:shield-check" width="16" height="16" class="h-8 w-8"></iconify-icon>
            </div>
          </div>
          <h3 class="mb-3 text-xl font-bold text-[#00215e] transition-colors group-hover:text-orange-500">Proven Reliability</h3>
          <p class="text-sm leading-relaxed text-gray-500 md:text-base">
            With a track record of high-impact delivery, we are the partner you can trust for the long haul.
          </p>
        </div>

        <div class="group flex flex-col items-center rounded-2xl border border-gray-100 bg-white p-8 text-center shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 shadow-sm transition-all duration-300 group-hover:rotate-6 group-hover:bg-[#00215e] group-hover:shadow-lg">
            <div class="flex items-center justify-center text-orange-500 transition-colors duration-300 group-hover:text-white">
              <iconify-icon icon="lucide:headphones" width="16" height="16" class="h-8 w-8"></iconify-icon>
            </div>
          </div>
          <h3 class="mb-3 text-xl font-bold text-[#00215e] transition-colors group-hover:text-orange-500">24/7 Priority Support</h3>
          <p class="text-sm leading-relaxed text-gray-500 md:text-base">
            Business doesn't sleep, and neither does our commitment to assisting you whenever you need us.
          </p>
        </div>
      </div>

      <div class="mt-16 text-center">
        <a href="/contact" class="inline-block">
          <button class="rounded-full bg-[#00215e] px-10 py-4 font-bold text-white shadow-lg transition-all hover:bg-orange-600 hover:shadow-orange-200 active:scale-95">
            Get Started Today
          </button>
        </a>
      </div>
    </div>
  </section>

  <section class="relative mt-8 w-full overflow-hidden bg-white py-12 md:py-20">
    <div
      class="pointer-events-none absolute inset-0 opacity-40"
      style="background-image:radial-gradient(circle at 1px 1px, rgba(17, 24, 39, 0.14) 1px, transparent 0); background-size:30px 30px;"
    ></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6">
      <h2 class="mb-10 px-2 text-center text-3xl font-extrabold text-[#2d3134] md:mb-16 md:text-5xl">
        Our Trusted <span class="text-orange-500">Clients</span>
      </h2>

      <div class="relative w-full overflow-hidden">
        <div class="flex translate-x-0 transform transition-transform duration-1000 ease-in-out">
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/perry-logo.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/moves-brands-wordmark.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/moves-brands-logo.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/mbc-rev-logo.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/zeitgeist-logo.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/think-decks-logo.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
          <div class="flex w-1/4 shrink-0 items-center justify-center px-4">
            <div class="group flex h-24 w-full items-center justify-center p-2 transition-all duration-300 md:h-32 md:p-4">
              <img src="{{ asset('frontend-assets/media/brand/clients/australian-swim-schools-association-logo.webp') }}" alt="Client Logo" class="max-h-12 w-auto object-contain opacity-60 grayscale transition-all duration-500 group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0 md:max-h-16">
            </div>
          </div>
        </div>
      </div>

      <div class="mt-8 flex justify-center gap-2">
        <button class="h-2 w-6 rounded-full bg-orange-500 transition-all"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300 transition-all"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300 transition-all"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300 transition-all"></button>
      </div>
    </div>
  </section>

  <div class="w-full overflow-x-hidden font-sans text-gray-800">
    <section class="relative flex min-h-[450px] items-center justify-center overflow-hidden px-4 py-12 text-center text-white md:h-[500px] md:px-6">
      <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ asset('frontend-assets/media/pages/why-us/why-us-background.webp') }}')">
        <div class="absolute inset-0 bg-[#00215e]/90 md:bg-[#00215e]/85"></div>
      </div>

      <div class="relative z-10 mx-auto max-w-4xl">
        <h1 class="mb-6 text-3xl font-bold md:text-5xl">Let's Work Together</h1>
        <p class="px-2 text-sm leading-relaxed opacity-95 text-justify md:text-center md:text-lg">
          At Sortiq Solutions Pvt. Ltd., we believe that the right technology can drive meaningful change. Partner with us to unlock cutting-edge solutions designed specifically to meet your unique business needs. Whether you're aiming to streamline operations, fortify cybersecurity, or scale your business to new heights, our team of experts is here to support you at every stage of your journey. Let's collaborate and pave the way for a smarter, more resilient future together.
        </p>
      </div>
    </section>

    <section class="bg-white py-12 md:py-20">
      <div class="mx-auto max-w-7xl px-5 md:px-10">
        <div class="mb-12 text-center md:mb-16">
          <h2 class="mb-3 px-2 text-2xl font-bold text-[#00215e] md:text-4xl">Get Custom Solutions for Your Business</h2>
          <div class="mx-auto h-1 w-12 rounded-full bg-orange-500"></div>
        </div>

        <div class="grid items-start gap-10 lg:grid-cols-2 md:gap-16">
          <div class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2">
            <div class="group flex flex-col items-center text-center sm:items-start sm:text-left">
              <div class="mb-4 rounded-lg bg-gray-50 p-3">
                <img src="{{ asset('frontend-assets/media/pages/why-us/icons/custom-theme-plugin-icon.webp') }}" alt="Custom Themes &amp; Plugins" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
              </div>
              <h3 class="mb-2 text-lg font-bold text-[#00215e] transition-colors group-hover:text-orange-600">Custom Themes &amp; Plugins</h3>
              <p class="max-w-xs text-sm leading-relaxed text-gray-500">Develop tailored WordPress themes and plugins that enhance functionality and align perfectly.</p>
            </div>

            <div class="group flex flex-col items-center text-center sm:items-start sm:text-left">
              <div class="mb-4 rounded-lg bg-gray-50 p-3">
                <img src="{{ asset('frontend-assets/media/pages/why-us/icons/crm-integration-icon.webp') }}" alt="Seamless CRM Integration" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
              </div>
              <h3 class="mb-2 text-lg font-bold text-[#00215e] transition-colors group-hover:text-orange-600">Seamless CRM Integration</h3>
              <p class="max-w-xs text-sm leading-relaxed text-gray-500">Integrate your website with leading CRM systems to automate workflows and boost efficiency.</p>
            </div>

            <div class="group flex flex-col items-center text-center sm:items-start sm:text-left">
              <div class="mb-4 rounded-lg bg-gray-50 p-3">
                <img src="{{ asset('frontend-assets/media/pages/why-us/icons/product-management-icon.webp') }}" alt="Product Management" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
              </div>
              <h3 class="mb-2 text-lg font-bold text-[#00215e] transition-colors group-hover:text-orange-600">Product Management</h3>
              <p class="max-w-xs text-sm leading-relaxed text-gray-500">Get user-friendly tools making it effortless to update, organize, and showcase your offerings.</p>
            </div>

            <div class="group flex flex-col items-center text-center sm:items-start sm:text-left">
              <div class="mb-4 rounded-lg bg-gray-50 p-3">
                <img src="{{ asset('frontend-assets/media/pages/why-us/icons/support-maintenance-icon.webp') }}" alt="24/7 Support &amp; Maintenance" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
              </div>
              <h3 class="mb-2 text-lg font-bold text-[#00215e] transition-colors group-hover:text-orange-600">24/7 Support &amp; Maintenance</h3>
              <p class="max-w-xs text-sm leading-relaxed text-gray-500">Ensure your website runs smoothly with continuous support and performance optimizations.</p>
            </div>
          </div>

          <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xl shadow-gray-200/50 md:p-8">
            <form class="space-y-4 font-raleway">
              <input type="hidden" name="country_code" value="+91">

              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="relative">
                  <iconify-icon icon="lucide:user" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
                  <input name="name" type="text" placeholder="enter your name" class="w-full rounded-md border bg-gray-50/30 py-3 pl-11 outline-none focus:border-[#ff5a00]" required>
                </div>
                <div class="relative">
                  <iconify-icon icon="lucide:mail" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
                  <input name="email" type="email" placeholder="enter your email" class="w-full rounded-md border bg-gray-50/30 py-3 pl-11 outline-none focus:border-[#ff5a00]" required>
                </div>
              </div>

              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="relative flex items-center rounded-md border bg-gray-50/30 focus-within:border-[#ff5a00]">
                  <div class="flex h-full cursor-default items-center gap-1 border-r px-3 py-3">
                    <img src="{{ asset('frontend-assets/media/flags/india.webp') }}" alt="India flag" class="w-5" loading="lazy" decoding="async">
                    <span class="text-sm font-normal">+91</span>
                    <iconify-icon icon="lucide:chevron-down" width="14" height="14" class="opacity-70"></iconify-icon>
                  </div>
                  <input name="phone" type="tel" placeholder="phone number" class="w-full bg-transparent px-4 py-3 outline-none" required>
                </div>

                <div class="relative">
                  <iconify-icon icon="lucide:list-checks" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
                  <input name="subject" type="text" placeholder="subject" class="w-full rounded-md border bg-gray-50/30 py-3 pl-11 outline-none focus:border-[#ff5a00]" required>
                </div>
              </div>

              <div class="relative">
                <iconify-icon icon="lucide:message-square" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
                <textarea name="message" rows="5" placeholder="enter your message" class="w-full resize-none rounded-md border bg-gray-50/30 py-3 pl-11 outline-none focus:border-[#ff5a00]" required></textarea>
              </div>

              <div class="py-2">
                @include('components.recaptcha')
              </div>

              <button type="submit" class="w-full bg-[#ff5a00] py-4 font-bold uppercase text-white transition-colors hover:bg-[#e65100]">
                send message
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
@endsection
