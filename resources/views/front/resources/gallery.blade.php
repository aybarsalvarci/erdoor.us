@extends('front.layouts.master')

@section('title', ($page->translate(app()->getLocale())->title ?? 'Gallery') . ' - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/gallery.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <style>
        /* GÜÇLENDİRİLMİŞ CSS: Eski gallery.css kurallarını kesin olarak ezer */
        #galleryGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            align-items: start;
        }

        #galleryGrid .gallery-item {
            background-color: #ffffff !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            display: flex !important;
            flex-direction: column !important;
            padding: 0 !important;
            border: none !important;
            position: relative !important;
        }

        #galleryGrid .gallery-item:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }

        #galleryGrid .gallery-link {
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            height: 100% !important;
            text-decoration: none !important;
            color: inherit !important;
        }

        #galleryGrid .gallery-item img {
            width: 100% !important;
            height: 250px !important;
            object-fit: cover !important;
            display: block !important;
            margin: 0 !important;
        }

        #galleryGrid .gallery-item-title {
            margin: 0 !important;
            padding: 16px 20px !important;
            font-size: 1.05rem !important;
            font-weight: 500 !important;
            color: #333333 !important;
            text-align: center !important;
            background-color: #f8f9fa !important;
            background-image: none !important;
            border-top: 1px solid #eeeeee !important;
            position: static !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
    </style>
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
                            <div class="gallery-item">
                                <a href="{{ $image->media->type == 'internal' ? Storage::url($image->media->path) : $image->media->path }}"
                                   data-fancybox="gallery"
                                   data-caption="{{ $image->translate(app()->getLocale())?->title }}"
                                   class="gallery-link">

                                    <img src="{{ $image->media->type == 'internal' ? Storage::url($image->media->path) : $image->media->path }}"
                                         alt="{{ $image->translate(app()->getLocale())?->title }}"
                                         loading="lazy">

                                    <h3 class="gallery-item-title">{{ $image->translate(app()->getLocale())?->title }}</h3>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Fancybox Başlatma
            if (typeof Fancybox !== "undefined") {
                Fancybox.bind('[data-fancybox="gallery"]', {});
            }

            // AJAX Load More İşlemi
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const galleryGrid = document.getElementById('galleryGrid');

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function () {
                    const btn = this;
                    const url = btn.getAttribute('data-next-page');
                    const btnText = btn.querySelector('.btn-text');
                    const btnIcon = btn.querySelector('.btn-icon');
                    const originalText = btnText.innerText;

                    if (!url) return;

                    btnText.innerText = 'Yükleniyor...';
                    btnIcon.classList.remove('fa-plus');
                    btnIcon.classList.add('fa-spinner', 'fa-spin');
                    btn.setAttribute('disabled', 'true');

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Sadece dolu gallery-item'ları al
                            const newItems = doc.querySelectorAll('#galleryGrid .gallery-item');

                            newItems.forEach(item => {
                                galleryGrid.appendChild(item);
                            });

                            const newBtn = doc.getElementById('loadMoreBtn');
                            if (newBtn && newBtn.hasAttribute('data-next-page')) {
                                btn.setAttribute('data-next-page', newBtn.getAttribute('data-next-page'));
                                btnText.innerText = originalText;
                                btnIcon.classList.remove('fa-spinner', 'fa-spin');
                                btnIcon.classList.add('fa-plus');
                                btn.removeAttribute('disabled');
                            } else {
                                btn.remove();
                            }
                        })
                        .catch(error => {
                            console.error('Yükleme hatası:', error);
                            btnText.innerText = 'Tekrar Dene';
                            btnIcon.classList.remove('fa-spinner', 'fa-spin');
                            btnIcon.classList.add('fa-rotate-right');
                            btn.removeAttribute('disabled');
                        });
                });
            }
        });
    </script>
@endpush
