@extends('admin.layouts.master')

@section('title', 'Bülten Listesi')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Bülten Listesi</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.newsletter.create')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="plus"></i>
                Yeni Bülten Ekle
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

                    <form action="{{route('admin.newsletter.index')}}" method="GET">
                        <div class="row g-3">
                            <!-- Arama Alanı -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Arama" value="{{ request('search') }}">
                                    <label for="search" class="text-secondary">Bülten başlığı ara...</label>
                                </div>
                            </div>

                            <!-- Durum Alanı -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select name="status" id="status" class="form-select" aria-label="Durum Seçimi">
                                        <option value="">Tüm Durumlar</option>
                                        <!-- Taslak/Gönderildi olarak da değiştirebilirsiniz -->
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif (Yayında)</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pasif (Taslak)</option>
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
                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill h-100 d-flex align-items-center justify-content-center fw-bold shadow-sm">
                                    <i data-lucide="search" class="icon-sm me-2"></i> Ara
                                </button>
                                <a href="{{route('admin.newsletter.index')}}" class="btn btn-outline-secondary flex-fill h-100 d-flex align-items-center justify-content-center transition-all">
                                    <i data-lucide="rotate-ccw" class="icon-sm me-2"></i> Temizle
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
                    <h6 class="card-title mb-4">Mevcut Bültenler</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Bülten Başlığı</th>
                                <th class="pt-0">Buton Metni</th>
                                <th class="pt-0">Gönderim Tarihi</th>
                                <th class="pt-0">Durum</th>
                                <th class="pt-0">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($newsletters as $newsletter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-bold text-body text-truncate d-inline-block" style="max-width: 250px;" title="{{ $newsletter->title }}">
                                            {{ $newsletter->title }}
                                        </span>
                                    </td>
                                    <td>{{ $newsletter->button_text ?? '-' }}</td>
                                    <td>
                                        {{ $newsletter->send_at ? \Carbon\Carbon::parse($newsletter->send_at)->format('d.m.Y H:i') : 'Hemen Gönder' }}
                                    </td>
                                    <td>
                                        @if($newsletter->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-warning">Taslak / Pasif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- İsteğe bağlı olarak bülten loglarını (istatistiklerini) görmek için bir buton eklenebilir -->
                                        <a href="{{route('admin.newsletter.edit', $newsletter->id)}}" class="btn btn-sm btn-info btn-icon" title="Düzenle">
                                            <i data-lucide="edit-2"></i>
                                        </a>
                                        <form action="{{route('admin.newsletter.destroy', $newsletter->id)}}" method="POST" class="d-inline-block delete-form">
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
                                    <td colspan="6" class="text-center py-4">Kayıt bulunamadı.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- SAYFALAMA (PAGINATION) BAŞLANGIÇ -->
                    @if($newsletters->hasPages())
                        <div class="mt-4 float-end">
                            {{ $newsletters->appends(request()->query())->links() }}
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
                        text: "Bu işlem geri alınamaz ve bülten kalıcı olarak silinecektir!",
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
