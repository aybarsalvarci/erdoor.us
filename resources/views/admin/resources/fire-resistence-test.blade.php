@extends('admin.layouts.master')

@section('title', 'Fire Resistance Test Sayfasını Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Fire Resistance Test Sayfasını Düzenle</h4>
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

                    {{-- Form action kısmını kendi rotanıza göre güncelleyebilirsiniz. (Örn: fire_resistance.update) --}}
                    <form action="{{ route('admin.resources.fire_resistance.update') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="icon" value="{{ old('icon', $page->icon ?? 'fas fa-fire') }}" placeholder="Örn: fas fa-fire">
                                    <small class="text-muted">Örn: fas fa-fire, fas fa-tools vb.</small>
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
                                    <i data-lucide="monitor" class="icon-sm me-1"></i> Hero (Kapak)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-video" role="tab">
                                    <i data-lucide="youtube" class="icon-sm me-1"></i> Video Ayarları
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-notes" role="tab">
                                    <i data-lucide="list-checks" class="icon-sm me-1"></i> Notlar & Adımlar
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

                            <!-- TAB 3: VIDEO BÖLÜMÜ (YOUTUBE IFRAME) -->
                            <div class="tab-pane fade" id="section-video" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#video-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                            $video = $content['video'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="video-lang-{{ $code }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Video Üst Etiket (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][video][label]" value="{{ old('translations.'.$code.'.page_content.video.label', $video['label'] ?? '') }}">
                                                </div>

                                                <!-- IFRAME ALANI (TEXTAREA) -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">YouTube Iframe (Embed) Kodu</label>
                                                    <textarea class="form-control" rows="4" name="translations[{{ $code }}][page_content][video][iframe]" placeholder='<iframe width="560" height="315" src="https://www.youtube.com/embed/XXXXXXX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'>{{ old('translations.'.$code.'.page_content.video.iframe', $video['iframe'] ?? '') }}</textarea>
                                                    <small class="text-muted">YouTube'da Paylaş > Yerleştir (Embed) kısmından aldığınız <code>&lt;iframe&gt;...&lt;/iframe&gt;</code> kodunun tamamını buraya yapıştırın.</small>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Hata Başlığı (Error Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][video][error_title]" value="{{ old('translations.'.$code.'.page_content.video.error_title', $video['error_title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Hata Açıklaması (Error Description)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][video][error_desc]" value="{{ old('translations.'.$code.'.page_content.video.error_desc', $video['error_desc'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TAB 4: NOTLAR VE ADIMLAR BÖLÜMÜ -->
                            <div class="tab-pane fade" id="section-notes" role="tabpanel">
                                <ul class="nav nav-pills mb-4 border p-2 rounded bg-body" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#notes-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->page_content ?? []) : [];
                                            $notes = $content['notes'] ?? [];
                                            $steps = $notes['steps'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="notes-lang-{{ $code }}" role="tabpanel">
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Notlar Üst Etiket (Eyebrow)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][notes][eyebrow]" value="{{ old('translations.'.$code.'.page_content.notes.eyebrow', $notes['eyebrow'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Notlar Ana Başlık (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][notes][title]" value="{{ old('translations.'.$code.'.page_content.notes.title', $notes['title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Uyarı / Alt Bilgi (Disclaimer)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][page_content][notes][disclaimer]" value="{{ old('translations.'.$code.'.page_content.notes.disclaimer', $notes['disclaimer'] ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                                <h5 class="mb-0 text-primary">Test Adımları (Steps)</h5>
                                                <button type="button" class="btn btn-sm btn-success btn-add-step" data-lang="{{ $code }}">
                                                    + Adım Ekle
                                                </button>
                                            </div>

                                            <div class="steps-container" id="steps-container-{{ $code }}">
                                                @foreach($steps as $index => $step)
                                                    <div class="row align-items-start mb-4 step-row p-3 border rounded bg-body">
                                                        <div class="col-md-11">
                                                            <div class="mb-3">
                                                                <label class="form-label">Adım Başlığı (Title)</label>
                                                                <input type="text" class="form-control" name="translations[{{ $code }}][page_content][notes][steps][{{ $index }}][title]" value="{{ $step['title'] ?? '' }}">
                                                            </div>
                                                            <div>
                                                                <label class="form-label">Açıklama (Description)</label>
                                                                <textarea class="form-control" rows="2" name="translations[{{ $code }}][page_content][notes][steps][{{ $index }}][description]">{{ $step['description'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                            <button type="button" class="btn btn-danger btn-icon btn-remove-step w-100" title="Sil">
                                                                <i data-lucide="trash" class="icon-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- JAVASCRIPT İÇİN ŞABLON (TEMPLATE) -->
                                            <template id="step-template-{{ $code }}">
                                                <div class="row align-items-start mb-4 step-row p-3 border rounded bg-body">
                                                    <div class="col-md-11">
                                                        <div class="mb-3">
                                                            <label class="form-label">Adım Başlığı (Title)</label>
                                                            <input type="text" class="form-control" name="translations[{{ $code }}][page_content][notes][steps][__INDEX__][title]" disabled>
                                                        </div>
                                                        <div>
                                                            <label class="form-label">Açıklama (Description)</label>
                                                            <textarea class="form-control" rows="2" name="translations[{{ $code }}][page_content][notes][steps][__INDEX__][description]" disabled></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                        <button type="button" class="btn btn-danger btn-icon btn-remove-step w-100" title="Sil">
                                                            <i data-lucide="trash" class="icon-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>

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

            // Adım Ekleme İşlemi
            document.querySelectorAll('.btn-add-step').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('steps-container-' + langCode);
                    let newIndex = new Date().getTime(); // Benzersiz ID

                    let templateTag = document.getElementById('step-template-' + langCode);
                    let rawHTML = templateTag.innerHTML;

                    // Placeholder index'i gerçek değerle değiştiriyoruz
                    rawHTML = rawHTML.replace(/__INDEX__/g, newIndex);

                    let tempDiv = document.createElement('div');
                    tempDiv.innerHTML = rawHTML;
                    let newElement = tempDiv.firstElementChild;

                    // Şablondaki disabled attributelarını kaldırıyoruz (gönderilirken sorun olmaması için)
                    newElement.querySelectorAll('input, select, textarea').forEach(el => el.removeAttribute('disabled'));

                    container.appendChild(newElement);
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            // Adım Silme İşlemi (Delegate Event)
            document.addEventListener('click', function(e) {
                let removeStepBtn = e.target.closest('.btn-remove-step');
                if (removeStepBtn) {
                    if (confirm('Bu adımı silmek istediğinize emin misiniz?')) {
                        removeStepBtn.closest('.step-row').remove();
                    }
                }
            });

        });
    </script>
@endpush
