@extends('front.layouts.master')

@section('title', 'SIGNATURA Premium - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/media-resource.css')}}">
@endpush
@section('content')
    <main>
        <section class="media-resource-hero">
            <div class="container">
                <a href="{{route('resources')}}" class="media-back-link"><i class="fa-solid fa-arrow-left"
                                                                    aria-hidden="true"></i> Resources</a>
                <p class="media-eyebrow">Installation guide</p>
                <h1>Install with confidence.</h1>
                <p>Watch the complete Erdoor door installation process for guidance on preparation, alignment, hardware,
                    and final adjustments.</p>
            </div>
        </section>

        <section class="media-resource-content">
            <div class="container media-resource-grid">
                <div class="video-panel" data-video-panel>
                    <p class="media-video-label">Installation film</p>
                    <div class="video-frame">
                        <video controls playsinline preload="metadata" poster="assets/gallery/4.jpg"
                               data-resource-video>
                            <source src="assets/videos/instillation.mp4" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                        <div class="video-status" data-video-status>
                            <i class="fa-solid fa-film" aria-hidden="true"></i>
                            <strong>Installation video unavailable</strong>
                            <span>Please try again or contact Erdoor support.</span>
                        </div>
                    </div>
                </div>

                <aside class="media-notes">
                    <p class="media-eyebrow">Before you begin</p>
                    <h2>Prepare for a precise fit</h2>
                    <ol>
                        <li><span>01</span>
                            <div><strong>Inspect the opening</strong>
                                <p>Confirm the opening is clean, level, plumb, and sized for the selected door
                                    system.</p></div>
                        </li>
                        <li><span>02</span>
                            <div><strong>Review components</strong>
                                <p>Verify the frame, leaf, hardware, fasteners, and accessories before installation.</p>
                            </div>
                        </li>
                        <li><span>03</span>
                            <div><strong>Make final adjustments</strong>
                                <p>Check clearances, alignment, latch operation, and smooth movement before
                                    completion.</p></div>
                        </li>
                    </ol>
                    <p class="media-disclaimer">Always follow project requirements, local building codes, and the
                        instructions supplied with your Erdoor system.</p>
                </aside>
            </div>
        </section>
    </main>
@endsection

@push('js')
    <script src="{{asset('front/js/media-resource.js')}}"></script>
@endpush
