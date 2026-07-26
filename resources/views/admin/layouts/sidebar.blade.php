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
                <!-- Dashboard rotanızı buraya ekleyebilirsiniz (örn: route('admin.dashboard') ) -->
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
