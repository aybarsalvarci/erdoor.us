@extends('admin.layouts.master')

@section('title', 'Anasayfa İçeriğini Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Anasayfa İçeriğini Düzenle</h4>
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

                    <form action="{{ route('admin.pages.home.update') }}" method="POST" enctype="multipart/form-data">
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
                                    <i data-lucide="layout" class="icon-sm me-1"></i> Genel İçerikler
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
                                 1. BÖLÜM: GENEL İÇERİKLER (SEO, Intro, CTA)
                                 ========================================== -->
                            <div class="tab-pane fade show active" id="section-general" role="tabpanel">

                                <!-- Dil Seçimi (Genel İçerikler İçin) -->
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
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="general-lang-{{ $code }}" role="tabpanel">

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

                                            <h5 class="mb-3 mt-4 pb-2 border-bottom text-primary">Giriş Bölümü (Intro)</h5>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Ana Başlık</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][title]" value="{{ old('translations.'.$code.'.content.intro_section.title', $content['intro_section']['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Paragraf 1</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][intro_section][paragraph_1]">{{ old('translations.'.$code.'.content.intro_section.paragraph_1', $content['intro_section']['paragraph_1'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Paragraf 2</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][intro_section][paragraph_2]">{{ old('translations.'.$code.'.content.intro_section.paragraph_2', $content['intro_section']['paragraph_2'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Motto / Söz (Quote)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][quote]" value="{{ old('translations.'.$code.'.content.intro_section.quote', $content['intro_section']['quote'] ?? '') }}">
                                                </div>
                                            </div>

                                            <h5 class="mb-3 mt-4 pb-2 border-bottom text-primary">Harekete Geçirici Mesaj (CTA)</h5>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Başlık</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][cta_section][title]" value="{{ old('translations.'.$code.'.content.cta_section.title', $content['cta_section']['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Buton Metni</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][cta_section][button_text]" value="{{ old('translations.'.$code.'.content.cta_section.button_text', $content['cta_section']['button_text'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Buton Linki</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][cta_section][button_link]" value="{{ old('translations.'.$code.'.content.cta_section.button_link', $content['cta_section']['button_link'] ?? '') }}">
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

                                <!-- Dil Seçimi (Avantajlar İçin) -->
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
                                            $benefits = $content['benefits_section'] ?? [];
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="benefits-lang-{{ $code }}" role="tabpanel">

                                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                                <h5 class="mb-0 text-primary">Avantaj Listesi ({{ strtoupper($code) }})</h5>
                                                <button type="button" class="btn btn-sm btn-success btn-add-benefit" data-lang="{{ $code }}">
                                                    + Yeni Özellik Ekle
                                                </button>
                                            </div>

                                            <div class="benefits-container" id="benefits-container-{{ $code }}">
                                                @foreach($benefits as $index => $benefit)
                                                    <div class="row align-items-start mb-4 benefit-row p-3 border rounded shadow-sm bg-body">
                                                        <div class="col-md-4 mb-2 mb-md-0">
                                                            <label class="form-label">Başlık (Text)</label>
                                                            <input type="text" class="form-control" name="translations[{{ $code }}][content][benefits_section][{{ $index }}][title]" value="{{ $benefit['title'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-4 mb-2 mb-md-0">
                                                            <x-media-picker name="translations[{{ $code }}][content][benefits_section][{{ $index }}][icon]" label="Görsel / İkon Seç" :multiple="false" returnType="url" :value="$benefit['icon'] ?? ''" />
                                                        </div>
                                                        <div class="col-md-3 mb-2 mb-md-0">
                                                            <label class="form-label">Öne Çıkarılsın mı?</label>
                                                            <select class="form-select" name="translations[{{ $code }}][content][benefits_section][{{ $index }}][is_featured]">
                                                                <option value="0" {{ (isset($benefit['is_featured']) && $benefit['is_featured'] == '0') ? 'selected' : '' }}>Hayır (Normal)</option>
                                                                <option value="1" {{ (isset($benefit['is_featured']) && $benefit['is_featured'] == '1') ? 'selected' : '' }}>Evet (Öne Çıkan)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1 text-end">
                                                            <label class="form-label d-none d-md-block">&nbsp;</label>
                                                            <button type="button" class="btn btn-danger btn-icon btn-remove-benefit w-100" title="Sil">
                                                                <i data-lucide="trash" class="icon-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- GİZLİ ŞABLON -->
                                            <template id="benefit-template-{{ $code }}">
                                                <div class="row align-items-start mb-4 benefit-row p-3 border rounded shadow-sm bg-body">
                                                    <div class="col-md-4 mb-2 mb-md-0">
                                                        <label class="form-label">Başlık (Text)</label>
                                                        <input type="text" class="form-control" name="translations[{{ $code }}][content][benefits_section][__INDEX__][title]" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-2 mb-md-0">
                                                        <x-media-picker name="translations[{{ $code }}][content][benefits_section][__INDEX__][icon]" label="Görsel / İkon Seç" :multiple="false" returnType="url" :value="null" />
                                                    </div>
                                                    <div class="col-md-3 mb-2 mb-md-0">
                                                        <label class="form-label">Öne Çıkarılsın mı?</label>
                                                        <select class="form-select" name="translations[{{ $code }}][content][benefits_section][__INDEX__][is_featured]" disabled>
                                                            <option value="0">Hayır (Normal)</option>
                                                            <option value="1">Evet (Öne Çıkan)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 text-end">
                                                        <label class="form-label d-none d-md-block">&nbsp;</label>
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

                                <!-- Dil Seçimi (Karşılaştırma İçin) -->
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

                                            <h5 class="mb-3 pb-2 border-bottom text-primary">Karşılaştırma Ayarları ({{ strtoupper($code) }})</h5>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Başlık</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][title]" value="{{ old('translations.'.$code.'.content.comparison_section.title', $comparison['title'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sol Etiket (Marka Adınız)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][label_1]" value="{{ old('translations.'.$code.'.content.comparison_section.label_1', $comparison['label_1'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sağ Etiket (Rakip/Geleneksel)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][label_2]" value="{{ old('translations.'.$code.'.content.comparison_section.label_2', $comparison['label_2'] ?? '') }}">
                                                </div>

                                                <!-- YENİ EKLENEN: SOL VE SAĞ GÖRSEL SEÇİCİLER -->
                                                <div class="col-md-6 mb-3">
                                                    <x-media-picker
                                                        name="translations[{{ $code }}][content][comparison_section][image_1]"
                                                        label="Sol Görsel (Marka)"
                                                        :multiple="false"
                                                        returnType="url"
                                                        :value="$comparison['image_1'] ?? ''"
                                                    />
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <x-media-picker
                                                        name="translations[{{ $code }}][content][comparison_section][image_2]"
                                                        label="Sağ Görsel (Rakip/Geleneksel)"
                                                        :multiple="false"
                                                        returnType="url"
                                                        :value="$comparison['image_2'] ?? ''"
                                                    />
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <label class="form-label mb-0 fw-bold">Özellik Listesi</label>
                                                        <button type="button" class="btn btn-sm btn-success btn-add-feature" data-lang="{{ $code }}">+ Yeni Özellik Ekle</button>
                                                    </div>
                                                    <div class="comparison-features-container" id="comparison-features-{{ $code }}">
                                                        @php
                                                            $features = $comparison['features'] ?? [];
                                                        @endphp
                                                        @foreach($features as $index => $feature)
                                                            <div class="input-group mb-2 comparison-feature-row">
                                                                <span class="input-group-text"><i data-lucide="check" class="icon-sm text-success"></i></span>
                                                                <input type="text" class="form-control" name="translations[{{ $code }}][content][comparison_section][features][{{ $index }}]" value="{{ $feature }}">
                                                                <button type="button" class="btn btn-danger btn-remove-feature" title="Sil">Sil</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
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

            // --- 1. AVANTAJLAR İÇİN JS ---
            document.querySelectorAll('.btn-add-benefit').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('benefits-container-' + langCode);
                    let newIndex = new Date().getTime();

                    let templateTag = document.getElementById('benefit-template-' + langCode);
                    let rawHTML = templateTag.innerHTML;

                    rawHTML = rawHTML.replace(/__INDEX__/g, newIndex);

                    let idMatch = rawHTML.match(/media-picker-wrapper-([a-zA-Z0-9]+)/);
                    if (idMatch) {
                        let originalId = idMatch[0];
                        let newId = originalId + '-' + newIndex;
                        rawHTML = rawHTML.split(originalId).join(newId);
                    }

                    let tempDiv = document.createElement('div');
                    tempDiv.innerHTML = rawHTML;
                    let newElement = tempDiv.firstElementChild;

                    newElement.querySelectorAll('input, select, textarea').forEach(el => el.removeAttribute('disabled'));

                    container.appendChild(newElement);

                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            // --- 2. KARŞILAŞTIRMA İÇİN JS ---
            document.querySelectorAll('.btn-add-feature').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('comparison-features-' + langCode);
                    let newIndex = new Date().getTime();

                    let newRow = `
                        <div class="input-group mb-2 comparison-feature-row">
                            <span class="input-group-text"><i data-lucide="check" class="icon-sm text-success"></i></span>
                            <input type="text" class="form-control" name="translations[${langCode}][content][comparison_section][features][${newIndex}]">
                            <button type="button" class="btn btn-danger btn-remove-feature" title="Sil">Sil</button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', newRow);
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            // --- ORTAK SİLME İŞLEMİ ---
            document.addEventListener('click', function(e) {
                let removeBenefitBtn = e.target.closest('.btn-remove-benefit');
                if (removeBenefitBtn) {
                    if (confirm('Bu avantajı silmek istediğinize emin misiniz?')) {
                        removeBenefitBtn.closest('.benefit-row').remove();
                    }
                }

                let removeFeatureBtn = e.target.closest('.btn-remove-feature');
                if (removeFeatureBtn) {
                    removeFeatureBtn.closest('.comparison-feature-row').remove();
                }
            });

        });
    </script>
@endpush
