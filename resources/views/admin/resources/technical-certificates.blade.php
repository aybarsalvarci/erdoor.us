@extends('admin.layouts.master')

@section('title', 'Technical & Certificates Sayfasını Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Technical & Certificates Sayfasını Düzenle</h4>
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
                    <form action="{{ route('admin.resources.technical_certificates.update', $page->id ?? 4) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="icon" value="{{ old('icon', $page->icon ?? 'fas fa-file-contract') }}" placeholder="Örn: fas fa-file-contract">
                                    <small class="text-muted">Örn: fas fa-file-contract, fas fa-folder vb.</small>
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
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-library" role="tab">
                                    <i data-lucide="folder" class="icon-sm me-1"></i> Kütüphane & Filtreler
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-help" role="tab">
                                    <i data-lucide="help-circle" class="icon-sm me-1"></i> Yardım & Destek
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

                            <!-- TAB 3: KÜTÜPHANE VE FİLTRELER -->
                            <div class="tab-pane fade" id="section-library" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#library-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                            $library = $content['library'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="library-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][eyebrow]" value="{{ old('translations.'.$code.'.page_content.library.eyebrow', $library['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][title]" value="{{ old('translations.'.$code.'.page_content.library.title', $library['title'] ?? '') }}">
                                                </div>

                                                <h6 class="mt-3 mb-2 text-primary border-bottom pb-2">Filtreleme ve Arama Metinleri</h6>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Filtre: Tümü (All)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][filter_all]" value="{{ old('translations.'.$code.'.page_content.library.filter_all', $library['filter_all'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Filtre: Sertifikalar (Certificates)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][filter_cert]" value="{{ old('translations.'.$code.'.page_content.library.filter_cert', $library['filter_cert'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Filtre: Teknik (Technical)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][filter_tech]" value="{{ old('translations.'.$code.'.page_content.library.filter_tech', $library['filter_tech'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Arama Kutusu Yer Tutucu (Search Placeholder)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][search_placeholder]" value="{{ old('translations.'.$code.'.page_content.library.search_placeholder', $library['search_placeholder'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Görüntüleme Linki (View Link)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][view_link]" value="{{ old('translations.'.$code.'.page_content.library.view_link', $library['view_link'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Boş Sonuç Metni (Empty Text)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][library][empty_text]" value="{{ old('translations.'.$code.'.page_content.library.empty_text', $library['empty_text'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TAB 4: YARDIM VE DESTEK BÖLÜMÜ -->
                            <div class="tab-pane fade" id="section-help" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#help-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                            $help = $content['help'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="help-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][help][eyebrow]" value="{{ old('translations.'.$code.'.page_content.help.eyebrow', $help['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][help][title]" value="{{ old('translations.'.$code.'.page_content.help.title', $help['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Açıklama (Description)</label>
                                                    <textarea class="form-control" rows="2" name="translations[{{ $code }}][page_content][help][description]">{{ old('translations.'.$code.'.page_content.help.description', $help['description'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton Metni (Button Text)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][help][button_text]" value="{{ old('translations.'.$code.'.page_content.help.button_text', $help['button_text'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton Yönlendirme URL'si (Button Link)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][help][button_link]" value="{{ old('translations.'.$code.'.page_content.help.button_link', $help['button_link'] ?? '#') }}" placeholder="Örn: /contact-us">
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
