@extends('front.layouts.master')

@php
    // Astrotomic sayesinde aktif dilin verisini güvenle alıyoruz
    $content = $page->content ?? [];

    // Alt bölümleri undefined hatası almamak için değişkenlere atıyoruz
    $intro = $content['intro_section'] ?? [];
    $benefitsList = collect($content['benefits_section'] ?? []);
    $comparison = $content['comparison_section'] ?? [];
    $cta = $content['cta_section'] ?? [];
@endphp

@section('title', $page->title ?? 'Homepage')

@push('css')
@endpush

@section('content')

    <header id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $slider)
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{ optional($slider->image)->path }}" class="hero-carousel-img d-block w-100"
                         alt="{{{ optional($slider->image)->alt_text }}}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </header>

    <section class="home-intro-section container mx-auto px-4 pb-8 pt-14 text-center md:pb-16 md:pt-24">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="font-felix mb-5 text-2xl leading-snug md:text-3xl lg:text-4xl"
                    style="color: var(--primary-color);">
                    {!! $intro['title'] ?? 'Solid Core Composite Interior Doors Built to Last' !!}
                </h2>
                <div
                    class="mx-auto max-w-5xl space-y-5 text-base leading-relaxed text-gray-600 md:text-lg md:leading-loose lg:text-xl lg:leading-loose">
                    <p>
                        {!! $intro['paragraph_1'] ?? '' !!}
                    </p>
                    <p>
                        {!! $intro['paragraph_2'] ?? '' !!}
                    </p>
                    <p class="pt-2 font-felix text-xl tracking-wide md:text-2xl" style="color: var(--primary-color);">
                        {!! $intro['quote'] ?? '' !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="home-benefits-section bg-white px-3 py-10 sm:px-6 sm:py-12 lg:px-8">
        {{-- Grid yapısını esnek Flex yapısına çevirdik, böylece diziliş sırası bozulmadan yan yana akacaklar --}}
        <div class="home-benefits-grid mx-auto flex flex-wrap items-start justify-center gap-5 sm:gap-4 lg:gap-3 xl:gap-5 px-0 sm:flex-nowrap max-w-7xl">

            @foreach($benefitsList as $benefit)
                @php
                    $iconVal = $benefit['icon'] ?? '';
                    // İkon path ise storage'dan, sadece isimse assets klasöründen alıyoruz
                    $iconUrl = str_contains($iconVal, '/')
                        ? (str_contains($iconVal, 'http') ? $iconVal : asset('storage/' . $iconVal))
                        : asset('front/assets/icons/' . ($iconVal ?: 'default-icon.png'));
                @endphp

                @if(isset($benefit['is_featured']) && $benefit['is_featured'] == '1')
                    <!-- Öne Çıkan Özellik (Featured) - Büyük Tasarım -->
                    <div class="flex min-w-0 w-24 scale-105 flex-col items-center justify-center text-center sm:w-24 sm:flex-none lg:w-32 lg:scale-110 xl:w-36 mx-2 sm:mx-0">
                        <img src="{{ $iconUrl }}" alt="{{ $benefit['title'] ?? '' }} icon"
                             class="h-16 w-16 object-contain sm:h-20 sm:w-20 lg:h-24 lg:w-24 xl:h-28 xl:w-28">
                        <p class="mt-3 text-[9px] font-bold uppercase leading-tight tracking-normal text-gray-950 sm:mt-5 sm:text-xs sm:tracking-[0.16em] lg:text-sm">
                            {{ $benefit['title'] ?? '' }}
                        </p>
                    </div>
                @else
                    <!-- Normal Özellik - Standart Tasarım -->
                    <div class="flex min-w-0 w-20 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28 mx-1 sm:mx-0">
                        <img src="{{ $iconUrl }}" alt="{{ $benefit['title'] ?? '' }} icon"
                             class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                        <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                            {{ $benefit['title'] ?? '' }}
                        </p>
                    </div>
                @endif

            @endforeach

        </div>
    </section>

    <section class="door-comparison-section bg-white px-4 py-14 text-gray-900 sm:px-6 sm:py-16 lg:px-8 xl:py-20">
        @php
            // Sağ ve Sol Görseller için güvenli URL oluşturma (Boşsa varsayılan resmi gösterir)
            $image1 = $comparison['image_1'] ?? '';
            $image1Url = $image1
                ? (str_contains($image1, 'http') ? $image1 : asset('storage/' . $image1))
                : asset('front/assets/gallery/kapi1.png');

            $image2 = $comparison['image_2'] ?? '';
            $image2Url = $image2
                ? (str_contains($image2, 'http') ? $image2 : asset('storage/' . $image2))
                : asset('front/assets/gallery/kapi2.png');
        @endphp

        <div class="door-comparison-layout mx-auto grid max-w-7xl grid-cols-2 items-start gap-x-4 gap-y-8 sm:gap-x-8 sm:gap-y-10 lg:grid-cols-[minmax(220px,360px)_minmax(420px,1fr)_minmax(220px,360px)] lg:items-stretch lg:gap-8 xl:gap-12">

            <div class="col-start-1 row-start-1 flex h-full flex-col items-stretch lg:col-start-1 lg:row-start-1">
                <h3 class="door-comparison-label mb-4 flex min-h-[3rem] flex-col items-center justify-end text-center text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-600 sm:text-xs sm:tracking-[0.24em] lg:mb-5 lg:min-h-[3.75rem] lg:text-sm">
                    {{ $comparison['label_1'] ?? 'Erdoor' }}
                </h3>
                <img src="{{ $image1Url }}" alt="Erdoor portrait door design"
                     class="door-comparison-image aspect-[2/3] w-full rounded-lg object-cover shadow-xl shadow-gray-200/80 lg:min-h-0 lg:flex-1 lg:aspect-auto">
            </div>

            <div class="door-comparison-copy col-span-2 row-start-2 w-full lg:col-span-1 lg:col-start-2 lg:row-start-1">
                <h2 class="mb-7 text-center font-felix text-xl leading-tight text-gray-950 sm:text-2xl md:text-3xl lg:text-4xl lg:mb-8">
                    {!! $comparison['title'] ?? 'Same Look,<br>Big Difference' !!}
                </h2>

                <div class="mx-auto w-full max-w-2xl overflow-hidden rounded-lg bg-white">
                    <div
                        class="door-comparison-header grid grid-cols-[36px_minmax(0,1fr)_36px] items-center px-1 py-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-gray-500 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 sm:text-[10px] md:text-xs">
                        <span class="text-center">ER</span>
                        <span class="text-center">Feature</span>
                        <span class="text-center">Wood</span>
                    </div>

                    <div class="door-comparison-features text-xs sm:text-sm md:text-base lg:text-lg">
                        @foreach($comparison['features'] ?? [] as $feature)
                            <div
                                class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                                <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                     aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                          d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span
                                    class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">
                                    {{ $feature }}
                                </span>
                                <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                     aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                          d="M6 18 18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-start-2 row-start-1 flex h-full flex-col items-stretch lg:col-start-3 lg:row-start-1">
                <h3 class="door-comparison-label mb-4 flex min-h-[3rem] flex-col items-center justify-end text-center text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-600 sm:text-xs sm:tracking-[0.24em] lg:mb-5 lg:min-h-[3.75rem] lg:text-sm">
                    {{ $comparison['label_2'] ?? 'Traditional Wooden Door' }}
                </h3>
                <img src="{{ $image2Url }}" alt="Traditional portrait door design"
                     class="door-comparison-image aspect-[2/3] w-full rounded-lg object-cover shadow-xl shadow-gray-200/80 lg:min-h-0 lg:flex-1 lg:aspect-auto">
            </div>

        </div>
    </section>

    <div class="home-catalog-cta container-fluid bg-light py-5 text-center">
        <h1 class="display-4 fw-bold font-felix">{{ $cta['title'] ?? 'Our Interior Doors' }}</h1>
        <a href="{{ $cta['button_link'] ?? '#' }}" class="btn btn-accent btn-lg mt-4 px-5 rounded-0">
            {{ $cta['button_text'] ?? 'Explore The Catalog' }}
        </a>
    </div>

    <section id="products" class="container-fluid p-0 product-section">
        @foreach($doors as $door)
            <div class="row g-0 product-row align-items-center">
                <div class="col-md-6 {{$loop->iteration % 2 == 0 ? 'order-md-2' : ''}}">
                    <img src="{{ optional($door->media)->path }}" class="product-img object-right"
                         alt="{{ $door->name }}">
                </div>
                <div class="col-md-6 product-text-box">
                    <h2 class="display-5 fw-bold">{{$door->name}}</h2>
                    <h4 class="text-muted mb-3 fst-italic">“{{$door->collectionName}}”</h4>
                    <p class="lead text-muted">{{ str()->limit(strip_tags($door->description), 300) }}</p>
                    <div class="mt-4">
                        <a href="{{route('door-single', $door->slug)}}" class="btn btn-accent btn-lg px-5 rounded-0">Learn
                            More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

@endsection

@push('js')
@endpush
