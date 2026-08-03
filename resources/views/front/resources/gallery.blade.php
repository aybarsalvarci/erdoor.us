@extends('front.layouts.master')

@section('title', ($page->translate(app()->getLocale())->title ?? 'Gallery') . ' - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/gallery.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
@endpush

@php
    $content = $page->translate(app()->getLocale())->page_content ?? [];
@endphp

@section('content')
    <main>
        <!-- HERO (KAPAK) BÖLÜMÜ -->
        <section class="gallery-hero">
            <div class="container gallery-hero-content">
                <a href="{{ route('resources') }}" class="gallery-back">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    {{ $content['hero']['back_link'] ?? 'Resources' }}
                </a>
                <p class="gallery-eyebrow">{{ $content['hero']['eyebrow'] ?? 'Exhibitions & Events' }}</p>

                <h1>{!! $content['hero']['title'] ?? 'Where our brands<br>meet the world.' !!}</h1>

                <p>{{ $content['hero']['description'] ?? $page->translate(app()->getLocale())->description }}</p>
            </div>
        </section>

        <!-- GALERİ BÖLÜMÜ -->
        <section class="gallery-section" aria-label="Erdoor exhibitions and company events">
            <div class="container">
                <div class="gallery-heading">
                    <div>
                        <p class="gallery-eyebrow">{{ $content['gallery']['eyebrow'] ?? 'From the exhibition floor' }}</p>
                        <h2>{{ $content['gallery']['title'] ?? 'Fairs, displays & group showcases' }}</h2>
                    </div>
                    <p>{{ $content['gallery']['description'] ?? 'Follow our products, people, and group companies through exhibitions and industry events.' }}</p>
                </div>

                <!-- GALERİ GRID İÇERİĞİ -->
                <div class="gallery-grid" id="galleryGrid">
                    @foreach($images as $image)
                        @if($image->media)
                            @php
                                $imgUrl = $image->media->type == 'internal' ? Storage::url($image->media->path) : $image->media->path;
                                $imgTitle = $image->translate(app()->getLocale())?->title;
                            @endphp

                            <div class="gallery-item">
                                <a href="{{ $imgUrl }}"
                                   data-fancybox="gallery"
                                   data-caption="{{ $imgTitle }}"
                                   class="gallery-link">

                                    <!-- EKSİK OLAN KISIM BURASI: Resim ve Yazıyı Saran image-wrapper -->
                                    <div class="image-wrapper">
                                        <img src="{{ $imgUrl }}"
                                             alt="{{ $imgTitle ?? 'Gallery Image' }}"
                                             loading="lazy">

                                        <!-- SADECE BAŞLIK VARSA GÖSTERİLECEK ALAN (Gradient Overlay) -->
                                        @if(!empty(trim($imgTitle)))
                                            <div class="gallery-overlay">
                                                <h3 class="gallery-item-title">{{ $imgTitle }}</h3>
                                            </div>
                                        @endif
                                    </div>

                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- DAHA FAZLA YÜKLE BUTONU -->
                <div class="gallery-load-more mt-5 text-center">
                    @if($images->hasMorePages())
                        <button type="button"
                                id="loadMoreBtn"
                                data-next-page="{{ $images->nextPageUrl() }}"
                                class="btn-load-more">
                            <span class="btn-text">{{ $content['gallery']['load_more'] ?? 'Load more photos' }}</span>
                            <i class="fa-solid fa-plus btn-icon" aria-hidden="true"></i>
                        </button>
                    @endif
                </div>

            </div>
        </section>
    </main>
@endsection

@push('js')
    <!-- Fancybox JS (Popup İçin) -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="{{asset('front/js/gallery.js')}}"></script>
@endpush
