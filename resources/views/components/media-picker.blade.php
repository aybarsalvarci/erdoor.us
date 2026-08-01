@props([
    'name' => 'image',
    'label' => 'Görsel Seç',
    'value' => '',
    'multiple' => false,
    'hideTrigger' => false,
    'returnType' => 'id'
])

@php
    $uniqueId = Str::random(8);
    $modalId = 'mediaModal-' . $uniqueId;
    $inputId = 'mediaInput-' . $uniqueId;
    $inputValue = is_array($value) ? implode(',', $value) : $value;
    $preloadedMedia = [];

    if (!empty($inputValue)) {
        $items = array_filter(explode(',', $inputValue));

        $ids = array_filter($items, 'is_numeric');
        $paths = array_filter($items, function($val) { return !is_numeric($val); });

        if (class_exists(\App\Models\Media::class) && (count($ids) > 0 || count($paths) > 0)) {
            $query = \App\Models\Media::query();

            if (count($ids) > 0) {
                $query->orWhereIn('id', $ids);
            }

            if (count($paths) > 0) {
                $query->orWhereIn('path', $paths);
            }

            $preloadedMedia = $query->get()->map(function($m) {
                return [
                    'id'         => $m->id,
                    'path'       => $m->path,
                    'url'        => $m->url,
                    'type'       => $m->type,
                    'alt_text'   => $m->alt_text,
                    'created_at' => $m->created_at,
                ];
            })->toArray();
        }
    }
@endphp

<style>
    [x-cloak] { display: none !important; }
    .media-modal-backdrop {
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(0, 0, 0, 0.75); z-index: 999999 !important;
        backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center;
    }
    .selected-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(101, 113, 255, 0.2); display: flex; align-items: center; justify-content: center;
    }
    .gallery-preview-container {
        display: flex; flex-wrap: wrap; gap: 12px; padding: 12px;
        background-color: rgba(0, 0, 0, 0.15); border: 1px dashed rgba(150, 150, 150, 0.3);
        border-radius: 8px; margin-bottom: 12px;
    }
    .gallery-preview-item {
        width: 100px; height: 100px; border-radius: 8px; overflow: hidden;
        position: relative; border: 1px solid rgba(150, 150, 150, 0.3);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); transition: transform 0.2s ease;
        background-color: rgba(0, 0, 0, 0.2);
    }
    .gallery-preview-item:hover { transform: scale(1.05); z-index: 2; }
    .gallery-preview-item img { width: 100%; height: 100%; object-fit: cover; }
    .remove-btn {
        position: absolute; top: 4px; right: 4px; width: 24px; height: 24px;
        background: rgba(255, 51, 102, 0.9); color: white; border: none;
        border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;
    }
    .upload-overlay-box {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.85); z-index: 20;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
</style>

<!-- Kapsayıcı: JSON verisini data-preloaded ile güvenle taşıyoruz -->
<div id="media-picker-wrapper-{{ $uniqueId }}"
     data-preloaded="{{ json_encode($preloadedMedia) }}"
     x-data="mediaPicker('{{ $inputValue }}', '{{ $name }}', {{ $multiple ? 'true' : 'false' }}, '{{ $returnType }}', 'media-picker-wrapper-{{ $uniqueId }}')"
     @open-tinymce-media.window="if($event.detail.target === '{{ $name }}') openModal(true)"
     class="{{ $hideTrigger ? '' : 'mb-3' }}"
     x-cloak>

    <!-- TETİKLEYİCİ ALAN -->
    @if(!$hideTrigger)
        <template x-if="!isTinyMceMode">
            <div>
                <label class="form-label font-weight-bold text-muted mb-2">{{ $label }}</label>
                <div class="p-3 rounded border border-secondary bg-transparent">

                    <div class="gallery-preview-container">
                        <template x-for="(item, index) in selectedItems" :key="index">
                            <div class="gallery-preview-item">
                                <img :src="item.resolved_url" alt="Önizleme">
                                <input type="hidden" :name="isMultiple ? name + '[]' : name"
                                       :value="returnType === 'url' ? item.path : item.id">
                                <button type="button" @click="removeItem(index)" class="remove-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <template x-if="selectedItems.length === 0">
                            <div class="gallery-preview-item d-flex align-items-center justify-content-center" style="border: 1px dashed rgba(150,150,150,0.5);">
                                <i class="text-muted" data-feather="image" style="width: 32px; height: 32px;"></i>
                            </div>
                        </template>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" @click="openModal(false)" class="btn btn-primary btn-sm fw-bold px-3">
                            <i class="me-1" data-feather="upload-cloud" style="width: 16px; height: 16px;"></i>
                            <span x-text="isMultiple ? 'Galeriye Görsel Seç' : 'Medya Seç'"></span>
                        </button>
                        <button type="button" x-show="selectedItems.length > 0" @click="selectedItems = []" class="btn btn-outline-danger btn-sm px-3">
                            Tümünü Temizle
                        </button>
                    </div>
                </div>
            </div>
        </template>
    @endif

    <!-- MODAL -->
    <template x-if="isOpen">
        <div class="media-modal-backdrop">
            <!-- Modal Kapsayıcı -->
            <div class="card shadow-lg w-100 mx-3 border-secondary" style="background-color: var(--card-bg, #0c1427); max-width: 1000px; height: 85vh;">

                <!-- Modal Başlık -->
                <div class="card-header d-flex justify-content-between align-items-center border-bottom border-secondary" style="background-color: rgba(0,0,0,0.15);">
                    <h5 class="card-title mb-0 text-primary fw-bold">Ortam Kütüphanesi <span x-show="isMultiple && !isTinyMceMode" class="text-muted small ms-2">(Çoklu Seçim)</span></h5>
                    <button type="button" @click="closeModal()" class="btn-close btn-close-white text-reset"></button>
                </div>

                <!-- SEKMELER (Tab Navigation) -->
                <div class="px-3 pt-2 border-bottom border-secondary" style="background-color: rgba(0,0,0,0.1);">
                    <ul class="nav nav-tabs border-0" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link text-body" :class="{ 'active fw-bold': activeTab === 'library' }" @click="activeTab = 'library'" type="button" style="background-color: transparent;">Ortam Kütüphanesi</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-body" :class="{ 'active fw-bold': activeTab === 'upload' }" @click="activeTab = 'upload'" type="button" style="background-color: transparent;">Bilgisayardan Yükle</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-body" :class="{ 'active fw-bold': activeTab === 'url' }" @click="activeTab = 'url'" type="button" style="background-color: transparent;">URL'den Ekle</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body d-flex p-0 overflow-hidden" style="min-height: 0;">

                    <!-- SOL ALAN (SEKME İÇERİKLERİ) -->
                    <div class="flex-grow-1 position-relative border-end border-secondary" style="height: 100%; overflow: hidden;">

                        <!-- YÜKLEME OVERLAY (Katman) -->
                        <div x-show="isUploading" class="upload-overlay-box">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <span class="text-white small fw-bold">Görsel İşleniyor...</span>
                        </div>

                        <!-- 1. KÜTÜPHANE SEKMESİ -->
                        <div :class="activeTab === 'library' ? 'd-flex' : 'd-none'" class="h-100 flex-column p-3 overflow-y-auto">
                            <div class="row row-cols-3 row-cols-md-4 row-cols-lg-5 g-2 flex-grow-1 align-content-start">
                                <template x-for="item in items" :key="item.id">
                                    <div class="col">
                                        <div @click="toggleSelection(item)" :class="checkIfSelected(item) ? 'border-primary border-2 shadow' : 'border-secondary border'" class="card h-100 cursor-pointer position-relative overflow-hidden select-none bg-transparent">
                                            <img :src="item.resolved_url" class="card-img-top object-fit-cover w-100 h-100" style="aspect-ratio: 1/1;" :alt="item.alt_text">

                                            <div x-show="checkIfSelected(item)" class="selected-overlay">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                                    <i data-feather="check" class="text-white" style="width: 14px; height: 14px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <template x-if="nextPageUrl">
                                <div class="text-center mt-4 mb-2">
                                    <button type="button" @click="loadMore()" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                        <span x-show="!isLoading">Daha Fazla Yükle</span>
                                        <span x-show="isLoading" class="spinner-border spinner-border-sm" role="status"></span>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <!-- 2. BİLGİSAYARDAN YÜKLE SEKMESİ -->
                        <div :class="activeTab === 'upload' ? 'd-flex' : 'd-none'" class="h-100 flex-column align-items-center justify-content-center p-4">
                            <div class="border border-2 border-dashed border-secondary rounded p-5 text-center w-75 bg-transparent" @dragover.prevent @drop.prevent="handleDrop($event)">
                                <input type="file" @change="uploadFile($event.target.files[0])" class="d-none" id="file_picker_{{ $name }}" accept="image/png, image/jpeg, image/webp, image/gif">
                                <i class="d-block mb-3 text-muted mx-auto" data-feather="upload-cloud" style="width: 48px; height: 48px;"></i>
                                <h6 class="text-body fw-bold mb-2">Görseli buraya sürükleyin</h6>
                                <p class="text-muted small mb-3">veya</p>
                                <label for="file_picker_{{ $name }}" class="cursor-pointer fw-bold btn btn-primary btn-sm mb-4">Bilgisayardan Seç</label>
                                <input type="text" x-model="uploadAltText" placeholder="Yüklemeden Önce SEO Alt Text (Opsiyonel)" class="form-control form-control-sm text-body bg-transparent border-secondary"/>
                            </div>
                        </div>

                        <!-- 3. URL'den EKLE SEKMESİ -->
                        <div :class="activeTab === 'url' ? 'd-flex' : 'd-none'" class="h-100 flex-column align-items-center justify-content-center p-4">
                            <div class="border border-2 border-dashed border-secondary rounded p-5 text-center w-75 bg-transparent">
                                <i class="d-block mb-3 text-muted mx-auto" data-feather="link" style="width: 48px; height: 48px;"></i>
                                <h6 class="text-body fw-bold mb-4">Dış Kaynaktan (URL) Görsel Ekle</h6>
                                <div class="input-group mb-3">
                                    <input type="url" x-model="externalUrl" placeholder="https://ornek.com/gorsel.jpg" class="form-control text-body bg-transparent border-secondary">
                                    <button type="button" @click="uploadFromUrl()" class="btn btn-primary px-4" :disabled="isUploading">Ekle</button>
                                </div>
                                <input type="text" x-model="uploadAltText" placeholder="SEO Alt Text (Opsiyonel)" class="form-control form-control-sm text-body bg-transparent border-secondary"/>
                            </div>
                        </div>

                    </div>

                    <!-- SAĞ ALAN (DETAYLAR & SEÇİM) -->
                    <div class="p-3 d-flex flex-column justify-content-between shrink-0 bg-transparent" style="width: 300px; flex-shrink: 0;">

                        <!-- Tekli Seçim Detayı -->
                        <div x-show="!isMultipleActive() && activeItems.length === 1" class="overflow-y-auto pe-1">
                            <h6 class="text-muted mb-3 font-weight-bold small text-uppercase">Görsel Detayları</h6>

                            <div class="border border-secondary rounded p-2 mb-3 d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.15); height: 160px;">
                                <img :src="activeItems[0]?.resolved_url" class="img-fluid rounded object-fit-contain w-100 h-100" alt="Önizleme">
                            </div>

                            <p class="text-sm text-body fw-bold text-truncate mb-1" x-text="activeItems[0]?.file_name"></p>
                            <p class="text-xs text-muted mb-4" x-text="activeItems[0]?.date"></p>

                            <!-- Otomatik Kayıt (Auto-Save) -->
                            <div class="mb-2">
                                <label class="form-label text-xs text-muted d-flex justify-content-between mb-1">
                                    Alternatif Metin
                                    <span class="text-success" x-show="altSaved" style="font-size: 10px;">Kaydedildi!</span>
                                </label>
                                <textarea class="form-control text-body bg-transparent border-secondary" rows="3" style="font-size: 13px;" x-model="activeItems[0].alt_text" @change="updateAltText(activeItems[0])" placeholder="Görseli betimleyin..."></textarea>
                                <small class="text-muted d-block mt-1" style="font-size: 11px;">Odağı kaybettiğinde otomatik kaydedilir.</small>
                            </div>
                        </div>

                        <!-- Çoklu Seçim Bilgisi -->
                        <div x-show="isMultipleActive() && activeItems.length > 0" class="text-center mt-5">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 70px; height: 70px;">
                                <span class="text-white fs-3 fw-bold" x-text="activeItems.length"></span>
                            </div>
                            <h6 class="text-body fw-bold">Görsel Seçildi</h6>
                        </div>

                        <!-- Boş Durum Bilgisi -->
                        <div x-show="activeItems.length === 0" class="text-muted text-center my-auto">
                            <i data-feather="image" class="mb-2 opacity-50" style="width: 40px; height: 40px;"></i>
                            <p class="text-sm">Lütfen listeden görsel seçin veya yeni yükleyin.</p>
                        </div>

                        <!-- Onay Butonu -->
                        <div class="mt-3 pt-3 border-top border-secondary">
                            <button type="button" @click="confirmSelection()" :disabled="activeItems.length === 0" class="btn btn-success w-100 fw-bold py-2">
                                <span x-text="isMultipleActive() ? 'Seçilenleri Ekle' : 'Seçimi Ekle'"></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </template>
</div>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        if (!Alpine.data('mediaPicker')) {
            Alpine.data('mediaPicker', (initialValue, componentName, isMultipleConfig, returnTypeConfig, wrapperId) => ({
                isOpen: false,
                isTinyMceMode: false,
                isMultiple: isMultipleConfig,
                returnType: returnTypeConfig,
                items: [],
                activeItems: [],
                selectedItems: [],
                name: componentName,

                nextPageUrl: null,
                isLoading: false,
                isUploading: false,
                activeTab: 'library',

                uploadAltText: '',
                externalUrl: '',
                altSaved: false,

                init() {
                    // HTML elementinden JSON verisini güvenle oku
                    const wrapperEl = document.getElementById(wrapperId);
                    let preloadedItems = [];

                    if (wrapperEl) {
                        const rawData = wrapperEl.getAttribute('data-preloaded');
                        if (rawData) {
                            try { preloadedItems = JSON.parse(rawData); } catch(e) {}
                        }
                    }

                    // Eğer önceden seçili görsel varsa direkt ekrana bas
                    if (preloadedItems && preloadedItems.length > 0) {
                        this.selectedItems = preloadedItems.map(i => this.formatMedia(i));
                    }
                    else if (initialValue && isNaN(initialValue) && (initialValue.startsWith('http') || initialValue.startsWith('/'))) {
                        this.selectedItems = [this.formatMedia({ id: initialValue, path: initialValue, type: 'external' })];
                    }

                    setTimeout(() => { if (window.feather) feather.replace(); }, 100);
                },

                formatMedia(media) {
                    const resolved = media.url;

                    const name = media.path ? media.path.split('/').pop() : 'Bilinmiyor';
                    const dateObj = new Date(media.created_at);
                    const dateStr = !isNaN(dateObj) ? dateObj.toLocaleDateString('tr-TR', { day: '2-digit', month: 'short', year: 'numeric' }) : '';

                    return {
                        id: media.id,
                        path: media.path,
                        url: media.url,
                        type: media.type,
                        alt_text: media.alt_text || '',
                        file_name: name,
                        date: dateStr,
                        resolved_url: resolved
                    };
                },

                isMultipleActive() {
                    return this.isMultiple && !this.isTinyMceMode;
                },

                openModal(tinymceMode = false) {
                    this.isTinyMceMode = tinymceMode;
                    this.isOpen = true;
                    this.activeItems = [...this.selectedItems];
                    this.activeTab = 'library';
                    this.fetchMedia();
                },

                closeModal() {
                    this.isOpen = false;
                    this.activeItems = [];
                    if (this.isTinyMceMode) this.isTinyMceMode = false;
                },

                fetchMedia() {
                    this.items = [];
                    this.nextPageUrl = `{{route('admin.media.fetch')}}`;
                    this.loadData();
                },

                loadData() {
                    if (!this.nextPageUrl || this.isLoading) return;
                    this.isLoading = true;

                    fetch(this.nextPageUrl, {
                        headers: {'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest'}
                    })
                        .then(res => res.json())
                        .then(res => {
                            const paginator = res.medias || res;
                            const mediaData = paginator.data || [];
                            const nextUrl = paginator.next_page_url || null;

                            const formattedItems = mediaData.map(i => this.formatMedia(i));

                            this.items.push(...formattedItems);
                            this.nextPageUrl = nextUrl;
                            this.isLoading = false;
                            setTimeout(() => { if (window.feather) feather.replace(); }, 100);
                        });
                },

                loadMore() { this.loadData(); },

                toggleSelection(item) {
                    if (this.isMultipleActive()) {
                        const index = this.activeItems.findIndex(i => i.id === item.id);
                        if (index > -1) {
                            this.activeItems.splice(index, 1);
                        } else {
                            this.activeItems.push(item);
                        }
                    } else {
                        this.activeItems = [item];
                    }
                },

                checkIfSelected(item) {
                    return this.activeItems.findIndex(i => i.id === item.id) > -1;
                },

                removeItem(index) {
                    this.selectedItems.splice(index, 1);
                },

                confirmSelection() {
                    if (this.activeItems.length === 0) return;

                    if (this.isTinyMceMode) {
                        const target = this.activeItems[0];
                        if (window.currentTinyMceCallback && target) {
                            window.currentTinyMceCallback(target.resolved_url, {alt: target.alt_text || ''});
                            window.currentTinyMceCallback = null;
                        }
                    } else {
                        if (this.isMultiple) {
                            this.selectedItems = [...this.activeItems];
                        } else {
                            this.selectedItems = [this.activeItems[0]];
                        }
                    }
                    this.closeModal();
                },

                handleDrop(event) {
                    if (event.dataTransfer.files.length > 0) this.uploadFile(event.dataTransfer.files[0]);
                },

                uploadFile(file) {
                    if (!file || !file.type.startsWith('image/')) return;
                    this.isUploading = true;

                    const formData = new FormData();
                    formData.append('files[]', file);
                    formData.append('alt_text', this.uploadAltText);

                    fetch('{{route('admin.media.store.file')}}', {
                        method: 'POST', body: formData,
                        headers: {'X-CSRF-TOKEN': "{{csrf_token()}}", 'Accept': 'application/json'}
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.uploadAltText = '';
                            this.isUploading = false;
                            this.activeTab = 'library';
                            this.fetchMedia();
                        })
                        .catch(() => {
                            this.isUploading = false;
                            alert('Dosya yüklenirken hata oluştu.');
                        })
                        .finally(() => { document.getElementById('file_picker_{{ $name }}').value = ''; });
                },

                uploadFromUrl() {
                    if (!this.externalUrl) return;
                    this.isUploading = true;

                    fetch('{{route('admin.media.store.url')}}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({image_url: this.externalUrl, alt_text: this.uploadAltText})
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.externalUrl = '';
                            this.uploadAltText = '';
                            this.isUploading = false;
                            this.activeTab = 'library';
                            this.fetchMedia();
                        })
                        .catch(() => {
                            this.isUploading = false;
                            alert('URL eklenirken bir hata oluştu.');
                        });
                },

                updateAltText(item) {
                    if(!item.id) return;

                    fetch('{{route('admin.media.update-alt')}}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({id: item.id, alt_text: item.alt_text})
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.altSaved = true;
                                setTimeout(() => { this.altSaved = false; }, 2000);
                            }
                        });
                }

            }));
        }
    });
</script>
