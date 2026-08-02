@extends('front.layouts.master')

@section('title', 'SIGNATURA Premium - Erdoor')

@section('content')
    <main id="doorPageRoot" class="bg-white text-gray-950">
        <!-- Ana Ürün Bölümü -->
        <section
            class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-10 sm:px-6 md:py-14 lg:grid-cols-2 lg:items-center lg:gap-16 lg:px-8 xl:py-20">
            <div class="mx-auto w-full max-w-sm sm:max-w-md lg:max-w-[380px] xl:max-w-md">
                <div class="aspect-[2/3] w-full overflow-hidden rounded-lg bg-gray-50 shadow-2xl shadow-gray-200/80">
                    @if(isset($door->variants) && $door->variants->isNotEmpty())
                        <img id="productImage" src="{{ $door->variants->first()->picture?->url }}"
                             alt="SIGNATURA Premium Straight White finish door"
                             class="h-full w-full object-contain transition-opacity duration-300">
                    @else
                        <img id="productImage" src="{{ $door->image?->url }}"
                             alt="SIGNATURA Premium Straight White finish door"
                             class="h-full w-full object-contain transition-opacity duration-300">
                    @endif
                </div>
            </div>

            <div class="mx-auto w-full max-w-xl lg:mx-0">
                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.28em] text-gray-500">{{$door->collectionName}}</p>
                <h1 class="font-felix text-4xl leading-tight text-gray-950 sm:text-5xl lg:text-6xl">{{$door->name}}</h1>
                <p class="mt-5 text-base leading-relaxed text-gray-600 sm:text-lg lg:text-xl lg:leading-loose">{{$door->description}}</p>

                <div class="mt-9">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.22em] text-gray-500">{{__('door-single.variants-title')}}</h2>
                    <div class="mt-4 grid grid-cols-3 gap-3 sm:flex sm:flex-wrap sm:gap-4">
                        <!-- Straight White -->
                        @foreach($door->variants as $variant)
                            <button type="button"
                                    class="finish-swatch h-16 w-16 overflow-hidden rounded-md bg-white shadow-sm ring-2 ring-gray-950 ring-offset-2 transition hover:-translate-y-0.5 hover:shadow-md sm:h-20 sm:w-20"
                                    aria-label="{{$variant->name}}"
                                    data-door-image="{{ $variant->picture->url }}"
                                    data-color-name="{{ $variant->name }}">
                                <img src="{{ $variant->miniPicture->url }}"
                                     alt="{{ $variant->miniPicture->alt_text }}" class="h-full w-full object-cover">
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-10">
                    <a href="#"
                       class="inline-flex w-full items-center justify-center rounded-md bg-gray-950 px-8 py-4 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#c0392b] sm:w-auto">
                        {{__('door-single.requeset-a-quote')}}
                    </a>
                </div>
            </div>
        </section>

        <!-- Sertifikalar Bölümü -->
        @if(count($door->sertificates) > 0)
            <section class="border-y border-gray-200 bg-gray-50/70">
                <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">
                    <div
                        class="grid gap-8 lg:grid-cols-[minmax(240px,0.7fr)_minmax(0,1.3fr)] lg:items-center lg:gap-16">
                        <div>
                            <p class="mb-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#c0392b]">{{$door->sertification_badge}}</p>
                            <h2 class="font-felix text-3xl text-gray-950 sm:text-4xl">{{$door->sertification_title}}</h2>
                            <p class="mt-4 max-w-lg text-sm leading-relaxed text-gray-600 sm:text-base">{{$door->sertification_description}}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5 lg:gap-4"
                             aria-label="SIGNATURA certifications and standards">
                            @foreach($door->sertificates as $cert)
                                <div
                                    class="flex min-h-32 items-center justify-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:min-h-36">
                                    <img src="{{ $cert->image->url }}"
                                         alt="{{$cert->image->alt}}" class="h-20 w-full object-contain sm:h-24"
                                         loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Teknik Özellikler -->
        <section class="mx-auto max-w-7xl border-t border-gray-200 px-4 py-12 sm:px-6 md:py-16 lg:px-8">
            <div class="grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(320px,0.8fr)] lg:gap-16 xl:gap-24">
                <div class="w-full">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.25em] text-gray-500">{{__('door-single.technical-details')}}</p>
                    <h2 class="font-felix text-3xl text-gray-950 sm:text-4xl">{{__('door-single.spesifications')}}</h2>

                    <div class="mt-7 w-full overflow-hidden rounded-lg text-left">
                        @foreach($door->spesifications as $spec)
                            <div
                                class="grid grid-cols-[minmax(120px,0.85fr)_minmax(0,1.15fr)] gap-3 rounded-md px-3 py-2.5 text-sm transition hover:bg-gray-50 sm:px-4 sm:text-base">
                                <span class="font-medium text-gray-500">{{$spec->name}}</span>
                                <span class="text-right font-semibold text-gray-900">{{$spec->value}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button"
                        class="detail-lightbox-trigger group mx-auto block w-full max-w-[430px] overflow-hidden rounded-lg bg-gray-50 shadow-xl shadow-gray-200/70 transition hover:-translate-y-1 hover:shadow-2xl lg:mx-0 lg:justify-self-end"
                        data-lightbox-src="{{$door->spesificationImage->url}}"
                        aria-label="Open technical feature diagram">
                    <img src="{{$door->spesificationImage->url}}"
                         alt="{{$door->spesificationImage->alt_text}}"
                         class="block h-auto w-full object-contain transition duration-300 group-hover:scale-[1.02]">
                </button>
            </div>
        </section>

        <!-- İlgili Ürünler (Related Products) -->
        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8 xl:pb-20">
            <div class="rounded-lg bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-12">
                <div class="mb-8 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.25em] text-gray-500">{{__('door-single.explore-more')}}</p>
                        <h2 class="font-felix text-3xl text-gray-950 sm:text-4xl">{{__('door-single.related-products')}}</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    @foreach($relatedDoors as $door)
                        <article
                            class="flex h-full flex-col overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-gray-200">
                            <img src="{{ $door->image->url }}" alt="{{$door->image->alt_text}}"
                                 class="h-64 w-full object-cover object-right">
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="text-xl font-bold text-gray-950">{{$door->name}}</h3>
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-gray-600">{{str()->limit(strip_tags($door->description) ,125)}}</p>
                                <a href="{{route('door-single', $door->slug)}}"
                                   class="mt-6 inline-flex w-full items-center justify-center rounded-md border border-gray-950 px-5 py-3 text-sm font-semibold text-gray-950 transition hover:bg-gray-950 hover:text-white">Learn
                                    More</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- Lightbox ve Tooltip Bileşenleri -->
    <div id="imageLightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4">
        <button type="button" id="lightboxClose"
                class="absolute right-5 top-5 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-3xl leading-none textsele-white transition hover:bg-white/20"
                aria-label="Close image preview">&times;
        </button>
        <img id="lightboxImage" src="" alt="Expanded product detail"
             class="max-h-[88vh] max-w-[92vw] rounded-lg object-contain shadow-2xl">
    </div>

    <div id="finishTooltip"
         class="pointer-events-none fixed left-0 top-0 z-50 invisible rounded-md bg-gray-950 px-3 py-2 text-xs font-semibold tracking-wide text-white opacity-0 shadow-xl transition-opacity duration-100"></div>
@endsection

@push('js')
    <script src="{{asset('front/js/door-page.js')}}"></script>
@endpush
