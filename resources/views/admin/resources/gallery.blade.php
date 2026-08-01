@extends('admin.layouts.master')

@section('title', 'Galeri Sayfasını Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Galeri Sayfasını Düzenle</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Kaynak Sayfası İçerik Yönetimi</h6>

                    {{-- Form action kısmını kendi rotanıza göre güncelleyebilirsiniz. --}}
                    <form action="{{ route('admin.resources.galleryPage.update', $page->id ?? 5) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Sadece Global Media Picker için (Silmeyin) -->
                        <div style="display: none;" aria-hidden="true">
                            <x-media-picker name="dummy_init_do_not_delete" :hideTrigger="true" returnType="url" />
                        </div>

                        @php
                            $locales = [
                                'en' => 'İngilizce (EN)',
                                'es' => 'İspanyolca (ES)'
                            ];
                        @endphp

                            <!-- DİLLERDEN BAĞIMSIZ GLOBAL AYARLAR (İkon ve Kapak Görseli) -->
                        <div class="p-4 mb-4 border rounded bg-body">
                            <h5 class="mb-3 pb-2 border-bottom text-primary"><i data-lucide="settings" class="icon-md me-2"></i>Global Ayarlar</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sayfa İkonu (FontAwesome Sınıfı)</label>
                                    <input type="text" class="form-control" name="icon" value="{{ old('icon', $page->icon ?? 'fas fa-images') }}" placeholder="Örn: fas fa-images">
                                    <small class="text-muted">Örn: fas fa-images, fas fa-camera vb.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-media-picker name="image_id" label="Kart Görseli (Thumbnail)" :multiple="false" returnType="id" :value="$page->image_id ?? null" />
                                </div>
                            </div>
                        </div>

                        <!-- SEKMELER (TABS) -->
                        <ul class="nav nav-tabs nav-tabs-line" id="sectionTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#section-general" role="tab">
                                    <i data-lucide="layout" class="icon-sm me-1"></i> SEO & Temel
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-hero" role="tab">
                                    <i data-lucide="monitor" class="icon-sm me-1"></i> Kapak (Hero)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-gallery" role="tab">
                                    <i data-lucide="image" class="icon-sm me-1"></i> Galeri İçeriği
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content border border-top-0 p-4 mb-4 rounded-bottom">

                            <!-- TAB 1: SEO VE TEMEL ALANLAR -->
                            <div class="tab-pane fade show active" id="section-general" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#general-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="general-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sayfa Başlığı (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][title]" value="{{ old('translations.'.$code.'.title', $translation->title ?? '') }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">URL (Slug)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][slug]" value="{{ old('translations.'.$code.'.slug', $translation->slug ?? '') }}" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Buton / Link Metni (Link Text)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][link_text]" value="{{ old('translations.'.$code.'.link_text', $translation->link_text ?? '') }}" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Sayfa Açıklaması (Description)</label>
                                                    <textarea class="form-control" rows="3" name="translations[{{ $code }}][description]" required>{{ old('translations.'.$code.'.description', $translation->description ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TAB 2: HERO (KAPAK) BÖLÜMÜ -->
                            <div class="tab-pane fade" id="section-hero" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#hero-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                            $hero = $content['hero'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="hero-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Geri Dönüş Linki Metni (Back Link)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][hero][back_link]" value="{{ old('translations.'.$code.'.page_content.hero.back_link', $hero['back_link'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][hero][eyebrow]" value="{{ old('translations.'.$code.'.page_content.hero.eyebrow', $hero['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][hero][title]" value="{{ old('translations.'.$code.'.page_content.hero.title', $hero['title'] ?? '') }}">
                                                    <small class="text-muted">Alt satıra geçmek için <code>&lt;br&gt;</code> etiketini kullanabilirsiniz.</small>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Kapak Açıklaması (Description)</label>
                                                    <textarea class="form-control" rows="3" name="translations[{{ $code }}][page_content][hero][description]">{{ old('translations.'.$code.'.page_content.hero.description', $hero['description'] ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TAB 3: GALERİ BÖLÜMÜ (METİNLER) -->
                            <div class="tab-pane fade" id="section-gallery" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#gallery-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                            $gallery = $content['gallery'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="gallery-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][gallery][eyebrow]" value="{{ old('translations.'.$code.'.page_content.gallery.eyebrow', $gallery['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Galeri Başlığı (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][gallery][title]" value="{{ old('translations.'.$code.'.page_content.gallery.title', $gallery['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Galeri Açıklaması (Description)</label>
                                                    <textarea class="form-control" rows="2" name="translations[{{ $code }}][page_content][gallery][description]">{{ old('translations.'.$code.'.page_content.gallery.description', $gallery['description'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">"Daha Fazla Yükle" Buton Metni (Load More)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][gallery][load_more]" value="{{ old('translations.'.$code.'.page_content.gallery.load_more', $gallery['load_more'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm px-4">
                                <i data-lucide="save" class="icon-sm me-2"></i> Değişiklikleri Kaydet
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary d-flex align-items-center">
                                İptal Et
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
