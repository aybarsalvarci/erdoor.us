@extends('front.layouts.master')

@section('title', 'SIGNATURA Premium - Erdoor')

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/technical-certificates.css') }}">
@endpush

@section('content')
    <main>
        <section class="technical-hero">
            <div class="container">
                <a href="{{ route('resources') }}" class="technical-back">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Resources
                </a>
                <p class="technical-eyebrow">Document library</p>
                <h1>Technical &amp;<br>Certificates</h1>
                <p>Certificates, technical specifications, and test reports&mdash;organized in one accessible document grid.</p>
            </div>
        </section>

        <section class="technical-library">
            <div class="container">
                <div class="technical-toolbar">
                    <div>
                        <p class="technical-eyebrow">Available documents</p>
                        <h2>Browse the library</h2>
                    </div>

                    {{-- Kategori Filtreleri (Link olarak çalışır ve mevcut arama terimini korur) --}}
                    <div class="document-filters">
                        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}"
                           class="{{ !request('category') ? 'is-active' : '' }}"
                           style="text-decoration: none;">All</a>

                        <a href="{{ request()->fullUrlWithQuery(['category' => 'certificate']) }}"
                           class="{{ request('category') == 'certificate' ? 'is-active' : '' }}"
                           style="text-decoration: none;">Certificates</a>

                        <a href="{{ request()->fullUrlWithQuery(['category' => 'technical']) }}"
                           class="{{ request('category') == 'technical' ? 'is-active' : '' }}"
                           style="text-decoration: none;">Technical</a>
                    </div>

                    {{-- Arama Formu --}}
                    <form action="{{ url()->current() }}" method="GET" class="technical-search-form">
                        {{-- Eğer bir kategori seçiliyse, arama yaparken kategoriyi kaybetmemek için gizli input --}}
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <label class="technical-search">
                            <span class="sr-only">Search documents</span>
                            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search documents" onchange="this.form.submit()">
                        </label>
                    </form>
                </div>

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
                                    Open document <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </div>
                        </a>
                    @empty
                        {{-- Hiç sonuç bulunamazsa bu alan render edilir --}}
                        <p class="document-empty">No documents match your search.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="technical-help">
            <div class="container technical-help-inner">
                <div>
                    <p class="technical-eyebrow">Project support</p>
                    <h2>Need a specific report?</h2>
                    <p>Ask our team for the documentation required for your market, product configuration, or project.</p>
                </div>
                <a href="#">Request a document <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
        </section>
    </main>
@endsection
