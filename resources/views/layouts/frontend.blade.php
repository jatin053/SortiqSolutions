
  <!doctype html>
@php
    $contactApiUrl = route('api.contact-messages.store');
    $whatsappNumber = '919646522110';
    $routeName = request()->route()?->getName();
    $recaptchaEnabled = \App\Support\Recaptcha::enabledForRequest(request())
        && request()->routeIs('frontend.contact', 'frontend.internship');
    $usesDotLottie = request()->routeIs('frontend.home');
    $viteManifestPath = public_path('build/manifest.json');
    $viteManifestEntryFile = null;

    if (is_file($viteManifestPath)) {
        $viteManifest = json_decode(file_get_contents($viteManifestPath), true);
        $viteManifestEntryFile = data_get($viteManifest, 'resources/css/app.css.file');
    }

    $viteAssetsReady = is_string($viteManifestEntryFile)
        && $viteManifestEntryFile !== ''
        && is_file(public_path('build/' . ltrim($viteManifestEntryFile, '/')));
    $localTailwindCssExists = is_file(public_path('frontend-assets/css/tailwind-fallback.css'));
    $versionedAsset = static function (string $path): string {
        $absolutePath = public_path($path);

        if (! is_file($absolutePath)) {
            return asset($path);
        }

        return asset($path) . '?v=' . filemtime($absolutePath);
    };
    $resolvedPageMeta = ($pageMeta ?? null) instanceof \App\Support\Seo\PageMeta
        ? $pageMeta
        : \App\Support\Seo\PageMeta::forRoute($routeName);
    $sectionTitle = trim($__env->yieldContent('title'));
    $routeTitle = trim((string) \App\Support\Seo\PageMeta::titleForRoute($routeName));
    $pageTitle = trim($resolvedPageMeta->title ?: $routeTitle ?: $sectionTitle ?: config('seo.default_title', 'Sortiq Solutions Pvt. Ltd.'));
    $pageDescription = trim(
        $__env->yieldContent(
            'meta_description',
            $resolvedPageMeta->description
        )
    );
    $pageImage = trim($__env->yieldContent('meta_image', $resolvedPageMeta->image));
    $pageType = trim($__env->yieldContent('meta_type', $resolvedPageMeta->type));
    $canonicalUrl = url()->current();
    $inlineFrontendCss = is_file(public_path('frontend-assets/css/main.css'))
        ? file_get_contents(public_path('frontend-assets/css/main.css'))
        : null;
@endphp
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{{ $pageTitle }}</title>
      <meta name="description" content="{{ $pageDescription }}">
      <link rel="canonical" href="{{ $canonicalUrl }}">
      <meta property="og:type" content="{{ $pageType }}">
      <meta property="og:title" content="{{ $pageTitle }}">
      <meta property="og:description" content="{{ $pageDescription }}">
      <meta property="og:url" content="{{ $canonicalUrl }}">
      <meta property="og:image" content="{{ $pageImage }}">
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="{{ $pageTitle }}">
      <meta name="twitter:description" content="{{ $pageDescription }}">
      <meta name="twitter:image" content="{{ $pageImage }}">
      @include('partials.favicon-links', ['faviconVersion' => '20260420b'])
      @if ($recaptchaEnabled)
        <link rel="dns-prefetch" href="//www.google.com">
        <link rel="dns-prefetch" href="//www.gstatic.com">
      @endif
      @if ($viteAssetsReady)
        @vite('resources/css/app.css')
      @elseif ($localTailwindCssExists)
        <link rel="stylesheet" href="{{ $versionedAsset('frontend-assets/css/tailwind-fallback.css') }}">
      @else
        <script>
          window.tailwind = window.tailwind || {};
          window.tailwind.config = {
            theme: {
              extend: {
                fontFamily: {
                  sans: ['ui-sans-serif', 'system-ui', 'sans-serif'],
                  title: ['ui-sans-serif', 'system-ui', 'sans-serif'],
                  raleway: ['ui-sans-serif', 'system-ui', 'sans-serif']
                }
              }
            }
          };
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
      @endif
      @if ($recaptchaEnabled)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      @endif
      @if ($inlineFrontendCss)
        <style>{!! $inlineFrontendCss !!}</style>
      @else
        <link rel="stylesheet" href="{{ $versionedAsset('frontend-assets/css/main.css') }}">
      @endif
      @if (! $recaptchaEnabled)
        <style>
          .g-recaptcha {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px 16px;
            border: 1px dashed #d1d5db;
            border-radius: 14px;
            background: #f9fafb;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
          }
        </style>
      @endif
      <script>
        window.__sortiqRunWhenIdle = (callback) => {
          if ("requestIdleCallback" in window) {
            window.requestIdleCallback(callback, { timeout: 1800 });
            return;
          }

          window.setTimeout(callback, 600);
        };

        window.__sortiqInjectScript = (src, attributes = {}) => {
          if (!src || document.querySelector(`script[src="${src}"]`)) {
            return;
          }

          const script = document.createElement("script");
          script.src = src;

          Object.entries(attributes).forEach(([key, value]) => {
            if (value === true) {
              script.setAttribute(key, "");
              return;
            }

            script.setAttribute(key, String(value));
          });

          document.head.appendChild(script);
        };

        window.addEventListener("load", () => {
          window.__sortiqRunWhenIdle(() => {
            window.__sortiqInjectScript("https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js", {
              defer: true,
            });
          });

          @if ($usesDotLottie)
            window.__sortiqRunWhenIdle(() => {
              window.__sortiqInjectScript("https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs", {
                type: "module",
              });
            });
          @endif
        }, { once: true });
      </script>
      @include('components.frontend-data-scripts')
      @stack('head')
    </head>
    <body
      data-contact-api-url="{{ $contactApiUrl }}"
      data-whatsapp-number="{{ $whatsappNumber }}"
      data-recaptcha-enabled="{{ $recaptchaEnabled ? 'true' : 'false' }}"
      @yield('body_attributes')
    >
      @include('layouts.partials.header')
  
      @yield('content')
      
  <div class="relative">
    <div id="chatbot-panel" class="chatbot-panel fixed bottom-24 right-4 md:right-8 z-[70] w-[calc(100%-2rem)] max-w-[350px] md:w-96 bg-white rounded-2xl shadow-2xl overflow-hidden origin-bottom-right border border-gray-100">
      <div class="bg-[#ff6600] p-4 flex justify-between items-center text-white">
        <div class="flex items-center gap-3">
          <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
          <span class="font-bold">Chat with us!</span>
        </div>
        <button type="button" id="chatbot-close" class="hover:rotate-90 transition-transform p-1" aria-label="Close chatbot">
          <iconify-icon icon="lucide:x" width="20" height="20"></iconify-icon>
        </button>
      </div>
      <div class="h-72 md:h-80 p-4 bg-gray-50 flex flex-col justify-end">
        <div class="bg-orange-100 text-[#000d23] p-3 rounded-t-lg rounded-br-lg text-sm max-w-[80%] self-start mb-4 shadow-sm">
          Hello! How can we help you today?
        </div>
      </div>
      <div class="p-4 border-t border-gray-100 bg-white flex gap-2">
        <input id="chatbot-input" type="text" placeholder="Type your message..." class="flex-1 text-sm text-[#000d23] outline-none p-2 bg-gray-100 rounded-lg focus:ring-1 focus:ring-[#ff6600] transition-all">
        <button type="button" id="chatbot-send" class="text-[#ff6600] p-2 hover:bg-orange-50 rounded-full transition-colors" aria-label="Send message">
          <iconify-icon icon="lucide:send" width="20" height="20"></iconify-icon>
        </button>
      </div>
    </div>

    <div id="chatbot-whatsapp" class="fixed bottom-24 right-8 z-[60]">
      <a href="https://wa.me/919646522110" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-2 bg-[#25D366] text-white p-3 md:px-4 md:py-3 rounded-full shadow-lg hover:scale-110 transition-all border border-black/5">
        <iconify-icon icon="fa6-brands:whatsapp" width="24" height="24"></iconify-icon>
        <span class="font-bold text-sm hidden md:inline">Chat with us</span>
      </a>
    </div>

    <div class="fixed bottom-6 right-8 z-[60]">
      <button id="chatbot-toggle" type="button" aria-expanded="false" class="w-14 h-14 bg-[#ff6600] rounded-full flex items-center justify-center text-white shadow-[0_10px_25px_rgba(255,102,0,0.3)] hover:scale-110 transition-all duration-300 border border-black/5">
        <iconify-icon icon="lucide:message-circle" width="28" height="28"></iconify-icon>
      </button>
    </div>
  </div>

      
      @include('layouts.partials.footer')

      
  <div id="fresher-modal-shell" class="modal-shell fixed inset-0 z-[10000]" hidden>
    <div class="modal-overlay absolute inset-0 bg-[#00142e]/80 backdrop-blur-md"></div>
    <div class="relative h-full flex items-center justify-center p-4 font-['Plus_Jakarta_Sans',sans-serif]">
      <div class="modal-panel relative w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden flex flex-col md:flex-row shadow-2xl">
        <div class="hidden md:block w-5/12 relative">
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1000" class="absolute inset-0 w-full h-full object-cover" alt="Hiring" loading="lazy" decoding="async">
          <div class="absolute inset-0 bg-gradient-to-b from-[#FF5722]/40 to-[#00142e]/90 flex flex-col justify-end p-10">
            <h2 class="text-white text-4xl font-extrabold leading-tight mb-2">Kickstart Your Career</h2>
            <p class="text-white/80 font-medium">Join Sortiq Solutions and work on world-class projects.</p>
          </div>
        </div>

        <div class="w-full md:w-7/12 bg-white p-8 md:p-12 relative">
          <button type="button" data-close-fresher class="absolute top-6 right-6 text-gray-400 hover:text-[#FF5722] transition-colors p-2" aria-label="Close hiring modal">
            <iconify-icon icon="lucide:x" width="28" height="28"></iconify-icon>
          </button>

          <div class="mb-8">
            <h3 class="text-[#00142e] text-3xl font-extrabold tracking-tight">Apply as a Fresher</h3>
            <p class="text-gray-400 font-semibold text-sm mt-1">We'll get back to you within 24 hours.</p>
          </div>

          <form class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="relative">
                <iconify-icon icon="lucide:users" width="18" height="18" class="absolute left-4 top-4 text-[#FF5722]"></iconify-icon>
                <input name="name" type="text" placeholder="Full Name" required class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm font-bold bg-gray-50 border border-transparent focus:border-[#FF5722] focus:bg-white outline-none transition-all">
              </div>
              <div class="relative">
                <iconify-icon icon="lucide:mail" width="18" height="18" class="absolute left-4 top-4 text-[#FF5722]"></iconify-icon>
                <input name="email" type="email" placeholder="Email Address" required class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm font-bold bg-gray-50 border border-transparent focus:border-[#FF5722] focus:bg-white outline-none transition-all">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="flex bg-gray-50 rounded-2xl relative border border-transparent focus-within:border-[#FF5722] focus-within:bg-white transition-all">
                <select name="country" class="px-4 border-r gap-2 font-bold text-[#00142e] bg-transparent outline-none rounded-l-2xl">
                  <option value="+91">+91 India</option>
                  <option value="+1">+1 USA</option>
                  <option value="+44">+44 UK</option>
                </select>
                <input name="phone" type="tel" placeholder="Phone" required class="w-full px-4 py-4 text-sm font-bold outline-none bg-transparent">
              </div>
              <div class="relative">
                <iconify-icon icon="lucide:file-text" width="18" height="18" class="absolute left-4 top-4 text-[#FF5722]"></iconify-icon>
                <input name="subject" type="text" placeholder="Subject" required class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm font-bold bg-gray-50 border border-transparent focus:border-[#FF5722] focus:bg-white outline-none transition-all">
              </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4 flex items-center border border-dashed border-gray-200 hover:border-[#FF5722] transition-colors">
              <iconify-icon icon="lucide:upload" width="20" height="20" class="text-[#FF5722] mx-2"></iconify-icon>
              <label class="bg-white px-4 py-2 rounded-xl text-[11px] font-extrabold cursor-pointer border shadow-sm hover:bg-gray-50">
                Choose CV <input id="fresher-file" type="file" class="hidden">
              </label>
              <span id="fresher-file-name" class="ml-4 text-gray-400 text-xs font-bold truncate max-w-[150px]">No file chosen</span>
            </div>

            <div class="relative bg-gray-50 rounded-2xl border border-transparent focus-within:border-[#FF5722] focus-within:bg-white transition-all">
              <iconify-icon icon="tabler:message-circle-filled" width="20" height="20" class="absolute left-4 top-4 text-[#FF5722]"></iconify-icon>
              <textarea name="message" rows="3" placeholder="Brief about yourself..." required class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm font-bold outline-none bg-transparent resize-none"></textarea>
            </div>

            <div class="flex justify-center scale-90">
              @include('components.recaptcha')
            </div>

            <button type="submit" class="w-full py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-xl transition-all active:scale-95 bg-[#FF5722] hover:bg-[#00142e] text-white">
              Send Application
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

      <script src="{{ $versionedAsset('frontend-assets/js/main.js') }}" defer></script>
      @stack('scripts')
    </body>
  </html>
