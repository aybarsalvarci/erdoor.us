@extends('admin.layouts.master')

@section('title', 'Why WPC Sayfası İçeriğini Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Why WPC Sayfası İçeriğini Düzenle</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Panele Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Sayfa İçerik Yönetimi</h6>

                    <form action="{{ route('admin.pages.why_wpc.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- KRİTİK ÇÖZÜM: Alpine.js'in eklentiyi (script'i) tanıması için gizli tetikleyici -->
                        <div style="display: none;" aria-hidden="true">
                            <x-media-picker name="dummy_init_do_not_delete" :hideTrigger="true" returnType="url" />
                        </div>

                        @php
                            $locales = [
                                'en' => 'İngilizce (EN)',
                                'es' => 'İspanyolca (ES)'
                            ];
                        @endphp

                            <!-- ANA SEKMELER: BÖLÜMLER (SECTIONS) -->
                        <ul class="nav nav-tabs nav-tabs-line" id="sectionTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#section-general" role="tab">
                                    <i data-lucide="layout" class="icon-sm me-1"></i> SEO, Hero & Intro
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-benefits" role="tab">
                                    <i data-lucide="star" class="icon-sm me-1"></i> Avantajlar (Benefits)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-comparison" role="tab">
                                    <i data-lucide="git-compare" class="icon-sm me-1"></i> Karşılaştırma Alanı
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content border border-top-0 p-4 mb-4 rounded-bottom shadow-sm">

                            <!-- ==========================================
                                 1. BÖLÜM: SEO, HERO & INTRO
                                 ========================================== -->
                            <div class="tab-pane fade show active" id="section-general" role="tabpanel">

                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
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
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $hero = $content['hero_section'] ?? [];
                                            $intro = $content['intro_section'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="general-lang-{{ $code }}" role="tabpanel">

                                            <!-- SEO -->
                                            <h5 class="mb-3 pb-2 border-bottom text-primary">SEO & Sayfa Ayarları ({{ strtoupper($code) }})</h5>
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
                                                    <label class="form-label">Meta Açıklaması (Description)</label>
                                                    <textarea class="form-control" rows="2" name="translations[{{ $code }}][description]">{{ old('translations.'.$code.'.description', $translation->description ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- HERO BÖLÜMÜ -->
                                            <h5 class="mb-3 mt-4 pb-2 border-bottom text-primary">Kapak Bölümü (Hero Section)</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][eyebrow]" value="{{ old('translations.'.$code.'.content.hero_section.eyebrow', $hero['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton / Link Metni</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][link_text]" value="{{ old('translations.'.$code.'.content.hero_section.link_text', $hero['link_text'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][title]" value="{{ old('translations.'.$code.'.content.hero_section.title', $hero['title'] ?? '') }}">
                                                    <small class="text-muted">Farklı renk/tasarım için <code>&lt;span&gt;Metin&lt;/span&gt;</code> kullanabilirsiniz.</small>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Kapak Açıklaması (Description)</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][hero_section][description]">{{ old('translations.'.$code.'.content.hero_section.description', $hero['description'] ?? '') }}</textarea>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Not 1 (Koyu Yazı)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][note_1]" value="{{ old('translations.'.$code.'.content.hero_section.note_1', $hero['note_1'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Not 2 (Alt Açıklama)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][note_2]" value="{{ old('translations.'.$code.'.content.hero_section.note_2', $hero['note_2'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <x-media-picker name="translations[{{ $code }}][content][hero_section][image]" label="Hero Ürün Görseli" :multiple="false" returnType="url" :value="$hero['image'] ?? ''" />
                                                </div>
                                            </div>

                                            <!-- INTRO BÖLÜMÜ -->
                                            <h5 class="mb-3 mt-4 pb-2 border-bottom text-primary">Giriş Bölümü (Intro Section)</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][label]" value="{{ old('translations.'.$code.'.content.intro_section.label', $intro['label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][title]" value="{{ old('translations.'.$code.'.content.intro_section.title', $intro['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Paragraf 1</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][intro_section][paragraph_1]">{{ old('translations.'.$code.'.content.intro_section.paragraph_1', $intro['paragraph_1'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Paragraf 2</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][intro_section][paragraph_2]">{{ old('translations.'.$code.'.content.intro_section.paragraph_2', $intro['paragraph_2'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ==========================================
                                 2. BÖLÜM: AVANTAJLAR (BENEFITS)
                                 ========================================== -->
                            <div class="tab-pane fade" id="section-benefits" role="tabpanel">

                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#benefits-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $benefits_sec = $content['benefits_section'] ?? [];
                                            $cards = $benefits_sec['cards'] ?? [];
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="benefits-lang-{{ $code }}" role="tabpanel">

                                            <!-- Bölüm Başlıkları -->
                                            <h5 class="mb-3 pb-2 border-bottom text-primary">Avantajlar Alanı Başlıkları ({{ strtoupper($code) }})</h5>
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][benefits_section][label]" value="{{ old('translations.'.$code.'.content.benefits_section.label', $benefits_sec['label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][benefits_section][title]" value="{{ old('translations.'.$code.'.content.benefits_section.title', $benefits_sec['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Açıklama (Description)</label>
                                                    <textarea class="form-control" rows="2" name="translations[{{ $code }}][content][benefits_section][description]">{{ old('translations.'.$code.'.content.benefits_section.description', $benefits_sec['description'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Kartlar -->
                                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                                <h5 class="mb-0 text-primary">Avantaj Kartları Listesi</h5>
                                                <button type="button" class="btn btn-sm btn-success btn-add-benefit" data-lang="{{ $code }}">
                                                    + Yeni Kart Ekle
                                                </button>
                                            </div>

                                            <div class="benefits-container" id="benefits-container-{{ $code }}">
                                                @foreach($cards as $index => $card)
                                                    <div class="row align-items-start mb-4 benefit-row p-3 border rounded shadow-sm bg-body">
                                                        <div class="col-md-3 mb-2 mb-md-0">
                                                            <x-media-picker name="translations[{{ $code }}][content][benefits_section][cards][{{ $index }}][icon]" label="Görsel / İkon" :multiple="false" returnType="url" :value="$card['icon'] ?? ''" />
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="mb-3">
                                                                <label class="form-label">Kart Başlığı (Title)</label>
                                                                <input type="text" class="form-control" name="translations[{{ $code }}][content][benefits_section][cards][{{ $index }}][title]" value="{{ $card['title'] ?? '' }}">
                                                            </div>
                                                            <div>
                                                                <label class="form-label">Kart Açıklaması (Description)</label>
                                                                <textarea class="form-control" rows="3" name="translations[{{ $code }}][content][benefits_section][cards][{{ $index }}][description]">{{ $card['description'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                            <button type="button" class="btn btn-danger btn-icon btn-remove-benefit w-100" title="Sil">
                                                                <i data-lucide="trash" class="icon-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- GİZLİ ŞABLON (YENİ EKLENECEKLER İÇİN) -->
                                            <template id="benefit-template-{{ $code }}">
                                                <div class="row align-items-start mb-4 benefit-row p-3 border rounded shadow-sm bg-body">
                                                    <div class="col-md-3 mb-2 mb-md-0">
                                                        <x-media-picker name="translations[{{ $code }}][content][benefits_section][cards][__INDEX__][icon]" label="Görsel / İkon" :multiple="false" returnType="url" :value="null" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kart Başlığı (Title)</label>
                                                            <input type="text" class="form-control" name="translations[{{ $code }}][content][benefits_section][cards][__INDEX__][title]" disabled>
                                                        </div>
                                                        <div>
                                                            <label class="form-label">Kart Açıklaması (Description)</label>
                                                            <textarea class="form-control" rows="3" name="translations[{{ $code }}][content][benefits_section][cards][__INDEX__][description]" disabled></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                        <button type="button" class="btn btn-danger btn-icon btn-remove-benefit w-100" title="Sil">
                                                            <i data-lucide="trash" class="icon-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ==========================================
                                 3. BÖLÜM: KARŞILAŞTIRMA ALANI
                                 ========================================== -->
                            <div class="tab-pane fade" id="section-comparison" role="tabpanel">

                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#comparison-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $comparison = $content['comparison_section'] ?? [];
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="comparison-lang-{{ $code }}" role="tabpanel">

                                            <h5 class="mb-3 pb-2 border-bottom text-primary">Karşılaştırma (Comparison) Alanı ({{ strtoupper($code) }})</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][label]" value="{{ old('translations.'.$code.'.content.comparison_section.label', $comparison['label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][title]" value="{{ old('translations.'.$code.'.content.comparison_section.title', $comparison['title'] ?? '') }}">
                                                    <small class="text-muted">Satır atlamak için <code>&lt;br&gt;</code> kullanabilirsiniz.</small>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Açıklama (Description)</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][comparison_section][description]">{{ old('translations.'.$code.'.content.comparison_section.description', $comparison['description'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Vurgulu Söz / Alıntı (Quote)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][quote]" value="{{ old('translations.'.$code.'.content.comparison_section.quote', $comparison['quote'] ?? '') }}">
                                                </div>

                                                <!-- CTA Butonu İçin Alanlar -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton Metni (Button Text)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][button_text]" value="{{ old('translations.'.$code.'.content.comparison_section.button_text', $comparison['button_text'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton Linki (Button Link)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][button_link]" value="{{ old('translations.'.$code.'.content.comparison_section.button_link', $comparison['button_link'] ?? '') }}">
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <!-- KAYDET BUTONU -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- 1. AVANTAJ KARTLARI (BENEFITS) İÇİN JS ---
            document.querySelectorAll('.btn-add-benefit').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('benefits-container-' + langCode);
                    let newIndex = new Date().getTime();

                    let templateTag = document.getElementById('benefit-template-' + langCode);
                    let rawHTML = templateTag.innerHTML;

                    // Yeni indeks ataması
                    rawHTML = rawHTML.replace(/__INDEX__/g, newIndex);

                    // Media picker ID çakışmasını önleme
                    let idMatch = rawHTML.match(/media-picker-wrapper-([a-zA-Z0-9]+)/);
                    if (idMatch) {
                        let originalId = idMatch[0];
                        let newId = originalId + '-' + newIndex;
                        rawHTML = rawHTML.split(originalId).join(newId);
                    }

                    let tempDiv = document.createElement('div');
                    tempDiv.innerHTML = rawHTML;
                    let newElement = tempDiv.firstElementChild;

                    // Disabled olan input/textarea'ları aktifleştir
                    newElement.querySelectorAll('input, select, textarea').forEach(el => el.removeAttribute('disabled'));

                    container.appendChild(newElement);

                    // Lucide ikonlarını yeniden oluştur
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            // --- ORTAK SİLME İŞLEMİ ---
            document.addEventListener('click', function(e) {
                let removeBenefitBtn = e.target.closest('.btn-remove-benefit');
                if (removeBenefitBtn) {
                    if (confirm('Bu avantaj kartını silmek istediğinize emin misiniz?')) {
                        removeBenefitBtn.closest('.benefit-row').remove();
                    }
                }
            });

        });
    </script>
@endpush
