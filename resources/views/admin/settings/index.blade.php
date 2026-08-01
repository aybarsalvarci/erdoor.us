@extends('admin.layouts.master')

@section('title', 'Genel Ayarlar Yönetimi')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Genel Ayarlar Yönetimi</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Kontrol Paneline Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Sistem Genel Ayarlarını Güncelleyiniz</h6>

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- SEKMELER (TABS) -->
                        <ul class="nav nav-tabs nav-tabs-line mb-4" id="settingsTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#general-tab" role="tab">
                                    <i data-lucide="globe" class="icon-sm me-1"></i> Genel & SEO
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#contact-tab" role="tab">
                                    <i data-lucide="phone-call" class="icon-sm me-1"></i> İletişim & E-Posta
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#media-tab" role="tab">
                                    <i data-lucide="image" class="icon-sm me-1"></i> Logo & Favicon
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#social-tab" role="tab">
                                    <i data-lucide="share-2" class="icon-sm me-1"></i> Sosyal Medya & Footer
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- TAB 1: GENEL & SEO -->
                            <div class="tab-pane fade show active" id="general-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="title" class="form-label">Site Başlığı (Title)</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $settings->title ?? '') }}" required>
                                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">Site Açıklaması (Description)</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $settings->description ?? '') }}</textarea>
                                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="keywords" class="form-label">Anahtar Kelimeler (Keywords)</label>
                                        <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywords" name="keywords" value="{{ old('keywords', $settings->keywords ?? '') }}" placeholder="door, wood door, erdoor...">
                                        @error('keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: İLETİŞİM & E-POSTA -->
                            <div class="tab-pane fade" id="contact-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Telefon Numarası</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $settings->phone ?? '') }}">
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="contact_email" class="form-label">İletişim E-Posta</label>
                                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings->contact_email ?? '') }}">
                                        @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="sender_email" class="form-label">Gönderici E-Posta (Sender)</label>
                                        <input type="email" class="form-control @error('sender_email') is-invalid @enderror" id="sender_email" name="sender_email" value="{{ old('sender_email', $settings->sender_email ?? '') }}">
                                        @error('sender_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="notification_email" class="form-label">Bildirim Alınacak E-Posta</label>
                                        <input type="email" class="form-control @error('notification_email') is-invalid @enderror" id="notification_email" name="notification_email" value="{{ old('notification_email', $settings->notification_email ?? '') }}">
                                        @error('notification_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3: LOGO & FAVICON -->
                            <div class="tab-pane fade" id="media-tab" role="tabpanel">
                                <div class="row">
                                    <!-- LOGO YÜKLEME -->
                                    <div class="col-md-6 mb-3">
                                        <label for="logo" class="form-label fw-bold">Site Logosu</label>
                                        @if(!empty($settings->logo))
                                            <div class="mb-2">
                                                <img src="{{ asset($settings->logo) }}" alt="Mevcut Logo" style="max-height: 50px; background: #ddd; padding: 4px; border-radius: 4px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                        <small class="text-muted">Yeni bir dosya seçerseniz mevcut logo değiştirilir. (Önerilen: PNG, SVG)</small>
                                        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- FAVICON YÜKLEME -->
                                    <div class="col-md-6 mb-3">
                                        <label for="favicon" class="form-label fw-bold">Site Favicon</label>
                                        @if(!empty($settings->favicon))
                                            <div class="mb-2">
                                                <img src="{{ asset($settings->favicon) }}" alt="Mevcut Favicon" style="max-height: 32px; background: #ddd; padding: 4px; border-radius: 4px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="favicon" name="favicon" accept="image/*">
                                        <small class="text-muted">Yeni bir dosya seçerseniz mevcut favicon değiştirilir. (Önerilen: ICO, PNG)</small>
                                        @error('favicon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: SOSYAL MEDYA & FOOTER -->
                            <div class="tab-pane fade" id="social-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="footer_content" class="form-label">Footer Hakkında Metni</label>
                                        <textarea class="form-control @error('footer_content') is-invalid @enderror" id="footer_content" name="footer_content" rows="2">{{ old('footer_content', $settings->footer_content ?? '') }}</textarea>
                                        @error('footer_content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="footer_copyright" class="form-label">Footer Telif Metni (Copyright)</label>
                                        <input type="text" class="form-control @error('footer_copyright') is-invalid @enderror" id="footer_copyright" name="footer_copyright" value="{{ old('footer_copyright', $settings->footer_copyright ?? '') }}">
                                        @error('footer_copyright') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="footer_address" class="form-label">Footer Adres Bilgisi</label>
                                        <input type="text" class="form-control @error('footer_address') is-invalid @enderror" id="footer_address" name="footer_address" value="{{ old('footer_address', $settings->footer_address ?? '') }}">
                                        @error('footer_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="facebook" class="form-label">Facebook URL</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $settings->facebook ?? '') }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="twitter" class="form-label">Twitter / X URL</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $settings->twitter ?? '') }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="instagram" class="form-label">Instagram URL</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $settings->instagram ?? '') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="linkedin" class="form-label">LinkedIn URL</label>
                                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin', $settings->linkedin ?? '') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="youtube" class="form-label">YouTube URL</label>
                                        <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube', $settings->youtube ?? '') }}">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Butonlar -->
                        <div class="d-flex gap-2 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm px-4">
                                <i data-lucide="save" class="icon-sm me-2"></i> Ayarları Güncelle
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
