@extends('admin.layouts.master')

@section('title', 'Yeni Bülten Ekle')

@push('css')
    <style>
        .tox-promotion { display: none !important; } /* TinyMCE reklamını gizler */
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Yeni Bülten Ekle</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Bülten Bilgilerini Giriniz</h6>

                    <!-- TÜM HATALARI GÖSTEREN GENEL UYARI ALANI BAŞLANGIÇ -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center mb-2">
                                <i data-lucide="alert-circle" class="icon-md me-2"></i>
                                <h6 class="mb-0">Lütfen aşağıdaki hataları düzeltiniz:</h6>
                            </div>
                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- TÜM HATALARI GÖSTEREN GENEL UYARI ALANI BİTİŞ -->

                    <!-- Bülten Ekleme Formu -->
                    <form action="{{ route('admin.newsletter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Başlık Alanı -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Bülten Başlığı <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   placeholder="Örn: Yeni Koleksiyonumuz Yayında!"
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- İçerik (TinyMCE) Alanı -->
                        <div class="mb-3">
                            <label for="body" class="form-label">İçerik <span class="text-danger">*</span></label>
                            <textarea
                                class="form-control tinymce-editor @error('body') is-invalid @enderror"
                                id="body"
                                name="body"
                                rows="15"
                                placeholder="Bülten içeriğini buraya yazınız...">{{ old('body') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buton Metni & Linki (Yan Yana) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="button_text" class="form-label">Buton Metni</label>
                                <input type="text"
                                       class="form-control @error('button_text') is-invalid @enderror"
                                       id="button_text"
                                       name="button_text"
                                       placeholder="Örn: Kataloğu İncele"
                                       value="{{ old('button_text') }}">
                                @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="button_link" class="form-label">Buton Linki (URL)</label>
                                <input type="url"
                                       class="form-control @error('button_link') is-invalid @enderror"
                                       id="button_link"
                                       name="button_link"
                                       placeholder="Örn: https://erdoor.com/katalog"
                                       value="{{ old('button_link') }}">
                                @error('button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="card-title mb-4">Gönderim ve Durum Ayarları</h6>

                        <div class="row">
                            <!-- Gönderim Tarihi (Zamanlanmış Gönderim) -->
                            <div class="col-md-6 mb-3">
                                <label for="send_at" class="form-label">Gönderim Zamanı (İsteğe Bağlı)</label>
                                <input type="datetime-local"
                                       class="form-control @error('send_at') is-invalid @enderror"
                                       id="send_at"
                                       name="send_at"
                                       value="{{ old('send_at') }}">
                                <div class="form-text text-secondary">Boş bırakırsanız bülten hemen gönderim kuyruğuna alınır.</div>
                                @error('send_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Durum -->
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">Durum</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Aktif (Yayına Al)</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'draft' : '' }}>Pasif (Taslak)</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Butonlar -->
                        <div class="d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm">
                                <i data-lucide="send" class="icon-sm me-2"></i> Bülteni Kaydet
                            </button>
                            <button type="reset" class="btn btn-outline-secondary d-flex align-items-center">
                                <i data-lucide="rotate-ccw" class="icon-sm me-2"></i> Formu Temizle
                            </button>
                        </div>
                    </form>

                    <div id="tinymce-media-picker-wrapper">
                        <x-media-picker name="tinymce_media" id="tinymce_media" :multiple="false" :hideTrigger="true" />
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- CDN YERİNE TEMANIN LOKAL DOSYASI KULLANILIYOR -->
    <script src="{{ asset('back/assets/vendors/tinymce/tinymce.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 1. MEVCUT TEMAYI KONTROL ETME FONKSİYONU
            function isDarkTheme() {
                return document.documentElement.getAttribute('data-bs-theme') === 'dark' ||
                    document.body.classList.contains('dark-theme') ||
                    document.getElementById('theme-switcher')?.checked;
            }

            // 2. TINYMCE AYARLARI
            const getTinyMceConfig = (isDark) => ({
                selector: '.tinymce-editor',
                license_key: 'gpl',
                promotion: false,
                branding: false,
                height: 500,

                skin: isDark ? 'oxide-dark' : 'oxide',
                content_css: isDark ? 'dark' : 'default',

                plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table directionality',
                toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | code',
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image media',

                // MEDYA BUTONUNA TIKLANDIĞINDA ÇALIŞAN KISIM (BURASI DÜZELTİLDİ)
                file_picker_callback: function (callback, value, meta) {
                    if (meta.filetype === 'image') {

                        // A) Sizin component'inizin beklediği global değişkene TinyMCE'nin callback'ini atıyoruz
                        window.currentTinyMceCallback = callback;

                        // B) Component'in dinlediği Alpine.js Event'ini tetikliyoruz
                        window.dispatchEvent(new CustomEvent('open-tinymce-media', {
                            detail: { target: 'tinymce_media' } // Wrapper içindeki name ile aynı olmalı
                        }));

                    }
                }
            });

            // 3. İLK YÜKLEMEDE TINYMCE'Yİ BAŞLAT
            tinymce.init(getTinyMceConfig(isDarkTheme()));

            // 4. NOBLE UI TEMA DEĞİŞTİRİCİYİ (GÜNEŞ/AY BUTONU) DİNLE
            const themeSwitcher = document.getElementById('theme-switcher');
            if (themeSwitcher) {
                themeSwitcher.addEventListener('change', function () {
                    tinymce.remove('.tinymce-editor');
                    tinymce.init(getTinyMceConfig(this.checked));
                });
            }
        });
    </script>
@endpush
