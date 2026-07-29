@extends('admin.layouts.master')

@section('title', 'Kapı Düzenle: ' . ($door->translate('en')?->name ?? 'İsimsiz Kapı'))

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Kapı Düzenle: <span class="text-primary">{{ $door->translate('en')?->name ?? '' }}</span></h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.door.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
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

    <!-- Sistemdeki dilleri burada tanımlıyoruz -->
    @php
        $locales = [
            'en' => ['name' => 'İngilizce',  'icon' => 'gb', 'placeholder' => 'American Panel Door'],
            'es' => ['name' => 'İspanyolca', 'icon' => 'es', 'placeholder' => 'Puerta de Panel Americano']
        ];
    @endphp

        <!-- ANA SEKMELER (Genel Bilgiler / Varyantlar / Özellikler / Sertifikalar) -->
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
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs"
                    type="button" role="tab" aria-controls="specs" aria-selected="false">
                <i data-lucide="list" class="icon-sm me-2"></i> Kapı Özellikleri
                <span class="badge bg-info ms-1">{{ $door->spesifications->count() ?? 0 }}</span>
            </button>
        </li>
        <!-- YENİ EKLENEN SERTİFİKA SEKMESİ BAŞLANGIÇ -->
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="certs-tab" data-bs-toggle="tab" data-bs-target="#certs"
                    type="button" role="tab" aria-controls="certs" aria-selected="false">
                <i data-lucide="shield-check" class="icon-sm me-2"></i> Sertifikalar
                <span class="badge bg-success ms-1">{{ $door->sertificates->count() ?? 0 }}</span>
            </button>
        </li>
        <!-- YENİ EKLENEN SERTİFİKA SEKMESİ BİTİŞ -->
    </ul>

    <div class="tab-content" id="mainTabsContent">

        <!-- ========================================== -->
        <!-- 1. SEKME: GENEL BİLGİLER (Form)            -->
        <!-- ========================================== -->
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.door.update', $door->id) }}" method="POST" enctype="multipart/form-data">
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
                                                type="button" role="tab">
                                            <i class="flag-icon flag-icon-{{ $locale['icon'] }} me-2"></i>
                                            {{ $locale['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content border border-top-0 p-3 mb-3">
                                @foreach($locales as $code => $locale)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-{{ $code }}" role="tabpanel">

                                        <!-- Collection Name Alanı -->
                                        <div class="mb-3">
                                            <label for="collection_name_{{ $code }}" class="form-label">
                                                Koleksiyon Adı ({{ strtoupper($code) }}) @if($loop->first) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text"
                                                   class="form-control @error($code.'.collection_name') is-invalid @enderror"
                                                   id="collection_name_{{ $code }}"
                                                   name="{{ $code }}[collection_name]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }} Collection"
                                                   value="{{ old($code.'.collection_name', $door->translate($code)?->collection_name) }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                        </div>

                                        <!-- Kapı Adı Alanı -->
                                        <div class="mb-3">
                                            <label for="name_{{ $code }}" class="form-label">
                                                Kapı Adı ({{ strtoupper($code) }}) @if($loop->first) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text"
                                                   class="form-control @error($code.'.name') is-invalid @enderror"
                                                   id="name_{{ $code }}"
                                                   name="{{ $code }}[name]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }}"
                                                   value="{{ old($code.'.name', $door->translate($code)?->name) }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                        </div>

                                        <!-- Açıklama Alanı -->
                                        <div class="mb-3">
                                            <label for="description_{{ $code }}" class="form-label">Açıklama ({{ strtoupper($code) }})</label>
                                            <textarea
                                                class="form-control @error($code.'.description') is-invalid @enderror"
                                                id="description_{{ $code }}"
                                                name="{{ $code }}[description]"
                                                rows="3">{{ old($code.'.description', $door->translate($code)?->description) }}</textarea>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="card-title mb-4">Genel Ayarlar</h6>

                        <!-- ÇEVRİLMEYEN ORTAK ALANLAR (Görseller, Durum) -->
                        <div class="row">

                            <!-- 1. Sütun: Ana Kapı Görseli -->
                            <div class="col-md-4 mb-3">
                                <x-media-picker name="media_id" label="Kapı Görseli Seç" :multiple="false" :value="$door->media_id ?? null"/>
                                <div class="form-text text-secondary">Tercih edilen boyut: 800x800px.</div>
                                @error('media_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 2. Sütun: Özellikler Görseli -->
                            <div class="col-md-4 mb-3">
                                <x-media-picker name="spec_image_id" label="Özellikler Görseli Seç" :multiple="false" :value="$door->spec_image_id ?? null"/>
                                <div class="form-text text-secondary">Özellikler alanında gösterilecek tekil görsel.</div>
                                @error('spec_image_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 3. Sütun: Durum -->
                            <div class="col-md-4 mb-4">
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
            <!-- (Varyant kodlarınız aynı şekilde kalıyor...) -->
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
                                <input type="text" name="name" class="form-control" placeholder="Örn: Beyaz, Ceviz, 80x200" required>
                            </div>
                            <div class="col-md-3">
                                <x-media-picker name="mini_picture_id" label="Küçük Görsel Seç" :multiple="false"/>
                            </div>
                            <div class="col-md-3">
                                <x-media-picker name="picture_id" label="Büyük Görsel Seç" :multiple="false"/>
                            </div>
                            <div class="col-md-2 mt-auto">
                                <button type="submit" class="btn btn-success w-100 fw-bold d-flex align-items-center justify-content-center h-100">
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
                                    <td>
                                        @if($variant->miniPicture)
                                            <img src="{{ $variant->miniPicture->type == 'internal' ? Storage::url($variant->miniPicture->path) : $variant->miniPicture->path }}" alt="Mini" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted small">Yok</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($variant->picture)
                                            <img src="{{ $variant->picture->type == 'internal' ? Storage::url($variant->picture->path) : $variant->picture->path }}" alt="Picture" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted small">Yok</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.door.variant.destroy', [$door->id, $variant->id]) }}" method="POST" class="d-inline-block delete-form">
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
                                    <td colspan="4" class="text-center py-4 text-muted">Henüz bu kapıya ait varyant eklenmemiş.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 3. SEKME: KAPI ÖZELLİKLERİ (Tablo ve Ekleme) -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
            <div class="card mb-4 border-info">
                <div class="card-header bg-info text-white d-flex align-items-center">
                    <i data-lucide="list-plus" class="icon-sm me-2"></i> Yeni Özellik Ekle
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.door.spesification.store', $door->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <ul class="nav nav-pills mb-3" id="specLangTabs" role="tablist">
                                    @foreach($locales as $code => $locale)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }} py-1 px-3"
                                                    id="spec-lang-{{ $code }}-tab"
                                                    data-bs-toggle="pill"
                                                    data-bs-target="#spec-lang-{{ $code }}"
                                                    type="button" role="tab">
                                                <i class="flag-icon flag-icon-{{ $locale['icon'] }} me-1"></i> {{ $locale['name'] }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content" id="specLangTabsContent">
                                    @foreach($locales as $code => $locale)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="spec-lang-{{ $code }}" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Özellik Adı ({{ strtoupper($code) }}) @if($loop->first)<span class="text-danger">*</span>@endif</label>
                                                    <input type="text" name="{{ $code }}[name]" class="form-control" placeholder="Örn: Malzeme" {{ $loop->first ? 'required' : '' }}>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Değer ({{ strtoupper($code) }}) @if($loop->first)<span class="text-danger">*</span>@endif</label>
                                                    <input type="text" name="{{ $code }}[value]" class="form-control" placeholder="Örn: Masif Ahşap" {{ $loop->first ? 'required' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-end border-start ps-3">
                                <div class="mb-3">
                                    <label class="form-label">Sıralama</label>
                                    <input type="number" name="order" class="form-control" value="0">
                                </div>
                                <button type="submit" class="btn btn-info w-100 fw-bold text-white d-flex align-items-center justify-content-center">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Mevcut Özellikler</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Sıra</th>
                                <th>Özellik Adı (EN)</th>
                                <th>Değer (EN)</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($door->spesifications ?? [] as $spec)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">{{ $spec->order }}</span>
                                    </td>
                                    <td class="fw-bold text-primary">{{ $spec->translate('en')?->name ?? '-' }}</td>
                                    <td>{{ $spec->translate('en')?->value ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.door.spesification.destroy', [$door->id, $spec->id]) }}" method="POST" class="d-inline-block delete-form">
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
                                        Henüz bu kapıya ait özellik eklenmemiş.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 4. SEKME: SERTİFİKALAR                     -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="certs" role="tabpanel" aria-labelledby="certs-tab">

            <div class="card mb-4 border-success">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i data-lucide="edit-3" class="icon-sm me-2"></i> Sertifika Alanı Yazılarını Düzenle
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.door.sertification_texts.update', $door->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <ul class="nav nav-pills mb-3" id="certLangTabs" role="tablist">
                            @foreach($locales as $code => $locale)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }} py-1 px-3"
                                            id="cert-lang-{{ $code }}-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#cert-lang-{{ $code }}"
                                            type="button" role="tab">
                                        <i class="flag-icon flag-icon-{{ $locale['icon'] }} me-1"></i> {{ $locale['name'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content border rounded p-3 mb-3 bg-light" id="certLangTabsContent">
                            @foreach($locales as $code => $locale)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="cert-lang-{{ $code }}" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Sertifika Badge ({{ strtoupper($code) }})</label>
                                            <input type="text" name="{{ $code }}[sertification_badge]" class="form-control" placeholder="Örn: Fire-Resistant Door" value="{{ old($code.'.sertification_badge', $door->translate($code)?->sertification_badge) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Sertifika Başlığı ({{ strtoupper($code) }})</label>
                                            <input type="text" name="{{ $code }}[sertification_title]" class="form-control" placeholder="Örn: Performance & Standards" value="{{ old($code.'.sertification_title', $door->translate($code)?->sertification_title) }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Sertifika Açıklaması ({{ strtoupper($code) }})</label>
                                            <textarea name="{{ $code }}[sertification_description]" class="form-control" rows="2" placeholder="Sertifikalar hakkında kısa bilgi...">{{ old($code.'.sertification_description', $door->translate($code)?->sertification_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success fw-bold">
                            <i data-lucide="save" class="icon-sm me-1"></i> Yazıları Kaydet
                        </button>
                    </form>
                </div>
            </div>

            <!-- 4.B Yeni Sertifika Ekleme Formu (door_sertificates tablosu) -->
            <div class="card mb-4 border-success">
                <div class="card-header bg-success text-white d-flex align-items-center bg-opacity-75">
                    <i data-lucide="plus-square" class="icon-sm me-2"></i> Yeni Sertifika Logosu Ekle
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.door.sertificate.store', $door->id) }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <x-media-picker name="image_id" label="Sertifika Görseli (Logo)" :multiple="false"/>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sıralama</label>
                                <input type="number" name="order" class="form-control" value="0" required>
                            </div>
                            <div class="col-md-3 mt-auto">
                                <button type="submit" class="btn btn-success w-100 fw-bold d-flex align-items-center justify-content-center h-100">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Sertifikayı Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- 4.C Mevcut Sertifikalar Tablosu -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Ekli Sertifikalar</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Sıra</th>
                                <th>Sertifika Görseli</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($door->sertificates ?? [] as $cert)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">{{ $cert->order }}</span>
                                    </td>
                                    <td>
                                        @if($cert->image)
                                            <img src="{{ $cert->image->type == 'internal' ? Storage::url($cert->image->path) : $cert->image->path }}" alt="Sertifika" style="height: 50px; width: auto; object-fit: contain;">
                                        @else
                                            <span class="text-muted small">Yok</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.door.sertificate.destroy', [$cert->id]) }}" method="POST" class="d-inline-block delete-form">
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
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        Henüz bu kapıya ait sertifika logosu eklenmemiş.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- Sertifikalar Sekmesi Bitiş -->

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
                        title: 'Emin misiniz?',
                        text: "Bu kayıt kalıcı olarak silinecektir!",
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
