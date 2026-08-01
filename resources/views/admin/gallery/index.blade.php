@extends('admin.layouts.master')

@section('title', 'Galeri Görselleri Yönetimi')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Galeri Görselleri Yönetimi</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Kontrol Paneline Dön
            </a>
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

    @php
        $locales = [
            'en' => ['name' => 'İngilizce',  'icon' => 'gb', 'placeholder' => 'e.g: 2024 Istanbul Fair'],
            'es' => ['name' => 'İspanyolca', 'icon' => 'es', 'placeholder' => 'ej: Feria de Estambul 2024']
        ];

    @endphp

        <!-- YENİ GÖRSEL EKLEME KARTI -->
    <div class="card mb-4 border-info">
        <div class="card-header bg-info text-white d-flex align-items-center">
            <i data-lucide="plus-circle" class="icon-sm me-2"></i> Yeni Galeri Görseli Ekle
        </div>
        <div class="card-body">
            <form action="{{ route('admin.resources.gallery.store') }}" method="POST">
                @csrf
                <div class="row g-3">

                    <div class="col-md-4 border-end pe-4">
                        <x-media-picker name="image_id" label="Galeri Görseli Seç" :multiple="false"/>
                    </div>

                    <div class="col-md-6 ps-4">
                        <ul class="nav nav-pills mb-3" id="titleLangTabs" role="tablist">
                            @foreach($locales as $code => $locale)
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link {{ $loop->first ? 'active' : '' }} py-1 px-3 border border-bottom-0"
                                        id="title-lang-{{ $code }}-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#title-lang-{{ $code }}"
                                        type="button" role="tab">
                                        <i class="flag-icon flag-icon-{{ $locale['icon'] }} me-1"></i> {{ $locale['name'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="titleLangTabsContent">
                            @foreach($locales as $code => $locale)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="title-lang-{{ $code }}" role="tabpanel">
                                    <label class="form-label fw-bold">Görsel Başlığı ({{ strtoupper($code) }}
                                        ) @if($loop->first)
                                            <span class="text-danger">*</span>
                                        @endif</label>
                                    <input type="text"
                                           name="{{ $code }}[title]"
                                           class="form-control"
                                           placeholder="{{ $locale['placeholder'] }}"
                                        {{ $loop->first ? 'required' : '' }}>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit"
                                class="btn btn-info w-100 fw-bold text-white d-flex align-items-center justify-content-center"
                                style="min-height: 42px;">
                            <i data-lucide="upload-cloud" class="icon-sm me-1"></i> Ekle
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title mb-4">Sistemde Kayıtlı Galeri Görselleri (<span
                    class="text-primary">{{ $galleryImages->total() }}</span>)</h6>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th class="pt-0">#</th>
                        <th class="pt-0">Görsel Önizleme</th>
                        <th class="pt-0">Başlıklar (EN / ES)</th>
                        <th class="pt-0 text-end">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($galleryImages ?? [] as $image)
                        <tr>
                            <td>
                                <span class="badge bg-secondary fs-6">
                                    {{$galleryImages->firstItem() + $loop->index}}
                                </span>
                            </td>
                            <td>
                                @if($image->media)
                                    <img
                                        src="{{ $image->media->type == 'internal' ? Storage::url($image->media->path) : $image->media->path }}"
                                        alt="{{ $image->translate('en')?->title ?? 'Galeri Görseli' }}"
                                        style="width: 100px; height: 70px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.15);">
                                @else
                                    <span class="text-muted small">
                                        <i data-lucide="image-off" class="icon-sm me-1"></i> Görsel Yok
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center">
                                        <i class="flag-icon flag-icon-gb me-2" title="İngilizce"></i>
                                        <span class="fw-bold">{{ $image->translate('en')?->title ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="flag-icon flag-icon-es me-2" title="İspanyolca"></i>
                                        <span class="text-muted">{{ $image->translate('es')?->title ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.resources.gallery.destroy', $image->id) }}" method="POST"
                                      class="d-inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-icon shadow-sm" title="Sil">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i data-lucide="image" class="icon-lg mb-2 opacity-50"></i><br>
                                Henüz galeriye görsel eklenmemiş.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $galleryImages->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Silmek istediğinize emin misiniz?',
                        text: "Bu görsel kalıcı olarak galeriden silinecektir!",
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

        });
    </script>
@endpush
