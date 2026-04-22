@extends('layouts.frontend')

@section('title', 'Case studies | Sortiq Solutions')
@section('body_attributes') data-route="/cases" @endsection

@section('content')
<main class="font-raleway"><div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center font-sans antialiased px-6 py-12"><div class="w-full max-w-3xl bg-white p-8 md:p-16 lg:p-24 shadow-2xl rounded-[2rem] border border-gray-100 flex flex-col items-center justify-center transform hover:scale-[1.01] transition-all duration-500 ease-in-out"><div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-8 mb-10 border-b border-gray-50 pb-10 w-full"><span class="text-5xl md:text-7xl lg:text-8xl animate-bounce-slow cursor-default select-none" role="img" aria-label="Road blockade icon">🚧</span><h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight text-center sm:text-left">Coming <span class="text-blue-600">Soon</span></h1></div><div class="space-y-6 max-w-lg text-center"><p class="text-lg md:text-xl text-slate-700 font-semibold leading-relaxed">Our case studies are under preparation. We are crafting insightful stories about our previous successes.</p><p class="text-sm md:text-base text-slate-400 font-medium italic tracking-wide uppercase">Please visit again soon for updates.</p></div><div class="relative mt-12"><div class="w-20 md:w-32 h-2 bg-[#ff6600] rounded-full shadow-lg shadow-orange-100"></div><div class="absolute -top-1 -right-1 w-3 h-3 bg-blue-600 rounded-full animate-ping"></div></div></div><p class="mt-8 text-slate-400 text-sm font-medium tracking-widest uppercase">Sortiq Solutions © 2026</p><style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap');
        
        .font-sans {
          font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
        }

        @keyframes bounce-slow {
          0%, 100% { transform: translateY(0); }
          50% { transform: translateY(-10px); }
        }

        .animate-bounce-slow {
          animation: bounce-slow 3s ease-in-out infinite;
        }

        h1 {
          letter-spacing: -0.03em;
        }
      </style></div></main>
@endsection

