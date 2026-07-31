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
                            $currentRoute = request()->route();
                            $routeName = $currentRoute ? $currentRoute->getName() : null; // Örn: 'resources.single'
                            $routeParams = $currentRoute ? $currentRoute->parameters() : [];
                            $url = '';

                            // 1. Hedef dilin dinamik slug kelimesini alıyoruz (Örn: installation / instalacion)
                            if (isset($page) && count($routeParams) > 0) {
                                $paramKey = array_key_first($routeParams);
                                $routeParams[$paramKey] = $page->translate($localeCode)?->slug ?? $page->slug;
                            }
                            elseif (isset($door) && count($routeParams) > 0) {
                                $paramKey = array_key_first($routeParams);
                                $routeParams[$paramKey] = $door->translate($localeCode)?->slug ?? $door->slug;
                            }

                            // 2. URL'yi doğru fonksiyonla oluşturuyoruz
                            // Eğer sayfanın name() değeri varsa ve routes.php dil dosyasında karşılığı varsa:
                            if ($routeName && \Illuminate\Support\Facades\Lang::has('routes.' . $routeName, $localeCode)) {

                                // Hem klasör adını (resources/recursos) hem slug'ı çevirir
                                $url = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getURLFromRouteNameTranslated(
                                    $localeCode,
                                    'routes.' . $routeName,
                                    $routeParams
                                );

                            } else {
                                // Rota çevirisi olmayan normal bir sayfaysa (fallback)
                                $url = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, $routeParams, true);
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
