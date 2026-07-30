@extends('front.layouts.master')

@section('title', 'SIGNATURA Premium - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/gallery.css')}}">
@endpush
@section('content')
    <main>
        <section class="gallery-hero">
            <div class="container gallery-hero-content">
                <a href="resources.html" class="gallery-back"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Resources</a>
                <p class="gallery-eyebrow">Exhibitions &amp; Events</p>
                <h1>Where our brands<br>meet the world.</h1>
                <p>Discover Erdoor at company fairs, explore our latest door exhibitions, and see product showcases from across the Ergünbaş Group.</p>
            </div>
        </section>

        <section class="gallery-section" aria-label="Erdoor exhibitions and company events">
            <div class="container">
                <div class="gallery-heading">
                    <div>
                        <p class="gallery-eyebrow">From the exhibition floor</p>
                        <h2>Fairs, displays &amp; group showcases</h2>
                    </div>
                    <p>Follow our products, people, and group companies through exhibitions and industry events.</p>
                </div>
                <div class="gallery-grid" id="galleryGrid"></div>
                <div class="gallery-load-more">
                    <button type="button" id="loadMoreBtn">Load more photos <i class="fa-solid fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('js')
    <script src="{{asset('front/js/gallery.js')}}"></script>
@endpush
