@extends('admin.layouts.master')

@section('title', 'Galeri Yönetimi')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Galeri Yönetimi</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <!-- İhtiyaca göre buraya ekstra butonlar eklenebilir -->
        </div>
    </div>

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

    <!-- Sistemdeki dilleri burada tanımlıyoruz -->
    @php
        $locales = [
            'en' => ['name' => 'İngilizce',  'icon' => 'gb', 'placeholder' => 'Our Gallery'],
            'es' => ['name' => 'İspanyolca', 'icon' => 'es', 'placeholder' => 'Nuestra Galería']
        ];
    @endphp

        <!-- ANA SEKMELER (Hero Ayarları / Galeri Görselleri) -->
    <ul class="nav nav-tabs nav-tabs-line mb-4" id="mainTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero"
                    type="button" role="tab" aria-controls="hero" aria-selected="true">
                <i data-lucide="layout-template" class="icon-sm me-2"></i> Hero Ayarları
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                    type="button" role="tab" aria-controls="gallery" aria-selected="false">
                <i data-lucide="image" class="icon-sm me-2"></i> Galeri Görselleri
                <span class="badge bg-primary ms-1">{{ $galleryImages->count() ?? 0 }}</span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="mainTabsContent">

        <!-- ========================================== -->
        <!-- 1. SEKME: HERO AYARLARI                    -->
        <!-- ========================================== -->
        <div class="tab-pane fade show active" id="hero" role="tabpanel" aria-labelledby="hero-tab">
            <div class="card border-primary mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i data-lucide="edit-3" class="icon-sm me-2"></i> Galeri Sayfası Hero Alanı Düzenle
                </div>
                <div class="card-body">
                    <!-- route('admin.gallery.hero.update') kendi sisteminize göre güncelleyin -->
                    <form action="{{ route('admin.gallery.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- DİL SEKMELERİ (İç Sekmeler) -->
                        <div class="mb-4">
                            <ul class="nav nav-pills mb-3" id="heroLangTabs" role="tablist">
                                @foreach($locales as $code => $locale)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }} py-1 px-3"
                                                id="hero-lang-{{ $code }}-tab"
                                                data-bs-toggle="pill"
                                                data-bs-target="#hero-lang-{{ $code }}"
                                                type="button" role="tab">
                                            <i class="flag-icon flag-icon-{{ $locale['icon'] }} me-2"></i>
                                            {{ $locale['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content border rounded p-3 mb-3 bg-light" id="heroLangTabsContent">
                                @foreach($locales as $code => $locale)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="hero-lang-{{ $code }}" role="tabpanel">

                                        <!-- Başlık Alanı -->
                                        <div class="mb-3">
                                            <label for="title_{{ $code }}" class="form-label">
                                                Hero Başlık ({{ strtoupper($code) }}) @if($loop->first) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text"
                                                   class="form-control @error($code.'.title') is-invalid @enderror"
                                                   id="title_{{ $code }}"
                                                   name="{{ $code }}[title]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }}"
                                                   value="{{ old($code.'.title', $hero->translate($code)?->title ?? '') }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                        </div>

                                        <!-- Alt Başlık / Açıklama Alanı -->
                                        <div class="mb-3">
                                            <label for="subtitle_{{ $code }}" class="form-label">Hero Alt Başlık / Açıklama ({{ strtoupper($code) }})</label>
                                            <textarea
                                                class="form-control @error($code.'.subtitle') is-invalid @enderror"
                                                id="subtitle_{{ $code }}"
                                                name="{{ $code }}[subtitle]"
                                                rows="3">{{ old($code.'.subtitle', $hero->translate($code)?->subtitle ?? '') }}</textarea>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="card-title mb-4">Görsel ve Durum Ayarları</h6>

                        <!-- ÇEVRİLMEYEN ORTAK ALANLAR (Hero Görseli) -->
                        <div class="row">
                            <!-- Hero Görseli -->
                            <div class="col-md-6 mb-3">
                                <x-media-picker name="hero_image_id" label="Hero Arkaplan Görseli Seç" :multiple="false" :value="$hero->hero_image_id ?? null"/>
                                <div class="form-text text-secondary">Tercih edilen boyut: 1920x600px.</div>
                                @error('hero_image_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm mt-3">
                            <i data-lucide="save" class="icon-sm me-2"></i> Hero Ayarlarını Kaydet
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 2. SEKME: GALERİ GÖRSELLERİ                -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">

            <!-- Yeni Görsel Ekleme Formu -->
            <div class="card mb-4 border-info">
                <div class="card-header bg-info text-white d-flex align-items-center">
                    <i data-lucide="plus-circle" class="icon-sm me-2"></i> Yeni Galeri Görseli Ekle
                </div>
                <div class="card-body">
                    <!-- route('admin.gallery.image.store') kendi sisteminize göre güncelleyin -->
                    <form action="{{ route('admin.gallery.image.store') }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <x-media-picker name="image_id" label="Galeri Görseli Seç" :multiple="false"/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Sıralama</label>
                                <input type="number" name="order" class="form-control" value="0" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Durum</label>
                                <select class="form-select" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-auto">
                                <button type="submit" class="btn btn-info w-100 fw-bold text-white d-flex align-items-center justify-content-center h-100" style="min-height: 42px;">
                                    <i data-lucide="check" class="icon-sm me-1"></i> Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Mevcut Galeri Görselleri Tablosu -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Mevcut Görseller</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Sıra</th>
                                <th>Görsel</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($galleryImages ?? [] as $image)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">{{ $image->order ?? 0 }}</span>
                                    </td>
                                    <td>
                                        @if($image->media)
                                            <img src="{{ $image->media->type == 'internal' ? Storage::url($image->media->path) : $image->media->path }}" alt="Galeri Görseli" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        @else
                                            <span class="text-muted small">Yok</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($image->status == 1)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Pasif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- route('admin.gallery.image.destroy') kendi sisteminize göre güncelleyin -->
                                        <form action="{{ route('admin.gallery.image.destroy', $image->id) }}" method="POST" class="d-inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Sil">
                                                <i data-lucide="trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Henüz galeriye görsel eklenmemiş.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- Galeri Sekmesi Bitiş -->

    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // SweetAlert ile Silme Onayı
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Emin misiniz?',
                        text: "Bu görsel kalıcı olarak silinecektir!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Evet, Sil!',
                        cancelButtonText: 'İptal',
                        customClass: {
                            confirmButton: 'btn btn-danger px-4 fw-bold me-2',
                            cancelButton: 'btn btn-secondary px-4 fw-bold'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            @if(session('tab'))
            var tabId = '#{{ session('tab') }}-tab';
            var triggerEl = document.querySelector(tabId);

            if (triggerEl) {
                var tabInstance = new bootstrap.Tab(triggerEl);
                tabInstance.show();
            }
            @endif

        });
    </script>
@endpush
