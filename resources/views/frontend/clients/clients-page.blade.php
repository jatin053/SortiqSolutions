@extends('layouts.frontend')

@section('title', 'Trusted Partners | Sortiq Solutions pvt ltd')
@section('body_attributes') data-route="/clients" @endsection

@section('content')
<main class="font-raleway bg-white min-h-screen">
    <section class="py-16 md:py-20 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-[#00215e] text-4xl md:text-5xl font-black mb-4">Our Clients</h1>
            <p class="max-w-3xl mx-auto text-gray-600 text-lg leading-relaxed">
                Client logos shown here are managed from the admin panel. Add, edit, or reorder them there and this page updates automatically.
            </p>
            <div class="w-16 h-1 bg-orange-500 mx-auto mt-6 mb-14"></div>

            @if ($clientLogos->count())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($clientLogos as $clientLogo)
                        <article id="{{ $clientLogo['slug'] }}" class="bg-white rounded-[1.75rem] border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-shadow flex flex-col items-center justify-center min-h-[220px]">
                            <div class="w-full h-24 flex items-center justify-center">
                                @if ($clientLogo->logo_url)
                                    <img src="{{ $clientLogo->logo_url }}" alt="{{ $clientLogo['name'] }}" class="max-h-full max-w-full object-contain">
                                @else
                                    <div class="text-xl font-extrabold text-gray-500 text-center">{{ $clientLogo['name'] }}</div>
                                @endif
                            </div>

                            <h2 class="mt-6 text-lg font-black text-[#00142e] text-center">{{ $clientLogo['name'] }}</h2>

                            @if ($clientLogo['description'])
                                <p class="mt-3 text-sm text-gray-500 text-center leading-relaxed">{{ $clientLogo['description'] }}</p>
                            @endif

                            @if ($clientLogo['website'])
                                <a href="{{ $clientLogo['website'] }}" target="_blank" rel="noopener" class="mt-5 inline-flex items-center gap-2 text-[#ff6600] font-bold hover:text-orange-700 transition-colors">
                                    Visit website
                                    <span aria-hidden="true">↗</span>
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div class="rounded-[1.75rem] border border-gray-200 p-12 text-center text-gray-500 shadow-sm">
                    No client logos have been published yet.
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
