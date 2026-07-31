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
                        <a href="about-us.html" class="nav-link" data-key="menu_about">ABOUT US</a>
                    </li>
                    <li>
                        <a href="contact.html" class="nav-link" data-key="menu_contact">CONTACT</a>
                    </li>
                    <li>
                    </li>
                </ul>
            </nav>

            <div class="nav-actions">
                <div class="lang-switch">
                    @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
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
