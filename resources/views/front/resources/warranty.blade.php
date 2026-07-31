<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />

    <!-- Dinamik SEO Açıklaması -->
    <meta
        name="description"
        content="{{ $page->description ?? 'Read the Erdoor Warranty and Return Policy in an interactive digital flipbook.' }}"
    />

    <!-- Dinamik Başlık -->
    <title>{{ $page->title ?? 'Warranty & Return Policy' }} | ERDOOR</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@300;400;600&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/catalog.css') }}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
    </script>
    <script src="https://unpkg.com/page-flip/dist/js/page-flip.browser.js"></script>
</head>
<body>

@php
    // JSON içeriklerini güvenli bir şekilde alıyoruz
    $content = $page->page_content ?? [];

    // PDF Yolu (Admin'den yüklendiyse onu, yoksa varsayılanı kullanır)
    $pdfUrl = !empty($content['pdf_url'])
                ? asset($content['pdf_url'])
                : asset('front/assets/warranty/warranty-and-return-policy.pdf');
@endphp

<main
    class="fullscreen-viewer"
    data-pdf-viewer
    data-pdf-src="{{ $pdfUrl }}"
    data-render-scale="2"
>
    <div class="top-bar-controls">
        <!-- Dinamik Geri Dönüş Linki -->
        <a href="{{ route('resources') }}" class="btn-exit">
            <i class="fas fa-arrow-left"></i>
            <span class="hide-mobile">{{ $content['back_link'] ?? 'Back to Resources' }}</span>
        </a>

        <!-- Dinamik Üst Başlık -->
        <div class="title-area">{{ mb_strtoupper($content['header_title'] ?? 'WARRANTY & RETURN POLICY') }}</div>

        <!-- Dinamik PDF İndirme Butonu -->
        <a
            href="{{ $pdfUrl }}"
            download
            class="btn-download-icon"
            aria-label="Download Warranty and Return Policy"
        >
            <i class="fas fa-download"></i>
        </a>
    </div>

    <!-- Dinamik Yükleniyor Yazısı -->
    <div id="loadingState">
        <div class="spinner"></div>
        <p>{{ $content['loading_text'] ?? 'Loading Policy...' }}</p>
    </div>

    <div class="book-stage">
        <div class="book-zoom-shell" id="bookZoomShell">
            <div id="book"></div>
        </div>
    </div>

    <button id="btnPrev" class="nav-arrow left" aria-label="Previous page">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button id="btnNext" class="nav-arrow right" aria-label="Next page">
        <i class="fas fa-chevron-right"></i>
    </button>

    <div class="bottom-bar-controls">
        <div class="page-counter" id="pageCounter">Loading...</div>

        <div class="zoom-tools">
            <button id="btnZoomOut" aria-label="Zoom out"><i class="fas fa-minus"></i></button>
            <button id="btnZoomIn" aria-label="Zoom in"><i class="fas fa-plus"></i></button>
        </div>
    </div>
</main>

<script src="{{ asset('front/js/pdf-flipbook.js') }}"></script>
</body>
</html>
