@extends('admin.layouts.master')

@section('title', 'Slider Listesi')

@push('css')
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Slider Listesi</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            {{-- route('admin.slider.create') gibi kendi rotanızı buraya ekleyebilirsiniz --}}
            <a href="#" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-lucide="plus"></i>
                Yeni Slider Ekle
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Mevcut Sliderlar</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Görsel</th>
                                <th class="pt-0">Başlık</th>
                                <th class="pt-0">Bağlantı (URL)</th>
                                <th class="pt-0">Durum</th>
                                <th class="pt-0">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- Backend bağlandığında burası bir @foreach($sliders as $slider) döngüsü olacaktır --}}
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="https://placehold.co/120x60" alt="Slider Image" style="width: 120px; height: 60px; border-radius: 4px; object-fit: cover;">
                                </td>
                                <td>Yaz İndirimleri Kampanyası</td>
                                <td>/kampanyalar/yaz-indirimi</td>
                                <td><span class="badge bg-success">Aktif</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info btn-icon" title="Düzenle">
                                        <i data-lucide="edit-2"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Sil" onclick="return confirm('Bu slider\'ı silmek istediğinize emin misiniz?')">
                                            <i data-lucide="trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <img src="https://placehold.co/120x60" alt="Slider Image" style="width: 120px; height: 60px; border-radius: 4px; object-fit: cover;">
                                </td>
                                <td>Yeni Sezon Ürünleri</td>
                                <td>/kategori/yeni-sezon</td>
                                <td><span class="badge bg-warning">Pasif</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info btn-icon" title="Düzenle">
                                        <i data-lucide="edit-2"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Sil" onclick="return confirm('Bu slider\'ı silmek istediğinize emin misiniz?')">
                                            <i data-lucide="trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@push('js')
@endpush
