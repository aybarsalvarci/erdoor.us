<header id="main-header">
    <div class="container">
        <div class="nav-wrapper">
            <a href="index.html" class="logo">
                <img
                    src="{{ asset('front/assets/logo/logo_erdoor.png') }}"
                    alt="ERDOOR"
                    class="img-fluid"
                    onerror="this.style.display='none'; document.getElementById('text-logo').style.display='block';"
                />
                <span id="text-logo" style="display: none">ERDOOR</span>
            </a>

            <nav class="main-nav">
                <ul class="nav-links">
                    <li>
                        <a href="{{route('home')}}#products" class="nav-link" data-key="menu_products">PRODUCTS</a>
                    </li>
                    <li>
                        <a href="{{route('why-wpc-doors')}}" class="nav-link">WHY WPC DOOR</a>
                    </li>
                    <li>
                        <a href="{{route('resources')}}" class="nav-link" data-key="menu_resource">RESOURCE</a>
                    </li>
                    <li>
                        <a href="{{route('about')}}" class="nav-link" data-key="menu_about">ABOUT US</a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}" class="nav-link" data-key="menu_contact">CONTACT</a>
                    </li>
                    <li>
                    </li>
                </ul>
            </nav>

            <div class="nav-actions">
                <div class="lang-switch">
                    @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        @php
                            $url = '';
                            $targetSlug = null;

                            // 1. Model'den (Eğer sayfada varsa) HEDEF DİLİN slug'ını nokta atışı çekiyoruz
                            if (isset($page) && method_exists($page, 'translations')) {
                                $trans = $page->translations->where('locale', $localeCode)->first();
                                $targetSlug = $trans ? $trans->slug : ($page->slug ?? null);
                            } elseif (isset($door) && method_exists($door, 'translations')) {
                                $trans = $door->translations->where('locale', $localeCode)->first();
                                $targetSlug = $trans ? $trans->slug : ($door->slug ?? null);
                            }

                            // 2. Mevcut Rotayı al
                            $currentRoute = request()->route();
                            $routeName = $currentRoute ? $currentRoute->getName() : null;

                            // 3. Rota dil dosyasında (routes.php) çevrilmiş mi?
                            if ($routeName && \Illuminate\Support\Facades\Lang::has('routes.' . $routeName, $localeCode)) {

                                // Rota yapısını alıyoruz. Örn: "recursos/{slug}"
                                $routePath = trans('routes.' . $routeName, [], $localeCode);

                                // Güvenlik: Dizi gelirse ilk elemanı al
                                if (is_array($routePath)) {
                                    $routePath = reset($routePath);
                                }
                                $routePath = (string) $routePath;

                                // Rotadaki {slug}, {door} vb. parametreleri bulup hedef slug ile değiştiriyoruz
                                if ($targetSlug) {
                                    // Süslü parantez içindeki her şeyi (Örn: {slug}) bul ve hedef slug ile ez
                                    $routePath = preg_replace('/\{[^\}]+\}/', (string)$targetSlug, $routePath);
                                } else {
                                    // Model olmayan ama parametreli bir sayfadaysak ilk parametreyi string'e çevirip ekle
                                    $routeParams = $currentRoute->parameters();
                                    if (count($routeParams) > 0) {
                                        $firstParam = reset($routeParams);
                                        $paramVal = is_object($firstParam) && isset($firstParam->slug)
                                            ? $firstParam->slug
                                            : (is_array($firstParam) ? reset($firstParam) : $firstParam);

                                        $routePath = preg_replace('/\{[^\}]+\}/', (string)$paramVal, $routePath);
                                    }
                                }

                                // Kendi URL'imizi sıfırdan, en temiz şekilde birleştiriyoruz
                                $url = url($localeCode . '/' . ltrim($routePath, '/'));

                            } else {
                                // 4. Standart Sayfalar (Anasayfa, İletişim, Hakkımızda vb. - Parametresiz rotalar)
                                $cleanParams = [];
                                if ($currentRoute) {
                                    foreach ($currentRoute->parameters() as $key => $val) {
                                        $cleanParams[$key] = is_object($val) && isset($val->slug)
                                            ? (string)$val->slug
                                            : (is_array($val) ? reset($val) : (string)$val);
                                    }
                                }

                                // Orijinal paketin varsayılan URL oluşturucusunu sadece güvenli temizlenmiş dizilerle kullan
                                $url = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, $cleanParams, true);
                            }
                        @endphp

                        <a rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ $url }}"
                           class="lang-btn {{ app()->getLocale() == $localeCode ? 'active' : '' }}"
                           data-lang="{{ $localeCode }}">

                            @if($localeCode == 'en')
                                <img src="{{ asset('front/assets/flags/usa.png') }}" alt="EN" class="flag-icon"/>
                            @elseif($localeCode == 'es')
                                <img src="{{ asset('front/assets/flags/spain.jpg') }}" alt="ESP" class="flag-icon"/>
                            @endif

                        </a>

                        @if(!$loop->last)
                            <span class="divider"></span>
                        @endif
                    @endforeach
                </div>

                <button class="mobile-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>
