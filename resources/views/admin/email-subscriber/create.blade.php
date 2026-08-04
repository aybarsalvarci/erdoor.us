@extends('admin.layouts.master')

@section('title', 'Yeni Kapı Ekle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Yeni Kapı Ekle</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.door.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Kapı Bilgilerini Giriniz</h6>

                    @php
                        $locales = [
                            'en' => ['name' => 'İngilizce',  'icon' => 'gb', 'placeholder' => 'American Panel Door'],
                            'es' => ['name' => 'İspanyolca', 'icon' => 'es', 'placeholder' => 'Puerta de Panel Americano']
                        ];
                    @endphp

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

                    <!-- Kapı Ekleme Formu -->
                    <form action="{{ route('admin.door.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- DİL SEKMELERİ BAŞLANGIÇ -->
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

                            <div class="tab-content border border-top-0 p-3 mb-3" id="langTabsContent">
                                @foreach($locales as $code => $locale)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                         id="lang-{{ $code }}"
                                         role="tabpanel"
                                         aria-labelledby="lang-{{ $code }}-tab">

                                        <!-- Çevrilebilir Alanlar -->
                                        <div class="mb-3">
                                            <label for="collection_name_{{ $code }}" class="form-label">Koleksiyon Adı ({{ strtoupper($code) }}) @if($loop->first)<span class="text-danger">*</span>@endif</label>
                                            <input type="text"
                                                   class="form-control @error($code.'.collection_name') is-invalid @enderror"
                                                   id="collection_name_{{ $code }}"
                                                   name="{{ $code }}[collection_name]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }}"
                                                   value="{{ old($code.'.collection_name') }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                            @error($code.'.collection_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="name_{{ $code }}" class="form-label">Kapı Adı ({{ strtoupper($code) }}) @if($loop->first)<span class="text-danger">*</span>@endif</label>
                                            <input type="text"
                                                   class="form-control @error($code.'.name') is-invalid @enderror"
                                                   id="name_{{ $code }}"
                                                   name="{{ $code }}[name]"
                                                   placeholder="Örn: {{ $locale['placeholder'] }}"
                                                   value="{{ old($code.'.name') }}"
                                                {{ $loop->first ? 'required' : '' }}>
                                            @error($code.'.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="short_description_{{ $code }}" class="form-label">Kısa Açıklama ({{ strtoupper($code) }})</label>
                                            <textarea
                                                class="form-control @error($code.'.short_description') is-invalid @enderror"
                                                id="short_description_{{ $code }}"
                                                name="{{ $code }}[short_description]"
                                                rows="3"
                                                placeholder="Kapı hakkında kısa açıklama...">{{ old($code.'.short_description') }}</textarea>
                                            @error($code.'.short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description_{{ $code }}" class="form-label">Açıklama ({{ strtoupper($code) }})</label>
                                            <textarea
                                                class="form-control @error($code.'.description') is-invalid @enderror"
                                                id="description_{{ $code }}"
                                                name="{{ $code }}[description]"
                                                rows="3"
                                                placeholder="Kapı hakkında detaylı açıklama...">{{ old($code.'.description') }}</textarea>
                                            @error($code.'.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- DİL SEKMELERİ BİTİŞ -->

                        <hr class="my-4">
                        <h6 class="card-title mb-4">Genel Ayarlar</h6>

                        <!-- ÇEVRİLMEYEN ORTAK ALANLAR (Görsel, Özellik Görseli, Durum) -->
                        <div class="row">

                            <!-- 1. Sütun: Ana Kapı Görseli -->
                            <div class="col-md-4 mb-3">
                                <x-media-picker name="media_id" label="Kapı Görseli Seç" :multiple="false"/>
                                <div class="form-text text-secondary">Tercih edilen boyut: 800x800px. Sadece JPG, PNG veya WEBP.</div>
                                @error('media_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 2. Sütun: Özellikler Görseli (Yeni Eklenen Alan) -->
                            <div class="col-md-4 mb-3">
                                <x-media-picker name="spec_image_id" label="Özellikler Görseli Seç" :multiple="false"/>
                                <div class="form-text text-secondary">Özellikler alanında gösterilecek tekil görsel.</div>
                                @error('spec_image_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 3. Sütun: Durum -->
                            <div class="col-md-4 mb-4">
                                <label for="status" class="form-label">Durum</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Butonlar -->
                        <div class="d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm">
                                <i data-lucide="save" class="icon-sm me-2"></i> Kapıyı Kaydet ve İlerle
                            </button>
                            <button type="reset" class="btn btn-outline-secondary d-flex align-items-center">
                                <i data-lucide="rotate-ccw" class="icon-sm me-2"></i> Formu Temizle
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
