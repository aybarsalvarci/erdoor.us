@extends('front.layouts.master')

@php
    // JSON içeriğini güvenle değişkenlere alıyoruz
    $content = $page->content ?? [];

    $hero = $content['hero_section'] ?? [];
    $intro = $content['intro_section'] ?? [];
    $benefits = $content['benefits_section'] ?? [];
    $cards = $benefits['cards'] ?? [];
    $comparison = $content['comparison_section'] ?? [];
@endphp

@section('title', $page->title ?? 'Why WPC')

@push('css')
@endpush

@section('content')

    <main>
        <!-- ================= HERO BÖLÜMÜ ================= -->
        <section class="wpc-hero" aria-labelledby="wpc-title">
            <div class="container wpc-hero-grid">
                <div class="wpc-hero-copy">
                    <p class="wpc-eyebrow">{{ $hero['eyebrow'] ?? '' }}</p>
                    <h1 id="wpc-title">{!! $hero['title'] ?? '' !!}</h1>
                    <p>{{ $hero['description'] ?? '' }}</p>
                    <a href="#wpc-benefits" class="wpc-hero-link">
                        {{ $hero['link_text'] ?? 'Explore the advantages' }} <span aria-hidden="true">↓</span>
                    </a>
                </div>

                <div class="wpc-hero-product" aria-label="Erdoor composite interior door">
                    <div class="wpc-product-halo"></div>
                    @php
                        // Görsel kontrolü
                        $heroImg = $hero['image'] ?? '';
                        $heroImgUrl = str_contains($heroImg, '/')
                            ? (str_contains($heroImg, 'http') ? $heroImg : asset('storage/' . $heroImg))
                            : asset('front/assets/products/' . ($heroImg ?: 'CompositFillingDoor.jpg'));
                    @endphp
                    <img src="{{ $heroImgUrl }}" alt="{{ strip_tags($hero['title'] ?? 'WPC Door') }}">
                    <div class="wpc-product-note">
                        <strong>{{ $hero['note_1'] ?? '' }}</strong>
                        <span>{{ $hero['note_2'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= INTRO BÖLÜMÜ ================= -->
        <section class="wpc-introduction">
            <div class="container wpc-intro-grid">
                <div>
                    <p class="wpc-section-label">{{ $intro['label'] ?? '' }}</p>
                    <h2>{{ $intro['title'] ?? '' }}</h2>
                </div>
                <div class="wpc-intro-copy">
                    <p>{{ $intro['paragraph_1'] ?? '' }}</p>
                    @if(!empty($intro['paragraph_2']))
                        <p>{{ $intro['paragraph_2'] }}</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- ================= AVANTAJLAR (BENEFITS) ================= -->
        <section id="wpc-benefits" class="wpc-benefits" aria-labelledby="benefits-title">
            <div class="container">
                <div class="wpc-benefits-heading">
                    <div>
                        <p class="wpc-section-label">{{ $benefits['label'] ?? '' }}</p>
                        <h2 id="benefits-title">{{ $benefits['title'] ?? '' }}</h2>
                    </div>
                    <p>{{ $benefits['description'] ?? '' }}</p>
                </div>

                <div class="wpc-benefit-grid">
                    @foreach($cards as $index => $card)
                        @php
                            // İkon URL kontrolü
                            $icon = $card['icon'] ?? '';
                            $iconUrl = str_contains($icon, '/')
                                ? (str_contains($icon, 'http') ? $icon : asset('storage/' . $icon))
                                : asset('front/assets/icons/' . ($icon ?: 'default.jpg'));

                            // İlk karta --wide, son karta --accent sınıfı ekliyoruz
                            $extraClass = '';
                            if ($loop->first) {
                                $extraClass = 'wpc-benefit-card--wide';
                            } elseif ($loop->last) {
                                $extraClass = 'wpc-benefit-card--accent';
                            }

                            // Numarayı 01, 02 formatında yazdırıyoruz
                            $cardNumber = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                        @endphp

                        <article class="wpc-benefit-card {{ $extraClass }}">
                            <div class="wpc-benefit-icon">
                                <img src="{{ $iconUrl }}" alt="" aria-hidden="true">
                            </div>
                            <div>
                                <span>{{ $cardNumber }}</span>
                                <h3>{{ $card['title'] ?? '' }}</h3>
                                <p>{{ $card['description'] ?? '' }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ================= KARŞILAŞTIRMA (COMPARISON) ================= -->
        <section class="wpc-comparison">
            <div class="container wpc-comparison-grid">
                <div class="wpc-comparison-title">
                    <p class="wpc-section-label">{{ $comparison['label'] ?? '' }}</p>
                    <h2>{!! $comparison['title'] ?? '' !!}</h2>
                </div>
                <div class="wpc-comparison-copy">
                    <p>{{ $comparison['description'] ?? '' }}</p>

                    @if(!empty($comparison['quote']))
                        <blockquote>{{ $comparison['quote'] }}</blockquote>
                    @endif

                    <a href="{{ $comparison['button_link'] ?? '#' }}" class="wpc-cta">
                        {{ $comparison['button_text'] ?? 'Talk to our team' }} <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

@endsection

@push('js')
@endpush
