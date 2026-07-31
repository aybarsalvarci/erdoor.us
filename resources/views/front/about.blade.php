@extends('front.layouts.master')

@php
    // JSON içeriğini güvenle değişkenlere alıyoruz
    $content = $page->content ?? [];

    $hero = $content['hero_section'] ?? [];
    $intro = $content['intro_section'] ?? [];
    $factories = $intro['factories'] ?? [];
    $global = $content['global_section'] ?? [];
    $logos = $global['logos'] ?? [];
    $paragraphs = $global['paragraphs'] ?? [];
@endphp

@section('title', $page->title ?? 'About us')

@push('css')
@endpush

@section('content')
    <main>
        <!-- ================= HERO BÖLÜMÜ ================= -->
        <section class="about-hero" aria-labelledby="about-title">
            <div class="container about-hero-inner">
                <p class="about-eyebrow">{{ $hero['eyebrow'] ?? 'Our story' }}</p>
                <h1 id="about-title">{!! $hero['title'] ?? 'Built on experience.<br>Designed for what’s next.' !!}</h1>
                <p class="about-hero-copy">{{ $hero['description'] ?? '' }}</p>
            </div>
        </section>

        <!-- ================= INTRO & FABRİKALAR ================= -->
        <section class="about-intro" aria-label="About Erdoor">
            <div class="container about-intro-grid">
                <div class="about-story">
                    <p class="about-section-label">{{ $intro['label'] ?? 'Since 1989' }}</p>
                    <h2>{{ $intro['title'] ?? 'Manufacturing strength with a global outlook' }}</h2>
                    <p>{{ $intro['paragraph_1'] ?? '' }}</p>
                    @if(!empty($intro['paragraph_2']))
                        <p>{{ $intro['paragraph_2'] }}</p>
                    @endif
                </div>

                <div class="factory-stack" aria-label="Erdoor manufacturing facilities">
                    @foreach($factories as $factory)
                        @php
                            // Görsel yolunu belirliyoruz (storage, url veya local)
                            $img = $factory['image'] ?? '';
                            $imgUrl = str_contains($img, '/')
                                ? (str_contains($img, 'http') ? $img : asset('storage/' . $img))
                                : asset('front/assets/about-us/' . ($img ?: 'Turkiye-fabrika.JPG'));

                            // Numarayı 01, 02 formatında yazdırıyoruz
                            $number = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                            // İlk resim hemen yüklensin (eager), diğerleri tembel yüklensin (lazy)
                            $loading = $loop->first ? 'eager' : 'lazy';
                        @endphp
                        <figure class="factory-card">
                            <img src="{{ $imgUrl }}" alt="{{ $factory['country'] ?? 'Manufacturing facility' }}" loading="{{ $loading }}">
                            <figcaption>
                                <span>{{ $number }}</span>
                                <div>
                                    <strong>{{ $factory['country'] ?? '' }}</strong>
                                    <small>{{ $factory['type'] ?? '' }}</small>
                                </div>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ================= GLOBAL (KÜRESEL ERİŞİM) ================= -->
        <section class="about-global about-global--sticky">
            <div class="container about-global-grid">
                <aside class="about-global-aside">
                    <p class="about-section-label">{{ $global['label'] ?? 'Global reach' }}</p>
                    <h2>{!! $global['title'] ?? 'Quality, service<br>and partnership' !!}</h2>

                    <div class="about-company-logos" aria-label="Ergunbas Group and Erdoor">
                        @foreach($logos as $logo)
                            @php
                                $logoUrl = str_contains($logo, '/')
                                    ? (str_contains($logo, 'http') ? $logo : asset('storage/' . $logo))
                                    : asset('front/assets/logo/' . ($logo ?: 'logo_erdoor.png'));
                            @endphp
                            <div class="about-logo-card">
                                <img src="{{ $logoUrl }}" alt="Company Logo">
                            </div>
                        @endforeach
                    </div>
                </aside>

                <div class="about-global-copy">
                    <!-- Dinamik Paragraflar -->
                    @foreach($paragraphs as $paragraph)
                        @if(!empty(trim($paragraph)))
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach

                    <a href="{{ $global['button_link'] ?? 'contact.html' }}" class="about-cta">
                        {{ $global['button_text'] ?? 'Start a conversation' }} <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('js')
@endpush
