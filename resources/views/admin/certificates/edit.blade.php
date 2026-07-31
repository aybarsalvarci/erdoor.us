@extends('admin.layouts.master')

@section('title', 'Doküman Düzenle: ' . ($certificate->title ?? ''))

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Doküman Düzenle: <span class="text-primary">{{ $certificate->title ?? '' }}</span></h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.resources.certificates.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <!-- TÜM HATALARI GÖSTEREN GENEL UYARI ALANI -->
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

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Doküman Bilgilerini Güncelle</h6>

                    <!-- Doküman Güncelleme Formu -->
                    <form action="{{ route('admin.resources.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- 1. Kategori Seçimi -->
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="certificate" {{ old('category', $certificate->category) == 'certificate' ? 'selected' : '' }}>Sertifika (Certificate)</option>
                                    <option value="technical" {{ old('category', $certificate->category) == 'technical' ? 'selected' : '' }}>Teknik Belge (Technical)</option>
                                </select>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 2. Doküman İkonu -->
                            <div class="col-md-6 mb-3">
                                <label for="icon" class="form-label">İkon Sınıfı <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid {{ old('icon', $certificate->icon) }}"></i></span>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $certificate->icon) }}" placeholder="Örn: fa-file-pdf" required>
                                </div>
                                <div class="form-text text-secondary">FontAwesome 6 sınıfları kullanın (Örn: fa-file-pdf, fa-certificate, fa-file-contract)</div>
                                @error('icon')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 3. Başlık -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Başlık <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $certificate->title) }}" placeholder="Örn: ISO 9001 Certificate" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 4. Tür / Alt Etiket -->
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Doküman Türü / Etiket</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $certificate->type) }}" placeholder="Örn: Test Report veya Quality Assurance">
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 5. Açıklama -->
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Kısa Açıklama</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Doküman hakkında kısa bir açıklama girin...">{{ old('description', $certificate->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="card-title mb-4">Dosya ve Genel Ayarlar</h6>

                        <div class="row">
                            <!-- 1. Sütun: PDF / Dosya Yükleme -->
                            <div class="col-md-6 mb-3">
                                <label for="file" class="form-label text-primary fw-bold">Belge/PDF Güncelle</label>

                                @if($certificate->path)
                                    <div class="mb-2">
                                        <a href="{{ asset($certificate->path) }}" target="_blank" class="btn btn-sm btn-outline-info d-inline-flex align-items-center">
                                            <i data-lucide="external-link" class="icon-sm me-1"></i> Mevcut Dosyayı Görüntüle
                                        </a>
                                    </div>
                                @endif

                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf,.doc,.docx">
                                <div class="form-text text-secondary">Yeni bir dosya seçmezseniz mevcut dosya korunur.</div>
                                @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 2. Sütun: Sıralama -->
                            <div class="col-md-3 mb-3">
                                <label for="order" class="form-label">Sıralama (Order)</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $certificate->order) }}" min="0">
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 3. Sütun: Durum -->
                            <div class="col-md-3 mb-4">
                                <label for="status" class="form-label">Durum</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1" {{ old('status', $certificate->status) == '1' ? 'selected' : '' }}>Aktif (Yayında)</option>
                                    <option value="0" {{ old('status', $certificate->status) == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Butonlar -->
                        <div class="d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm">
                                <i data-lucide="save" class="icon-sm me-2"></i> Değişiklikleri Kaydet
                            </button>
                            <a href="{{ route('admin.resources.certificates.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                                İptal Et
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
