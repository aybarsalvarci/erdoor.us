@extends('admin.layouts.master')

@section('title', 'Mesaj Detayı')

@push('css')
    <style>
        /* Mesaj içeriği için özel okuma kutusu tasarımı */
        .message-box {
            border-left: 4px solid #6571ff; /* Temanızın primary rengine göre güncelleyebilirsiniz */
            padding: 1.5rem;
            border-radius: 0.25rem;
            line-height: 1.8;
            font-size: 1rem;
            /* background-color: #f8f9fa; satırı temaya uyum için KALDIRILDI */
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Mesaj Detayı</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <!-- Geri Dön Butonu -->
            <a href="{{ route('admin.contact-message.index') }}" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="arrow-left"></i>
                Listeye Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <!-- BAŞLIK & DURUM BÖLÜMÜ -->
                    <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                        <div>
                            <h5 class="card-title mb-2">{{ $message->full_name }}</h5>
                            <p class="text-muted mb-0">
                                <i data-lucide="calendar" class="icon-sm me-1"></i>
                                Gönderilme Tarihi: {{ $message->created_at ? $message->created_at->format('d.m.Y H:i') : '-' }}
                            </p>
                        </div>
                        <div>
                            @if($message->status === 'unread')
                                <span class="badge bg-warning text-dark fs-6 px-3 py-2">Okunmadı</span>
                            @else
                                <span class="badge bg-success fs-6 px-3 py-2">Okundu</span>
                            @endif
                        </div>
                    </div>

                    <!-- GÖNDEREN BİLGİLERİ -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0 space-y-3">
                                <li class="mb-3 d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center bg-primary-subtle rounded p-2 me-3">
                                        <i data-lucide="mail" class="icon-md text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">E-posta Adresi</small>
                                        <a href="mailto:{{ $message->email }}" class="text-body fw-bold fs-6">{{ $message->email }}</a>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center bg-primary-subtle rounded p-2 me-3">
                                        <i data-lucide="phone" class="icon-md text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">Telefon Numarası</small>
                                        @if($message->phone)
                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $message->phone) }}" class="text-body fw-bold fs-6">{{ $message->phone }}</a>
                                        @else
                                            <span class="text-muted">Belirtilmemiş</span>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center bg-primary-subtle rounded p-2 me-3">
                                        <i data-lucide="briefcase" class="icon-md text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">Rol / Ünvan</small>
                                        <span class="text-body fw-bold fs-6">{{ $message->role }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- MESAJ İÇERİĞİ -->
                    <div class="mt-4">
                        <h6 class="mb-3 d-flex align-items-center fw-bold">
                            <i data-lucide="message-square" class="icon-md text-primary me-2"></i>
                            Mesaj İçeriği
                        </h6>
                        <!--
                          nl2br(e()) kullanımı:
                          e() -> Zararlı HTML kodlarını (XSS) temizler.
                          nl2br() -> Kullanıcının formda bıraktığı satır boşluklarını (<br>) korur.
                        -->
                        <div class="message-box text-body">
                            {!! nl2br(e($message->message)) !!}
                        </div>
                    </div>

                    <!-- İŞLEM BUTONLARI -->
                    <div class="mt-5 pt-3 border-top d-flex gap-3">
                        <a href="mailto:{{ $message->email }}" class="btn btn-primary d-flex align-items-center">
                            <i data-lucide="corner-up-left" class="icon-sm me-2"></i> Yanıtla
                        </a>

                        <form action="{{ route('admin.contact-message.destroy', $message->id) }}" method="POST" class="delete-form d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger d-flex align-items-center">
                                <i data-lucide="trash" class="icon-sm me-2"></i> Mesajı Sil
                            </button>
                        </form>
                    </div>

                </div>
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
