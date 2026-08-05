<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            Admin<span>Panel</span>
        </a>
        <div class="sidebar-toggler">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav" id="sidebarNav">

            <!-- ANA MENÜ -->
            <li class="nav-item nav-category">Ana Menü</li>

            <li class="nav-item {{ request()->routeIs('admin.dashboard') || request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-lucide="layout-dashboard"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <!-- İÇERİK YÖNETİMİ -->
            <li class="nav-item nav-category">İçerik Yönetimi</li>

            <!-- Slider Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                <a href="{{ route('admin.slider.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="image"></i>
                    <span class="link-title">Slider Yönetimi</span>
                </a>
            </li>

            <!-- Kapı Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.door.*') ? 'active' : '' }}">
                <a href="{{ route('admin.door.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">Kapı Yönetimi</span>
                </a>
            </li>

            <!-- Sertifika Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.resources.certificates.*') ? 'active' : '' }}">
                <a href="{{ route('admin.resources.certificates.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="award"></i>
                    <span class="link-title">Sertifika Yönetimi</span>
                </a>
            </li>

            <!-- Galeri Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.resources.gallery.*') ? 'active' : '' }}">
                <a href="{{ route('admin.resources.gallery.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="images"></i>
                    <span class="link-title">Galeri Yönetimi</span>
                </a>
            </li>

            <!-- SAYFA YÖNETİMİ -->
            <li class="nav-item nav-category">Sayfa Yönetimi</li>

            <!-- Anasayfa Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.manage-homepage') ? 'active' : '' }}">
                <a href="{{ route('admin.manage-homepage') }}" class="nav-link">
                    <i class="link-icon" data-lucide="home"></i>
                    <span class="link-title">Anasayfa</span>
                </a>
            </li>

            <!-- Why WPC Door Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.pages.why-wpc-door') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.why-wpc-door') }}" class="nav-link">
                    <i class="link-icon" data-lucide="help-circle"></i>
                    <span class="link-title">Why WPC Door</span>
                </a>
            </li>

            <!-- About Us Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.pages.about-us') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.about-us') }}" class="nav-link">
                    <i class="link-icon" data-lucide="info"></i>
                    <span class="link-title">About Us</span>
                </a>
            </li>

            <!-- Contact Us Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.pages.contact-us') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.contact-us') }}" class="nav-link">
                    <i class="link-icon" data-lucide="mail"></i>
                    <span class="link-title">Contact Us</span>
                </a>
            </li>

            <!-- RESOURCE PAGES (Açılır Menü) -->
            @php
                $isResourceSubActive = request()->routeIs([
                    'admin.resources.installation-page',
                    'admin.resources.fire-resistence-test-page',
                    'admin.resources.warranty-page',
                    'admin.resources.technicalCertificatesPage',
                    'admin.resources.galleryPage',
                    'admin.resources.catalog-page'
                ]);
            @endphp
            <li class="nav-item {{ $isResourceSubActive ? 'active' : '' }}">
                <a class="nav-link {{ $isResourceSubActive ? '' : 'collapsed' }}"
                   data-bs-toggle="collapse"
                   href="#resourcePages"
                   role="button"
                   aria-expanded="{{ $isResourceSubActive ? 'true' : 'false' }}"
                   aria-controls="resourcePages">
                    <i class="link-icon" data-lucide="feather"></i>
                    <span class="link-title">Resource Pages</span>
                    <i class="link-arrow" data-lucide="chevron-down"></i>
                </a>
                <div class="collapse {{ $isResourceSubActive ? 'show' : '' }}" data-bs-parent="#sidebarNav"
                     id="resourcePages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.installation-page') }}"
                               class="nav-link {{ request()->routeIs('admin.resources.installation-page') ? 'active' : '' }}">Installation
                                Page</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.fire-resistence-test-page') }}"
                               class="nav-link {{ request()->routeIs('admin.resources.fire-resistence-test-page') ? 'active' : '' }}">Fire
                                Resistence Page</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.warranty-page') }}"
                               class="nav-link {{ request()->routeIs('admin.resources.warranty-page') ? 'active' : '' }}">Warranty
                                Page</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.technicalCertificatesPage') }}"
                               class="nav-link {{ request()->routeIs('admin.resources.technicalCertificatesPage') ? 'active' : '' }}">Technical
                                Certificates</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.galleryPage') }}"
                               class="nav-link {{ request()->routeIs('admin.resources.galleryPage') ? 'active' : '' }}">Galeri
                                Sayfası</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.catalog-page') }}"
                               class="nav-link {{ request()->routeIs('admin.resources.catalog-page') ? 'active' : '' }}">Dijital
                                Katalog</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- İLETİŞİM / MESAJLAR -->
            <li class="nav-item nav-category">İletişim</li>

            <li class="nav-item {{ request()->routeIs('admin.contact-message.*') ? 'active' : '' }}">
                <a href="{{ route('admin.contact-message.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="message-square"></i>
                    <span class="link-title">Contact Messages</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.email-subscriber.*') ? 'active' : '' }}">
                <a href="{{ route('admin.email-subscriber.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="message-square"></i>
                    <span class="link-title">E-mail Aboneleri</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">
                <a href="{{ route('admin.newsletter.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="message-square"></i>
                    <span class="link-title">Bültenler</span>
                </a>
            </li>

            <!-- SİSTEM & AYARLAR -->
            <li class="nav-item nav-category">Sistem</li>

            <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                    <i class="link-icon" data-lucide="settings"></i>
                    <span class="link-title">Genel Ayarlar</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('log-viewer') }}" class="nav-link" target="_blank">
                    <i class="link-icon" data-lucide="terminal"></i>
                    <span class="link-title">Log Viewer</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
