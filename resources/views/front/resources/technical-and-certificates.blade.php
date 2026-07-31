@extends('front.layouts.master')

{{-- Dinamik Sayfa Başlığı --}}
@section('title', ($page->title ?? 'Technical & Certificates') . ' - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/technical-certificates.css') }}">
@endpush

@php
    // JSON içeriklerini güvenli bir şekilde değişkene alıyoruz
    $content = $page->page_content ?? [];
@endphp

@section('content')
    <main>
        <!-- HERO (KAPAK) BÖLÜMÜ -->
        <section class="technical-hero">
            <div class="container">
                <a href="{{ route('resources') }}" class="technical-back">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    {{ $content['hero']['back_link'] ?? 'Resources' }}
                </a>
                <p class="technical-eyebrow">{{ $content['hero']['eyebrow'] ?? 'Document library' }}</p>

                {{-- HTML etiketlerine (<br>) izin vermek için {!! !!} kullanıyoruz --}}
                <h1>{!! $content['hero']['title'] ?? 'Technical &amp;<br>Certificates' !!}</h1>

                <p>{{ $content['hero']['description'] ?? $page->description }}</p>
            </div>
        </section>

        <!-- KÜTÜPHANE VE DOKÜMANLAR BÖLÜMÜ -->
        <section class="technical-library">
            <div class="container">
                <div class="technical-toolbar">
                    <div>
                        <p class="technical-eyebrow">{{ $content['library']['eyebrow'] ?? 'Available documents' }}</p>
                        <h2>{{ $content['library']['title'] ?? 'Browse the library' }}</h2>
                    </div>

                    {{-- Kategori Filtreleri --}}
                    <div class="document-filters">
                        <a href="{{ request()->fullUrlWithQuery(['category' => null, 'page' => null]) }}"
                           class="{{ !request('category') ? 'is-active' : '' }}"
                           style="text-decoration: none;">
                            {{ $content['library']['filter_all'] ?? 'All' }}
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['category' => 'certificate', 'page' => null]) }}"
                           class="{{ request('category') == 'certificate' ? 'is-active' : '' }}"
                           style="text-decoration: none;">
                            {{ $content['library']['filter_cert'] ?? 'Certificates' }}
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['category' => 'technical', 'page' => null]) }}"
                           class="{{ request('category') == 'technical' ? 'is-active' : '' }}"
                           style="text-decoration: none;">
                            {{ $content['library']['filter_tech'] ?? 'Technical' }}
                        </a>
                    </div>

                    {{-- Arama Formu --}}
                    <form action="{{ url()->current() }}" method="GET" class="technical-search-form">
                        {{-- Kategori seçiliyse arama yaparken kategoriyi koru --}}
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <label class="technical-search">
                            <span class="sr-only">{{ $content['library']['search_placeholder'] ?? 'Search documents' }}</span>
                            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                            <input type="search" name="search" value="{{ request('search') }}"
                                   placeholder="{{ $content['library']['search_placeholder'] ?? 'Search documents' }}"
                                   onchange="this.form.submit()">
                        </label>
                    </form>
                </div>

                <!-- DOKÜMAN LİSTESİ -->
                <div class="document-grid">
                    @forelse($documents as $document)
                        <a class="document-card"
                           href="{{ asset($document->path) }}"
                           target="_blank"
                           aria-label="Open {{ $document->title }}">

                            <div class="document-icon">
                                <i class="fa-solid {{ $document->icon }}" aria-hidden="true"></i>
                            </div>

                            <p class="document-type">{{ $document->type }}</p>
                            <h3>{{ $document->title }}</h3>
                            <p>{{ $document->description }}</p>

                            <div class="document-actions">
                                <span class="document-view-link">
                                    {{ $content['library']['view_link'] ?? 'Open document' }}
                                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </div>
                        </a>
                    @empty
                        {{-- Hiç sonuç bulunamazsa --}}
                        <p class="document-empty">{{ $content['library']['empty_text'] ?? 'No documents match your search.' }}</p>
                    @endforelse
                </div>

                {{-- Sayfalama Linkleri (Eğer sayfalama varsa altta görünmesi için) --}}
                @if($documents->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $documents->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </section>

        <!-- YARDIM VE DESTEK BÖLÜMÜ -->
        <section class="technical-help">
            <div class="container technical-help-inner">
                <div>
                    <p class="technical-eyebrow">{{ $content['help']['eyebrow'] ?? 'Project support' }}</p>
                    <h2>{{ $content['help']['title'] ?? 'Need a specific report?' }}</h2>
                    <p>{{ $content['help']['description'] ?? 'Ask our team for the documentation required for your market, product configuration, or project.' }}</p>
                </div>
                <a href="{{ $content['help']['button_link'] ?? '#' }}">
                    {{ $content['help']['button_text'] ?? 'Request a document' }}
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>
    </main>
@endsection
