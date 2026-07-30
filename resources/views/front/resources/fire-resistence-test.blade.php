@extends('front.layouts.master')

@section('title', 'SIGNATURA Premium - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/media-resource.css')}}">
@endpush
@section('content')
    <main>
        <section class="media-resource-hero">
            <div class="container">
                <a href="resources.html" class="media-back-link"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Resources</a>
                <p class="media-eyebrow">Performance testing</p>
                <h1>Fire resistance in action.</h1>
                <p>View controlled test footage demonstrating the performance of an Erdoor door assembly under fire exposure.</p>
            </div>
        </section>

        <section class="media-resource-content">
            <div class="container media-resource-grid">
                <div class="video-panel" data-video-panel>
                    <p class="media-video-label">Performance test film</p>
                    <div class="video-frame">
                        <video controls playsinline preload="metadata" poster="assets/carousel/carousel-image-fire-rated.png" data-resource-video>
                            <source src="assets/videos/firetest.mp4" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                        <div class="video-status" data-video-status>
                            <i class="fa-solid fa-fire-flame-curved" aria-hidden="true"></i>
                            <strong>Fire test video unavailable</strong>
                            <span>Please try again or contact Erdoor support.</span>
                        </div>
                    </div>
                </div>

                <aside class="media-notes">
                    <p class="media-eyebrow">Test overview</p>
                    <h2>Evaluated under controlled conditions</h2>
                    <ol>
                        <li><span>01</span><div><strong>Complete assembly</strong><p>The test evaluates the door leaf, frame, hardware, and installation as a complete system.</p></div></li>
                        <li><span>02</span><div><strong>Controlled exposure</strong><p>Performance is observed throughout a defined heating and test sequence.</p></div></li>
                        <li><span>03</span><div><strong>Documented results</strong><p>Applicable classifications and supporting reports should be reviewed for each specified configuration.</p></div></li>
                    </ol>
                    <p class="media-disclaimer">Fire performance varies by tested assembly. Consult the applicable certificate or test report before specification.</p>
                </aside>
            </div>
        </section>
    </main>
@endsection

@push('js')
    <script src="{{asset('front/js/media-resource.js')}}"></script>
@endpush
