@extends('front.layouts.master')

@section('title', $page->title . ' - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/media-resource.css')}}">
    <style>
        /* YouTube iframe'inin mevcut tasarım kutusuna tam oturması için */
        .video-frame iframe {
            width: 100%;
            aspect-ratio: 16 / 9;
            border: none;
            border-radius: inherit;
        }
    </style>
@endpush

@php
    $content = $page->page_content ?? [];
@endphp

@section('content')
    <main>
        <section class="media-resource-hero">
            <div class="container">
                <a href="{{route('resources')}}" class="media-back-link">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    {{ $content['hero']['back_link'] ?? 'Resources' }}
                </a>
                <p class="media-eyebrow">{{ $content['hero']['eyebrow'] ?? '' }}</p>
                <h1>{!! nl2br(e($content['hero']['title'] ?? $page->title)) !!}</h1>
                <p>{{ $content['hero']['description'] ?? $page->description }}</p>
            </div>
        </section>

        <section class="media-resource-content">
            <div class="container media-resource-grid">

                <!-- VİDEO ALANI -->
                <div class="video-panel" data-video-panel>
                    <p class="media-video-label">{{ $content['video']['label'] ?? '' }}</p>
                    <div class="video-frame">
                        @if(!empty($content['video']['iframe']))
                            <!-- Admin panelden gelen YouTube Iframe kodu raw (işlenmemiş) olarak basılıyor -->
                            {!! $content['video']['iframe'] !!}
                        @else
                            <!-- Eğer iframe eklenmemişse hata ekranı gösteriliyor -->
                            <div class="video-status" data-video-status style="display: flex;">
                                <i class="fa-solid fa-fire-flame-curved" aria-hidden="true"></i>
                                <strong>{{ $content['video']['error_title'] ?? 'Fire test video unavailable' }}</strong>
                                <span>{{ $content['video']['error_desc'] ?? 'Please try again or contact Erdoor support.' }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- NOTLAR VE ADIMLAR ALANI -->
                <aside class="media-notes">
                    <p class="media-eyebrow">{{ $content['notes']['eyebrow'] ?? '' }}</p>
                    <h2>{{ $content['notes']['title'] ?? '' }}</h2>
                    <ol>
                        @if(!empty($content['notes']['steps']))
                            @foreach($content['notes']['steps'] as $step)
                                <li>
                                    <!-- str_pad ile numaraları 1 yerine 01, 02 formatına çeviriyoruz -->
                                    <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>
                                        <strong>{{ $step['title'] ?? '' }}</strong>
                                        <p>{{ $step['description'] ?? '' }}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ol>
                    <p class="media-disclaimer">{{ $content['notes']['disclaimer'] ?? '' }}</p>
                </aside>

            </div>
        </section>
    </main>
@endsection

@push('js')
    <script src="{{asset('front/js/media-resource.js')}}"></script>
@endpush
