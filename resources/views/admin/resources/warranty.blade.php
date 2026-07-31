@extends('admin.layouts.master')

@section('title', 'Warranty & Return Policy Sayfasını Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Warranty & Return Policy Sayfasını Düzenle</h4>
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

                    {{-- Form action kısmını kendi rotanıza göre güncelleyebilirsiniz. (Örn: warranty.update) --}}
                    <form action="{{ route('admin.resources.warranty.update') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="icon" value="{{ old('icon', $page->icon ?? 'fas fa-shield-alt') }}" placeholder="Örn: fas fa-shield-alt">
                                    <small class="text-muted">Örn: fas fa-shield-alt, fas fa-file-pdf vb.</small>
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
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-pdf" role="tab">
                                    <i data-lucide="file-text" class="icon-sm me-1"></i> PDF & İçerik Ayarları
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

                            <!-- TAB 2: PDF VE İÇERİK AYARLARI BÖLÜMÜ -->
                            <div class="tab-pane fade" id="section-pdf" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#pdf-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pdf-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">

                                                <div class="col-md-12 mb-4 p-3 border rounded bg-light">
                                                    <label class="form-label fw-bold text-primary">PDF Dosyası (Flipbook İçin)</label>

                                                    <!-- Eğer daha önceden yüklenmiş bir PDF varsa gösterelim -->
                                                    @if(!empty($content['pdf_url']))
                                                        <div class="mb-3">
                                                            <a href="{{ asset($content['pdf_url']) }}" target="_blank" class="btn btn-sm btn-outline-info d-inline-flex align-items-center">
                                                                <i data-lucide="external-link" class="icon-sm me-2"></i> Mevcut PDF'i Görüntüle
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <div class="input-group">
                                                        <span class="input-group-text"><i data-lucide="upload-cloud" class="icon-sm"></i></span>
                                                        <!-- Kullanıcıdan dosyayı alacağımız input (sadece pdf) -->
                                                        <input type="file" class="form-control" name="translations[{{ $code }}][pdf_file]" accept="application/pdf">
                                                    </div>
                                                    <small class="text-muted mt-1 d-block">Bilgisayarınızdan yeni bir PDF seçerseniz mevcut dosya değiştirilir. Sadece .pdf formatı desteklenir.</small>

                                                    <!-- Yeni dosya seçilmezse eski URL'in kaybolmaması için gizli alanda tutuyoruz -->
                                                    <input type="hidden" name="translations[{{ $code }}][page_content][pdf_url]" value="{{ $content['pdf_url'] ?? '' }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Bilgi Başlığı (Header Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][header_title]" value="{{ old('translations.'.$code.'.page_content.header_title', $content['header_title'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Geri Dönüş Linki Metni (Back Link)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][back_link]" value="{{ old('translations.'.$code.'.page_content.back_link', $content['back_link'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Yükleniyor Yazısı (Loading Text)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][loading_text]" value="{{ old('translations.'.$code.'.page_content.loading_text', $content['loading_text'] ?? '') }}">
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
    <!-- Özel Javascript Koduna İhtiyaç Yok (Adım ekleme vb. yok) -->
@endpush
