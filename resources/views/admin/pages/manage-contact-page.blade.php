@extends('admin.layouts.master')

@section('title', 'Contact Us Sayfası İçeriğini Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Contact Us Sayfası İçeriğini Düzenle</h4>
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

                    <form action="{{ route('admin.pages.contact.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php
                            $locales = [
                                'en' => 'İngilizce (EN)',
                                'es' => 'İspanyolca (ES)'
                            ];
                        @endphp

                        <ul class="nav nav-tabs nav-tabs-line" id="sectionTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#section-info" role="tab">
                                    <i data-lucide="info" class="icon-sm me-1"></i> SEO & İletişim Bilgileri
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#section-form" role="tab">
                                    <i data-lucide="mail" class="icon-sm me-1"></i> İletişim Formu Ayarları
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content border border-top-0 p-4 mb-4 rounded-bottom shadow-sm">

                            <div class="tab-pane fade show active" id="section-info" role="tabpanel">
                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#info-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $info = $content['info_section'] ?? [];
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="info-lang-{{ $code }}" role="tabpanel">

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

                                            <h5 class="mb-3 mt-4 pb-2 border-bottom text-primary">İletişim Bilgileri (Info Section)</h5>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Alan Ana Başlığı</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][title]" value="{{ old('translations.'.$code.'.content.info_section.title', $info['title'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Konum Başlığı</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][location_title]" value="{{ old('translations.'.$code.'.content.info_section.location_title', $info['location_title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Konum Metni (Adres)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][location_text]" value="{{ old('translations.'.$code.'.content.info_section.location_text', $info['location_text'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Telefon Başlığı</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][phone_title]" value="{{ old('translations.'.$code.'.content.info_section.phone_title', $info['phone_title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Telefon Numarası</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][phone_text]" value="{{ old('translations.'.$code.'.content.info_section.phone_text', $info['phone_text'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email Başlığı</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][email_title]" value="{{ old('translations.'.$code.'.content.info_section.email_title', $info['email_title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email Adresi</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][email_text]" value="{{ old('translations.'.$code.'.content.info_section.email_text', $info['email_text'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Çalışma Saatleri Başlığı</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][hours_title]" value="{{ old('translations.'.$code.'.content.info_section.hours_title', $info['hours_title'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Çalışma Saatleri Metni</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][hours_text]" value="{{ old('translations.'.$code.'.content.info_section.hours_text', $info['hours_text'] ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Harita Kodu (iframe)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][info_section][map_query]" value="{{ old('translations.'.$code.'.content.info_section.map_query', $info['map_query'] ?? '') }}">
                                                    <small class="text-muted">Maps iframe kodu</small>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="section-form" role="tabpanel">
                                <ul class="nav nav-pills mb-4 bg-light p-2 rounded" role="tablist">
                                    @foreach($locales as $code => $name)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#form-lang-{{ $code }}" role="tab">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $translation = $page->translations->firstWhere('locale', $code);
                                            $content = $translation ? ($translation->content ?? []) : [];
                                            $form = $content['form_section'] ?? [];
                                            $roles = $form['role_options'] ?? [];
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="form-lang-{{ $code }}" role="tabpanel">

                                            <h5 class="mb-3 pb-2 border-bottom text-primary">Form Alanı Çevirileri ({{ strtoupper($code) }})</h5>

                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <label class="form-label">Form Başlığı (Title)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][title]" value="{{ old('translations.'.$code.'.content.form_section.title', $form['title'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">İsim Etiketi (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][name_label]" value="{{ old('translations.'.$code.'.content.form_section.name_label', $form['name_label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">İsim Yer Tutucu (Placeholder)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][name_placeholder]" value="{{ old('translations.'.$code.'.content.form_section.name_placeholder', $form['name_placeholder'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email Etiketi (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][email_label]" value="{{ old('translations.'.$code.'.content.form_section.email_label', $form['email_label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email Yer Tutucu (Placeholder)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][email_placeholder]" value="{{ old('translations.'.$code.'.content.form_section.email_placeholder', $form['email_placeholder'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Telefon Etiketi (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][phone_label]" value="{{ old('translations.'.$code.'.content.form_section.phone_label', $form['phone_label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Telefon Yer Tutucu (Placeholder)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][phone_placeholder]" value="{{ old('translations.'.$code.'.content.form_section.phone_placeholder', $form['phone_placeholder'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Rol Etiketi (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][role_label]" value="{{ old('translations.'.$code.'.content.form_section.role_label', $form['role_label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Rol Yer Tutucu (Varsayılan Seçenek)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][role_placeholder]" value="{{ old('translations.'.$code.'.content.form_section.role_placeholder', $form['role_placeholder'] ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mesaj Etiketi (Label)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][message_label]" value="{{ old('translations.'.$code.'.content.form_section.message_label', $form['message_label'] ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mesaj Yer Tutucu (Placeholder)</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][message_placeholder]" value="{{ old('translations.'.$code.'.content.form_section.message_placeholder', $form['message_placeholder'] ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mb-4">
                                                    <label class="form-label">Gönder Butonu Metni</label>
                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][button_text]" value="{{ old('translations.'.$code.'.content.form_section.button_text', $form['button_text'] ?? '') }}">
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <label class="form-label mb-0 fw-bold">Seçilebilir Roller Listesi</label>
                                                        <button type="button" class="btn btn-sm btn-success btn-add-role" data-lang="{{ $code }}">+ Rol Ekle</button>
                                                    </div>
                                                    <div class="roles-container" id="roles-container-{{ $code }}">
                                                        @foreach($roles as $index => $roleOption)
                                                            <div class="d-flex gap-2 mb-3 role-row">
                                                                <div class="flex-grow-1">
                                                                    <input type="text" class="form-control" name="translations[{{ $code }}][content][form_section][role_options][{{ $index }}]" value="{{ $roleOption }}">
                                                                </div>
                                                                <button type="button" class="btn btn-danger btn-remove-role" title="Sil"><i data-lucide="trash" class="icon-sm"></i></button>
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

            document.querySelectorAll('.btn-add-role').forEach(button => {
                button.addEventListener('click', function() {
                    let langCode = this.getAttribute('data-lang');
                    let container = document.getElementById('roles-container-' + langCode);
                    let newIndex = new Date().getTime();

                    let newRow = `
                        <div class="d-flex gap-2 mb-3 role-row">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control" name="translations[${langCode}][content][form_section][role_options][${newIndex}]" placeholder="Örn: Mimar, Tasarımcı...">
                            </div>
                            <button type="button" class="btn btn-danger btn-remove-role" title="Sil"><i data-lucide="trash" class="icon-sm"></i></button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', newRow);
                    if(typeof lucide !== 'undefined') lucide.createIcons();
                });
            });

            document.addEventListener('click', function(e) {
                let removeRoleBtn = e.target.closest('.btn-remove-role');
                if (removeRoleBtn) {
                    removeRoleBtn.closest('.role-row').remove();
                }
            });

        });
    </script>
@endpush
