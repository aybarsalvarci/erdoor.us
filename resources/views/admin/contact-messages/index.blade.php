@extends('admin.layouts.master')

@section('title', 'İletişim Mesajları')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">İletişim Mesajları</h4>
        </div>
        {{-- İletişim mesajı panele eklenmez, bu yüzden 'Yeni Ekle' butonu kaldırıldı. Gerekirse eklenebilir. --}}
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

                    <form action="{{ route('admin.contact-message.index') }}" method="GET">
                        <div class="row g-3">
                            <!-- Arama Alanı -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Arama" value="{{ request('search') }}">
                                    <label for="search" class="text-secondary">İsim, e-posta veya telefon ara...</label>
                                </div>
                            </div>

                            <!-- Durum Alanı -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select name="status" id="status" class="form-select" aria-label="Durum Seçimi">
                                        <option value="">Tüm Mesajlar</option>
                                        <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Okunmadı</option>
                                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Okundu</option>
                                    </select>
                                    <label for="status" class="text-secondary">Okunma Durumu</label>
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
                                <a href="{{ route('admin.contact-message.index') }}" class="btn btn-outline-secondary flex-fill h-100 d-flex align-items-center justify-content-center transition-all">
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
                    <h6 class="card-title mb-4">Gelen Mesajlar</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Gönderen Bilgileri</th>
                                <th class="pt-0">Rol / Ünvan</th>
                                <th class="pt-0">Mesaj Özeti</th>
                                <th class="pt-0">Durum</th>
                                <th class="pt-0">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($messages as $message)
                                <tr class="{{ $message->status === 'unread' ? 'fw-bold bg-light' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-body">{{ $message->full_name }}</span>
                                            <span class="text-muted small" style="font-weight: normal;">
                                                <i data-lucide="mail" class="icon-xs me-1"></i>{{ $message->email }}
                                            </span>
                                            @if($message->phone)
                                                <span class="text-muted small" style="font-weight: normal;">
                                                    <i data-lucide="phone" class="icon-xs me-1"></i>{{ $message->phone }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $message->role }}</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: normal;" title="{{ $message->message }}">
                                            {{ Str::limit($message->message, 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($message->status === 'unread')
                                            <span class="badge bg-warning text-dark">Okunmadı</span>
                                        @else
                                            <span class="badge bg-success">Okundu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Düzenle yerine mesajı "Okuma/Görüntüleme" sayfası rotası -->
                                        <a href="{{ route('admin.contact-message.show', $message->id) }}" class="btn btn-sm btn-primary btn-icon" title="Mesajı Oku">
                                            <i data-lucide="eye"></i>
                                        </a>

                                        <form action="{{ route('admin.contact-message.destroy', $message->id) }}" method="POST" class="d-inline-block delete-form">
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
                                    <td colspan="6" class="text-center py-4 text-muted">Henüz hiç mesaj bulunmuyor.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- SAYFALAMA (PAGINATION) BAŞLANGIÇ -->
                    @if($messages->hasPages())
                        <div class="mt-4 float-end">
                            {{ $messages->appends(request()->query())->links() }}
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
                        text: "Bu işlem geri alınamaz ve mesaj kalıcı olarak silinecektir!",
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
