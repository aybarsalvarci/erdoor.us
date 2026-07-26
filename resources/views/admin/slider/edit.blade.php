@extends('admin.layouts.master')

@section('title', 'Slider Düzenle')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Slider Düzenle</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            {{-- Geri dön butonu --}}
            <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Slider Bilgilerini Güncelleyiniz</h6>

                    <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <x-media-picker name="media_id" label="Slider Görseli Seç" :multiple="false" :value="$slider->media_id" />
                                <div class="form-text text-secondary">Tercih edilen boyut: 1920x800px. Sadece JPG, PNG veya WEBP.</div>
                                @error('media_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- URL Alanı -->
                            <div class="col-md-6 mb-3">
                                <label for="url" class="form-label">Bağlantı (URL)</label>
                                <input type="text"
                                       class="form-control @error('url') is-invalid @enderror"
                                       id="url"
                                       name="url"
                                       placeholder="Örn: /kampanyalar/yaz-indirimi"
                                       value="{{ old('url', $slider->url) }}">
                                @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Sıra (Order) Alanı -->
                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label">Sıralama (Order)</label>
                                <input type="number"
                                       class="form-control @error('order') is-invalid @enderror"
                                       id="order"
                                       name="order"
                                       placeholder="Örn: 1"
                                       value="{{ old('order', $slider->order) }}">
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Durum Alanı -->
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">Durum</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                    <option value="1" {{ old('status', $slider->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $slider->status) == '0' ? 'selected' : '' }}>Pasif</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Butonlar -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm">
                                <i data-lucide="save" class="icon-sm me-2"></i> Güncelle
                            </button>
                            <button type="reset" class="btn btn-outline-secondary d-flex align-items-center">
                                <i data-lucide="rotate-ccw" class="icon-sm me-2"></i> Değişiklikleri Geri Al
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@push('js')
@endpush
