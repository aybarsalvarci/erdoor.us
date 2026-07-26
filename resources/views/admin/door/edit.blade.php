@extends('admin.layouts.master')

<!-- 'tr' sistemden çıkarıldığı için başlıkta fallback olarak 'en' kullanıyoruz -->
@section('title', 'Kapı Düzenle: ' . ($door->translate('en')?->name ?? 'İsimsiz Kapı'))

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <!-- Başlığı da aynı mantıkla güncelledik -->
            <h4 class="mb-3 mb-md-0">Kapı Düzenle: <span class="text-primary">{{ $door->translate('en')?->name ?? '' }}</span></h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.door.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <!-- Sistemdeki dilleri burada tanımlıyoruz -->
    @php
        $locales = [
            'en' => ['name' => 'İngilizce',  'icon' => 'gb', 'placeholder' => 'American Panel Door'],
            'es' => ['name' => 'İspanyolca', 'icon' => 'es', 'placeholder' => 'Puerta de Panel Americano']
        ];
    @endphp

        <!-- ANA SEKMELER (Genel Bilgiler / Varyantlar) -->
    <ul class="nav nav-tabs nav-tabs-line mb-4" id="mainTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                    type="button" role="tab" aria-controls="general" aria-selected="true">
                <i data-lucide="info" class="icon-sm me-2"></i> Genel Bilgiler
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="variants-tab" data-bs-toggle="tab" data-bs-target="#variants"
                    type="button" role="tab" aria-controls="variants" aria-selected="false">
                <i data-lucide="layers" class="icon-sm me-2"></i> Varyantlar
                <span class="badge bg-primary ms-1">{{ $door->variants->count() ?? 0 }}</span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="mainTabsContent">

        <!-- ========================================== -->
        <!-- 1. SEKME: GENEL BİLGİLER (Form)            -->
        <!-- ========================================== -->
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.door.update', $door->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- DİL SEKMELERİ (İç Sekmeler) -->
                        <div class="mb-4">
                            <ul class="nav nav-tabs nav-tabs-line" id="langTabs" role="tablist">
                                @foreach($locales as $code => $locale)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                id="lang-{{ $code }}-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#lang-{{ $code }}"
                                                type="button" role="tab"
                                                aria-controls="lang-{{ $code }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <i class="flag-icon flag-icon-{{ $locale['icon'] }} me-2"></i>
                                            {{ $locale['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content border border-top-0 p-3 mb-3">
                                @foreach($locales as $code => $locale)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                         id="lang-{{ $code }}" role="tabpanel">

                                        <!-- Collection Name Alanı -->
                                        <div class="mb-3">
                                            <label for="collection_name_{{ $code }}" class="form-label">
                                                Koleksiyon Adı ({{ strtoupper($code) }})
                                                @if($loop->first) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text"
                                                   class="form-control @error($code.'.collection_name') is-invalid @enderror"
                                                   id="collection_name_{{ $code }}"
                                                   name="{{ $code }}[collection_name]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }} Collection"
                                                   value="{{ old($code.'.collection_name', $door->translate($code)?->collection_name) }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                            @error($code.'.collection_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kapı Adı Alanı -->
                                        <div class="mb-3">
                                            <label for="name_{{ $code }}" class="form-label">
                                                Kapı Adı ({{ strtoupper($code) }})
                                                @if($loop->first) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text"
                                                   class="form-control @error($code.'.name') is-invalid @enderror"
                                                   id="name_{{ $code }}"
                                                   name="{{ $code }}[name]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }}"
                                                   value="{{ old($code.'.name', $door->translate($code)?->name) }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                            @error($code.'.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Açıklama Alanı -->
                                        <div class="mb-3">
                                            <label for="description_{{ $code }}" class="form-label">
                                                Açıklama ({{ strtoupper($code) }})
                                            </label>
                                            <textarea
                                                class="form-control @error($code.'.description') is-invalid @enderror"
                                                id="description_{{ $code }}"
                                                name="{{ $code }}[description]"
                                                rows="3">{{ old($code.'.description', $door->translate($code)?->description) }}</textarea>
                                            @error($code.'.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="card-title mb-4">Genel Ayarlar</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <x-media-picker name="media_id" label="Kapı Görseli Seç" :multiple="false"
                                                :value="$door->media_id ?? null"/>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">Durum</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1" {{ old('status', $door->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $door->status) == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm">
                            <i data-lucide="save" class="icon-sm me-2"></i> Değişiklikleri Kaydet
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 2. SEKME: VARYANTLAR (Tablo ve Ekleme)     -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="variants" role="tabpanel" aria-labelledby="variants-tab">

            <!-- Yeni Varyant Ekleme Formu -->
            <div class="card mb-4 border-primary">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i data-lucide="plus-circle" class="icon-sm me-2"></i> Yeni Varyant Ekle
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.door.variant.store', $door->id) }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">

                            <div class="col-md-4">
                                <label class="form-label">Varyant Adı <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="Örn: Beyaz, Ceviz, 80x200" required>
                            </div>

                            <div class="col-md-3">
                                <x-media-picker name="mini_picture_id" label="Küçük Görsel Seç" :multiple="false"/>
                            </div>

                            <div class="col-md-3">
                                <x-media-picker name="picture_id" label="Büyük Görsel Seç" :multiple="false"/>
                            </div>

                            <div class="col-md-2 mt-auto">
                                <button type="submit"
                                        class="btn btn-success w-100 fw-bold d-flex align-items-center justify-content-center h-100">
                                    <i data-lucide="check" class="icon-sm me-1"></i> Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Mevcut Varyantlar Tablosu -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Mevcut Varyantlar</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Varyant Adı</th>
                                <th>Küçük Görsel</th>
                                <th>Büyük Görsel</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($door->variants ?? [] as $variant)
                                <tr>
                                    <td class="fw-bold">{{ $variant->name }}</td>

                                    <!-- Küçük Görsel Gösterimi -->
                                    <td>
                                        @if($variant->miniPicture)
                                            <img
                                                src="{{ $variant->miniPicture->type == 'internal' ? Storage::url($variant->miniPicture->path) : $variant->miniPicture->path }}"
                                                alt="Mini"
                                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted small">Yok</span>
                                        @endif
                                    </td>

                                    <!-- Büyük Görsel Gösterimi -->
                                    <td>
                                        @if($variant->picture)
                                            <img
                                                src="{{ $variant->picture->type == 'internal' ? Storage::url($variant->picture->path) : $variant->picture->path }}"
                                                alt="Picture"
                                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted small">Yok</span>
                                        @endif
                                    </td>

                                    <td>
                                        <form
                                            action="{{ route('admin.door.variant.destroy', [$door->id, $variant->id]) }}"
                                            method="POST" class="d-inline-block delete-form">
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
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Henüz bu kapıya ait varyant eklenmemiş.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- Varyantlar Sekmesi Bitiş -->

    </div> <!-- Ana Tab Content Bitiş -->
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Silme işlemi için SweetAlert onayı
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Emin misiniz?',
                        text: "Bu varyant silinecektir!",
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

            // "Kapıyı Kaydet ve İlerle" işleminden sonra direkt Varyantlar sekmesini açmak için kontrol
            @if(session('tab') == 'variants')
            var variantsTab = new bootstrap.Tab(document.querySelector('#variants-tab'));
            variantsTab.show();
            @endif
        });
    </script>
@endpush
