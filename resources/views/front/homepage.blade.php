@extends('front.layouts.master')

@section('title', 'Homepage')

@push('css')
@endpush

@section('content')

    <header id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $slider)
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{ $slider->image->path }}" class="hero-carousel-img d-block w-100"
                         alt="{{{$slider->image->alt_text}}}">
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
                    style="color: var(--primary-color);">Solid Core Composite Interior Doors Built to Last</h2>
                <div
                    class="mx-auto max-w-5xl space-y-5 text-base leading-relaxed text-gray-600 md:text-lg md:leading-loose lg:text-xl lg:leading-loose">
                    <p>
                        ERDOOR manufactures <strong class="font-semibold text-gray-800">Solid Core Composite Interior
                            Doors</strong> that combine the natural beauty of wood with the durability of advanced WPC
                        technology. Our <strong class="font-semibold text-gray-800">Solid Core WPC Interior
                            Doors</strong>
                        feature realistic <strong class="font-semibold text-gray-800">wood-look finishes</strong>,
                        superior
                        sound insulation, and exceptional resistance to moisture, humidity, termites, warping, and
                        cracking.
                    </p>
                    <p>
                        Made with recycled materials, our <strong class="font-semibold text-gray-800">Composite Interior
                            Doors</strong> provide a sustainable, low-maintenance solution for modern residential and
                        commercial spaces&mdash;delivering lasting performance, timeless design, and premium quality.
                    </p>
                    <p class="pt-2 font-felix text-xl tracking-wide md:text-2xl" style="color: var(--primary-color);">
                        &ldquo;Elegance Born From Recycling&rdquo;</p>
                </div>
            </div>
        </div>
    </section>

    <section class="home-benefits-section bg-white px-3 py-10 sm:px-6 sm:py-12 lg:px-8">
        <div
            class="home-benefits-grid mx-auto grid max-w-7xl grid-cols-[1fr_auto_1fr] items-center gap-3 px-0 sm:flex sm:flex-nowrap sm:items-start sm:justify-center sm:gap-4 lg:gap-3 xl:gap-5">
            <div class="grid grid-cols-2 gap-x-3 gap-y-5 sm:contents">
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/Flame-retardent.jpg') }}" alt="Flame Retardant icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Flame Retardant</p>
                </div>
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/humidity-proof.jpg') }}" alt="Humidity Proof icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Humidity Proof</p>
                </div>
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/Eco-Friendly.jpg') }}" alt="Eco Friendly icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Eco Friendly</p>
                </div>
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/maintenance-free.jpg') }}" alt="Maintenance Free icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Maintenance Free</p>
                </div>
            </div>

            <div
                class="flex min-w-0 w-24 scale-105 flex-col items-center justify-center text-center sm:w-24 sm:flex-none lg:w-32 lg:scale-110 xl:w-36">
                <img src="{{ asset('front/assets/icons/warranty.jpg') }}" alt="25 Years of Warranty icon"
                     class="h-16 w-16 object-contain sm:h-20 sm:w-20 lg:h-24 lg:w-24 xl:h-28 xl:w-28">
                <p class="mt-3 text-[9px] font-bold uppercase leading-tight tracking-normal text-gray-950 sm:mt-5 sm:text-xs sm:tracking-[0.16em] lg:text-sm">
                    25 Years of Limited Warranty</p>
            </div>

            <div class="grid grid-cols-2 gap-x-3 gap-y-5 sm:contents">
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/noise-reduction.jpg') }}" alt="Noise Reduction icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Noise Reduction</p>
                </div>
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/Insect-proof.jpg') }}" alt="Termite and Insect Proof icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Termite &amp; Insect Proof</p>
                </div>
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/thermal-insulation.jpg') }}" alt="Thermal Insulation icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Thermal Insulation</p>
                </div>
                <div class="flex min-w-0 flex-col items-center text-center sm:w-24 sm:flex-none lg:w-24 xl:w-28">
                    <img src="{{ asset('front/assets/icons/water-proof.jpg') }}" alt="Water Proof icon"
                         class="h-12 w-12 object-contain sm:h-14 sm:w-14 lg:h-16 lg:w-16">
                    <p class="mt-2 text-[9px] font-semibold uppercase leading-tight tracking-normal text-gray-700 sm:mt-4 sm:text-xs sm:tracking-[0.14em] lg:text-sm lg:tracking-[0.16em]">
                        Water Proof</p>
                </div>
            </div>
        </div>
    </section>

    <section class="door-comparison-section bg-white px-4 py-14 text-gray-900 sm:px-6 sm:py-16 lg:px-8 xl:py-20">
        <div
            class="door-comparison-layout mx-auto grid max-w-7xl grid-cols-2 items-start gap-x-4 gap-y-8 sm:gap-x-8 sm:gap-y-10 lg:grid-cols-[minmax(220px,360px)_minmax(420px,1fr)_minmax(220px,360px)] lg:items-stretch lg:gap-8 xl:gap-12">
            <div class="col-start-1 row-start-1 flex h-full flex-col items-stretch lg:col-start-1 lg:row-start-1">
                <h3 class="door-comparison-label mb-4 flex min-h-[3rem] flex-col items-center justify-end text-center text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-600 sm:text-xs sm:tracking-[0.24em] lg:mb-5 lg:min-h-[3.75rem] lg:text-sm">
                    Erdoor</h3>
                <img src="{{ asset('front/assets/gallery/kapi1.png') }}" alt="Erdoor portrait door design"
                     class="door-comparison-image aspect-[2/3] w-full rounded-lg object-cover shadow-xl shadow-gray-200/80 lg:min-h-0 lg:flex-1 lg:aspect-auto">
            </div>

            <div class="door-comparison-copy col-span-2 row-start-2 w-full lg:col-span-1 lg:col-start-2 lg:row-start-1">
                <h2 class="mb-7 text-center font-felix text-xl leading-tight text-gray-950 sm:text-2xl md:text-3xl lg:text-4xl lg:mb-8">
                    Same Look,<br>Big Difference
                </h2>

                <div class="mx-auto w-full max-w-2xl overflow-hidden rounded-lg bg-white">
                    <div
                        class="door-comparison-header grid grid-cols-[36px_minmax(0,1fr)_36px] items-center px-1 py-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-gray-500 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 sm:text-[10px] md:text-xs">
                        <span class="text-center">ER</span>
                        <span class="text-center">Feature</span>
                        <span class="text-center">Wood</span>
                    </div>

                    <div class="door-comparison-features text-xs sm:text-sm md:text-base lg:text-lg">
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Water proof</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Moisture resistance</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Termite &amp; insect resistant</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Noise Reduction</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Thermal Insulation</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Eco-Friendly</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">B1 Fire Retardant</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Maintenance-Free</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">Anti-Bacterial</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div
                            class="grid grid-cols-[36px_minmax(0,1fr)_36px] items-center rounded-md px-1 py-2.5 transition-colors duration-200 hover:bg-gray-50 sm:grid-cols-[48px_minmax(0,1fr)_48px] sm:px-3 sm:py-3 md:py-3.5">
                            <svg class="mx-auto h-4 w-4 shrink-0 text-emerald-500 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="min-w-0 px-2 text-center font-light leading-snug tracking-wide text-gray-900">25 years of warranty</span>
                            <svg class="mx-auto h-4 w-4 shrink-0 text-rose-500/80 sm:h-5 sm:w-5 lg:h-6 lg:w-6"
                                 aria-label="Not included" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"
                                      d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-start-2 row-start-1 flex h-full flex-col items-stretch lg:col-start-3 lg:row-start-1">
                <h3 class="door-comparison-label mb-4 flex min-h-[3rem] flex-col items-center justify-end text-center text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-600 sm:text-xs sm:tracking-[0.24em] lg:mb-5 lg:min-h-[3.75rem] lg:text-sm">
                    Traditional Wooden Door</h3>
                <img src="{{ asset('front/assets/gallery/kapi2.png') }}" alt="Traditional portrait door design"
                     class="door-comparison-image aspect-[2/3] w-full rounded-lg object-cover shadow-xl shadow-gray-200/80 lg:min-h-0 lg:flex-1 lg:aspect-auto">
            </div>
        </div>
    </section>

    <div class="home-catalog-cta container-fluid bg-light py-5 text-center">
        <h1 class="display-4 fw-bold font-felix">Our Interior Doors</h1>
        <a href="catalog.html" class="btn btn-accent btn-lg mt-4 px-5 rounded-0">Explore The Catalog</a>
    </div>

    <section id="products" class="container-fluid p-0 product-section">

        @foreach($doors as $door)
            <div class="row g-0 product-row align-items-center">
                <div class="col-md-6 {{$loop->iteration % 2 == 0 ? 'order-md-2' : ''}}">
                    <img src="{{ $door->media->path }}" class="product-img object-right"
                         alt="SOHO">
                </div>
                <div class="col-md-6 product-text-box">
                    <h2 class="display-5 fw-bold">{{$door->name}}</h2>
                    <h4 class="text-muted mb-3 fst-italic">“{{$door->collectionName}}”</h4>
                    <p class="lead text-muted">{{ str()->limit(strip_tags($door->description), 300) }}</p>
                    <div class="mt-4">
                        <a href="soho-door.html" class="btn btn-accent btn-lg px-5 rounded-0">Learn More</a>
                    </div>
                </div>
            </div>
        @endforeach

    </section>
@endsection

@push('js')
@endpush
