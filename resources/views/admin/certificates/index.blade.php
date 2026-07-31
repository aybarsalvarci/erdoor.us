@extends('admin.layouts.master')

@section('title', 'Sertifika ve Doküman Listesi')

@push('css')
    <!-- İkon önizlemeleri için FontAwesome (Eğer admin layout'ta yoksa ekleyin) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Sertifika ve Doküman Listesi</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('admin.resources.certificates.create') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="plus"></i>
                Yeni Doküman Ekle
            </a>
        </div>
    </div>

    <!-- FİLTRE KARTI BAŞLANGIÇ -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <i data-lucide="sliders" class="icon-md text-primary me-2"></i>
                        <h6 class="card-title mb-0">Filtreleme Seçenekleri</h6>
                    </div>

                    <form action="{{ route('admin.resources.certificates.index') }}" method="GET">
                        <div class="row g-3">
                            <!-- Arama Alanı -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Arama" value="{{ request('search') }}">
                                    <label for="search" class="text-secondary">Doküman Başlığı ara...</label>
                                </div>
                            </div>

                            <!-- Kategori Alanı -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select name="category" id="category" class="form-select" aria-label="Kategori Seçimi">
                                        <option value="">Tüm Kategoriler</option>
                                        <option value="certificate" {{ request('category') == 'certificate' ? 'selected' : '' }}>Sertifikalar (Certificates)</option>
                                        <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Teknik Belgeler (Technical)</option>
                                    </select>
                                    <label for="category" class="text-secondary">Kategori</label>
                                </div>
                            </div>

                            <!-- Durum Alanı -->
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select name="status" id="status" class="form-select" aria-label="Durum Seçimi">
                                        <option value="">Tüm Durumlar</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pasif</option>
                                    </select>
                                    <label for="status" class="text-secondary">Durum</label>
                                </div>
                            </div>

                            <!-- Sayfalama (Limit) Seçimi -->
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select name="per_page" id="per_page" class="form-select" aria-label="Sayfa Başına Kayıt">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                    <label for="per_page" class="text-secondary">Gösterim</label>
                                </div>
                            </div>

                            <!-- Butonlar -->
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill h-100 d-flex align-items-center justify-content-center fw-bold shadow-sm" title="Ara">
                                    <i data-lucide="search" class="icon-sm"></i>
                                </button>
                                <a href="{{ route('admin.resources.certificates.index') }}" class="btn btn-outline-secondary flex-fill h-100 d-flex align-items-center justify-content-center transition-all" title="Temizle">
                                    <i data-lucide="rotate-ccw" class="icon-sm"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FİLTRE KARTI BİTİŞ -->

    <!-- TABLO KARTI BAŞLANGIÇ -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Mevcut Dokümanlar</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0 text-center">İkon</th>
                                <th class="pt-0">Başlık & Etiket</th>
                                <th class="pt-0">Kategori</th>
                                <th class="pt-0">Durum</th>
                                <th class="pt-0 text-end">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($certificates as $certificate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- İkon Alanı -->
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded p-2" style="width: 45px; height: 45px;">
                                            <i class="fa-solid {{ $certificate->icon }} fa-lg text-secondary"></i>
                                        </div>
                                    </td>

                                    <!-- Başlık ve Tür -->
                                    <td>
                                        <p class="mb-1 fw-bold text-dark">{{ $certificate->title }}</p>
                                        <small class="text-muted">{{ $certificate->type ?? 'Tür belirtilmemiş' }}</small>
                                    </td>

                                    <!-- Kategori -->
                                    <td>
                                        @if($certificate->category == 'certificate')
                                            <span class="badge bg-info text-dark">Sertifika</span>
                                        @elseif($certificate->category == 'technical')
                                            <span class="badge bg-secondary">Teknik Doküman</span>
                                        @else
                                            <span class="badge bg-light text-dark">{{ $certificate->category }}</span>
                                        @endif
                                    </td>

                                    <!-- Durum -->
                                    <td>
                                        @if($certificate->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-warning">Pasif</span>
                                        @endif
                                    </td>

                                    <!-- İşlemler -->
                                    <td class="text-end">
                                        <!-- Dosyayı Görüntüle Butonu -->
                                        @if($certificate->path)
                                            <a href="{{ asset($certificate->path) }}" target="_blank" class="btn btn-sm btn-success btn-icon" title="Dosyayı Görüntüle">
                                                <i data-lucide="external-link"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('admin.resources.certificates.edit', $certificate->id) }}" class="btn btn-sm btn-info btn-icon" title="Düzenle">
                                            <i data-lucide="edit-2"></i>
                                        </a>

                                        <form action="{{ route('admin.resources.certificates.destroy', $certificate->id) }}" method="POST" class="d-inline-block delete-form">
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
                                    <td colspan="6" class="text-center py-4 text-muted">Henüz hiç sertifika veya doküman eklenmemiş.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- SAYFALAMA (PAGINATION) BAŞLANGIÇ -->
                    @if($certificates->hasPages())
                        <div class="mt-4 float-end">
                            {{ $certificates->appends(request()->query())->links() }}
                        </div>
                    @endif
                    <!-- SAYFALAMA BİTİŞ -->

                </div>
            </div>
        </div>
    </div> <!-- row -->
    <!-- TABLO KARTI BİTİŞ -->
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
                        text: "Bu işlem geri alınamaz ve doküman sistemden silinecektir!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Evet, Sil!',
                        cancelButtonText: 'İptal',
                        buttonsStyling: false,
                        iconColor: '#ef4444',
                        customClass: {
                            popup: 'swal-custom-modal',
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
