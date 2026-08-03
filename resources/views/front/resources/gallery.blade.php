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
