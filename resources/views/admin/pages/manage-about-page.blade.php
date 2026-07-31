@extends('admin.layouts.master')

@section('title', 'About Us Sayfası İçeriğini Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">About Us Sayfası İçeriğini Düzenle</h4>
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

                    <form action="{{ route('admin.pages.about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div style="display: none;" aria-hidden="true">
                            <x-media-picker name="dummy_init_do_not_delete" :hideTrigger="true" returnType="url" />
                        </div>

                        @php
                            $locales = [
                                'en' => 'İngilizce (EN)',
                                'es' => 'İspanyolca (ES)'
                            ];
                        @endphp

                        <ul class="nav nav-tabs nav-tabs-line" id="sectionTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#section-general" role="tab">
                                    <i data-lucide="layout" class="icon-sm me-1"></i> SEO & Hero
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-intro" role="tab">
                                    <i data-lucide="building" class="icon-sm me-1"></i> Giriş & Fabrikalar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-global" role="tab">
                                    <i data-lucide="globe" class="icon-sm me-1"></i> Küresel Erişim (Global)
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content border border-top-0 p-4 mb-4 rounded-bottom shadow-sm">

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

                                            <h5 class="mb-3 mt-4 pb-2 border-bottom text-primary">Kapak Bölümü (Hero Section)</h5>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][eyebrow]" value="{{ old('translations.'.$code.'.content.hero_section.eyebrow', $hero['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][hero_section][title]" value="{{ old('translations.'.$code.'.content.hero_section.title', $hero['title'] ?? '') }}">
                                                    <small class="text-muted">Satır atlamak için <code>&lt;br&gt;</code> kullanabilirsiniz.</small>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Kapak Açıklaması (Description)</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][content][hero_section][description]">{{ old('translations.'.$code.'.content.hero_section.description', $hero['description'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="section-intro" role="tabpanel">
                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#intro-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $intro = $content['intro_section'] ?? [];
                                            $factories = $intro['factories'] ?? [];
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="intro-lang-{{ $code }}" role="tabpanel">

                                            <h5 class="mb-3 pb-2 border-bottom text-primary">Giriş Yazıları ({{ strtoupper($code) }})</h5>
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][label]" value="{{ old('translations.'.$code.'.content.intro_section.label', $intro['label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][title]" value="{{ old('translations.'.$code.'.content.intro_section.title', $intro['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Paragraf 1</label>
                                                    <textarea class="form-control" rows="5" name="translations[{{ $code }}][content][intro_section][paragraph_1]">{{ old('translations.'.$code.'.content.intro_section.paragraph_1', $intro['paragraph_1'] ?? '') }}</textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Paragraf 2</label>
                                                    <textarea class="form-control" rows="5" name="translations[{{ $code }}][content][intro_section][paragraph_2]">{{ old('translations.'.$code.'.content.intro_section.paragraph_2', $intro['paragraph_2'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                                <h5 class="mb-0 text-primary">Fabrika Konumları</h5>
                                                <button type="button" class="btn btn-sm btn-success btn-add-factory" data-lang="{{ $code }}">
                                                    + Fabrika Ekle
                                                </button>
                                            </div>

                                            <div class="factories-container" id="factories-container-{{ $code }}">
                                                @foreach($factories as $index => $factory)
                                                    <div class="row align-items-start mb-4 factory-row p-3 border rounded shadow-sm bg-body">
                                                        <div class="col-md-4 mb-2 mb-md-0">
                                                            <x-media-picker name="translations[{{ $code }}][content][intro_section][factories][{{ $index }}][image]" label="Fabrika Görseli" :multiple="false" returnType="url" :value="$factory['image'] ?? ''" />
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="mb-3">
                                                                <label class="form-label">Ülke (Country)</label>
                                                                <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][factories][{{ $index }}][country]" value="{{ $factory['country'] ?? '' }}">
                                                            </div>
                                                            <div>
                                                                <label class="form-label">Tesis Tipi (Type)</label>
                                                                <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][factories][{{ $index }}][type]" value="{{ $factory['type'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                            <button type="button" class="btn btn-danger btn-icon btn-remove-factory w-100" title="Sil">
                                                                <i data-lucide="trash" class="icon-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <template id="factory-template-{{ $code }}">
                                                <div class="row align-items-start mb-4 factory-row p-3 border rounded shadow-sm bg-body">
                                                    <div class="col-md-4 mb-2 mb-md-0">
                                                        <x-media-picker name="translations[{{ $code }}][content][intro_section][factories][__INDEX__][image]" label="Fabrika Görseli" :multiple="false" returnType="url" :value="null" />
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="mb-3">
                                                            <label class="form-label">Ülke (Country)</label>
                                                            <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][factories][__INDEX__][country]" disabled>
                                                        </div>
                                                        <div>
                                                            <label class="form-label">Tesis Tipi (Type)</label>
                                                            <input type="text" class="form-control" name="translations[{{ $code }}][content][intro_section][factories][__INDEX__][type]" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                        <button type="button" class="btn btn-danger btn-icon btn-remove-factory w-100" title="Sil">
                                                            <i data-lucide="trash" class="icon-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="section-global" role="tabpanel">
                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#global-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $global = $content['global_section'] ?? [];
                                            $logos = $global['logos'] ?? [];
                                            $paragraphs = $global['paragraphs'] ?? [];
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="global-lang-{{ $code }}" role="tabpanel">

                                            <h5 class="mb-3 pb-2 border-bottom text-primary">Global Alan Ayarları ({{ strtoupper($code) }})</h5>
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Üst Etiket (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][global_section][label]" value="{{ old('translations.'.$code.'.content.global_section.label', $global['label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][global_section][title]" value="{{ old('translations.'.$code.'.content.global_section.title', $global['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton Metni (Button Text)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][global_section][button_text]" value="{{ old('translations.'.$code.'.content.global_section.button_text', $global['button_text'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Buton Linki (Button Link)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][global_section][button_link]" value="{{ old('translations.'.$code.'.content.global_section.button_link', $global['button_link'] ?? '') }}">
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <label class="form-label mb-0 fw-bold">Grup Logoları</label>
                                                        <button type="button" class="btn btn-sm btn-success btn-add-logo" data-lang="{{ $code }}">+ Logo Ekle</button>
                                                    </div>
                                                    <div class="row logos-container" id="logos-container-{{ $code }}">
                                                        @foreach($logos as $index => $logo)
                                                            <div class="col-md-6 mb-3 logo-row">
                                                                <div class="d-flex gap-2">
                                                                    <div class="flex-grow-1">
                                                                        <x-media-picker name="translations[{{ $code }}][content][global_section][logos][{{ $index }}]" label="Logo Seç" :multiple="false" returnType="url" :value="$logo" />
                                                                    </div>
                                                                    <button type="button" class="btn btn-danger btn-remove-logo" title="Sil"><i data-lucide="trash" class="icon-sm"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <label class="form-label mb-0 fw-bold">İçerik Paragrafları</label>
                                                        <button type="button" class="btn btn-sm btn-success btn-add-paragraph" data-lang="{{ $code }}">+ Paragraf Ekle</button>
                                                    </div>
                                                    <div class="paragraphs-container" id="paragraphs-container-{{ $code }}">
                                                        @foreach($paragraphs as $index => $paragraph)
                                                            <div class="d-flex gap-2 mb-3 paragraph-row">
                                                                <div class="flex-grow-1">
                                                                    <textarea class="form-control" rows="3" name="translations[{{ $code }}][content][global_section][paragraphs][{{ $index }}]">{{ $paragraph }}</textarea>
                                                                </div>
                                                                <button type="button" class="btn btn-danger btn-remove-paragraph" title="Sil"><i data-lucide="trash" class="icon-sm"></i></button>
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

            function replaceMediaPickerIds(rawHTML, newIndex) {
                let idMatch = rawHTML.match(/media-picker-wrapper-([a-zA-Z0-9]+)/);
                if (idMatch) {
                    let originalId = idMatch[0];
                    let newId = originalId + '-' + newIndex;
                    return rawHTML.split(originalId).join(newId);
                }
                return rawHTML;
            }

            document.querySelectorAll('.btn-add-factory').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('factories-container-' + langCode);
                    let newIndex = new Date().getTime();

                    let templateTag = document.getElementById('factory-template-' + langCode);
                    let rawHTML = templateTag.innerHTML;

                    rawHTML = rawHTML.replace(/__INDEX__/g, newIndex);
                    rawHTML = replaceMediaPickerIds(rawHTML, newIndex);

                    let tempDiv = document.createElement('div');
                    tempDiv.innerHTML = rawHTML;
                    let newElement = tempDiv.firstElementChild;
                    newElement.querySelectorAll('input, select, textarea').forEach(el => el.removeAttribute('disabled'));

                    container.appendChild(newElement);
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            document.querySelectorAll('.btn-add-logo').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('logos-container-' + langCode);
                    let newIndex = new Date().getTime();

                    let dummyTag = document.querySelector('[name="dummy_init_do_not_delete"]').closest('.media-picker-wrapper').outerHTML;
                    dummyTag = dummyTag.replace(/dummy_init_do_not_delete/g, `translations[${langCode}][content][global_section][logos][${newIndex}]`);
                    dummyTag = replaceMediaPickerIds(dummyTag, newIndex);

                    let finalHTML = `
                        <div class="col-md-6 mb-3 logo-row">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="flex-grow-1">
                                    ${dummyTag}
                                </div>
                                <button type="button" class="btn btn-danger btn-remove-logo" title="Sil"><i data-lucide="trash" class="icon-sm"></i></button>
                            </div>
                        </div>
                    `;

                    container.insertAdjacentHTML('beforeend', finalHTML);
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            document.querySelectorAll('.btn-add-paragraph').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('paragraphs-container-' + langCode);
                    let newIndex = new Date().getTime();

                    let newRow = `
                        <div class="d-flex gap-2 mb-3 paragraph-row">
                            <div class="flex-grow-1">
                                <textarea class="form-control" rows="3" name="translations[${langCode}][content][global_section][paragraphs][${newIndex}]" placeholder="Paragraf metni..."></textarea>
                            </div>
                            <button type="button" class="btn btn-danger btn-remove-paragraph" title="Sil"><i data-lucide="trash" class="icon-sm"></i></button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', newRow);
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            document.addEventListener('click', function(e) {
                let removeFactoryBtn = e.target.closest('.btn-remove-factory');
                if (removeFactoryBtn) {
                    if (confirm('Bu fabrikayı silmek istediğinize emin misiniz?')) {
                        removeFactoryBtn.closest('.factory-row').remove();
                    }
                }

                let removeLogoBtn = e.target.closest('.btn-remove-logo');
                if (removeLogoBtn) {
                    removeLogoBtn.closest('.logo-row').remove();
                }

                let removeParagraphBtn = e.target.closest('.btn-remove-paragraph');
                if (removeParagraphBtn) {
                    removeParagraphBtn.closest('.paragraph-row').remove();
                }
            });

        });
    </script>
@endpush
