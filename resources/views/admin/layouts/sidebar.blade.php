<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
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

            <li class="nav-item">
                <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="layout-dashboard"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <!-- İÇERİK YÖNETİMİ -->
            <li class="nav-item nav-category">İçerik Yönetimi</li>

            <!-- Slider Yönetimi -->
            <li class="nav-item {{ request()->is('admin/slider*') ? 'active' : '' }}">
                <a href="{{ route('admin.slider.index') }}"
                   class="nav-link {{ request()->is('admin/slider*') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="image"></i>
                    <span class="link-title">Slider Yönetimi</span>
                </a>
            </li>

            <!-- Kapı Yönetimi -->
            <li class="nav-item {{ request()->is('admin/door*') ? 'active' : '' }}">
                <a href="{{ route('admin.door.index') }}"
                   class="nav-link {{ request()->is('admin/door*') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">Kapı Yönetimi</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.resources.certificates.*') ? 'active' : '' }}">
                <a href="{{ route('admin.resources.certificates.index') }}"
                   class="nav-link {{ request()->routeIs('admin.resources.certificates.*') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="image"></i>
                    <span class="link-title">Sertifika Yönetimi</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.resources.gallery.index') ? 'active' : '' }}">
                <a href="{{ route('admin.resources.gallery.index') }}"
                   class="nav-link {{ request()->routeIs('admin.resources.gallery.*') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="image"></i>
                    <span class="link-title">Galeri Yönetimi</span>
                </a>
            </li>

            <!-- Sayfalar -->

            <li class="nav-item nav-category">Sayfa Yönetimi</li>

            <!-- Anasayfa Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.manage-homepage') ? 'active' : '' }}">
                <a href="{{ route('admin.manage-homepage') }}"
                   class="nav-link {{ request()->routeIs('admin.manage-homepage') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">Anasayfa</span>
                </a>
            </li>

            <!-- Why WPC Door Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.pages.why-wpc-door') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.why-wpc-door') }}"
                   class="nav-link {{ request()->routeIs('admin.pages.why-wpc-door') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">Why WPC Door</span>
                </a>
            </li>

            <!-- About Us Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.pages.about-us') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.about-us') }}"
                   class="nav-link {{ request()->routeIs('admin.pages.about-us') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">About Us</span>
                </a>
            </li>

            <!-- Contact Us Yönetimi -->
            <li class="nav-item {{ request()->routeIs('admin.pages.contact-us') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.contact-us') }}"
                   class="nav-link {{ request()->routeIs('admin.pages.contact-us') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">Contact Us</span>
                </a>
            </li>

            <!-- Resource Pages -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                   aria-controls="uiComponents">
                    <i class="link-icon" data-lucide="feather"></i>
                    <span class="link-title">Resource Pages</span>
                    <i class="link-arrow" data-lucide="chevron-down"></i>
                </a>
                <div class="collapse" data-bs-parent="#sidebarNav" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.resources.installation-page')}}" class="nav-link">Installation Page</a>
                        </li>
                    </ul>

                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.resources.fire-resistence-test-page')}}" class="nav-link">Fire Resistence Page</a>
                        </li>
                    </ul>

                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.resources.warranty-page')}}" class="nav-link">Warranty Page</a>
                        </li>
                    </ul>

                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.resources.technicalCertificatesPage')}}" class="nav-link">Technical Certificates</a>
                        </li>
                    </ul>

                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.resources.galleryPage')}}" class="nav-link">Galeri</a>
                        </li>
                    </ul>

                </div>
            </li>
            <!-- SİSTEM -->
            <li class="nav-item nav-category">İletişim</li>

            <!-- Contact Messages -->
            <li class="nav-item {{ request()->routeIs('admin.contact-message.index') ? 'active' : '' }}">
                <a href="{{ route('admin.contact-message.index') }}"
                   class="nav-link {{ request()->routeIs('admin.contact-message.index') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="door-open"></i>
                    <span class="link-title">Contact Messages</span>
                </a>
            </li>


            <!-- SİSTEM -->
            <li class="nav-item nav-category">Sistem</li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-lucide="settings"></i>
                    <span class="link-title">Ayarlar</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
