<footer>
    <div class="footer-newsletter">
        <div class="container">
            <div class="newsletter-wrapper">
                <div class="newsletter-text">
                    <h3>{{__('footer.newsletter-form.title')}}</h3>
                    <p>{{__('footer.newsletter-form.description')}}</p>
                </div>
                <form class="newsletter-form" id="email_subscription_form" action="{{route('newsletter.subscribe')}}"
                      data-success-title="{{ __('messages.newsletter-form.success_title') }}"
                      data-success-text="{{ __('messages.newsletter-form.success_text') }}"
                      data-error-title="{{ __('messages.newsletter-form.error_title') }}"
                      data-btn-ok="{{ __('messages.newsletter-form.btn_ok') }}"
                      data-btn-close="{{ __('messages.newsletter-form.btn_close') }}">

                    <div class="input-group">
                        <input type="email" name="email" placeholder="{{__('footer.newsletter-form.placeholder')}}" required/>
                        <button type="submit">{{__('footer.newsletter-form.btn-text')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="footer-top">
            <div class="footer-brand-col">
                <a href="{{route('home')}}" class="footer-logo">
                    <img
                        src="{{ asset($settings->logo) }}"
                        alt="ERDOOR"
                        class="img-fluid"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                    />
                    <span class="text-logo-fallback" style="display: none">ERDOOR</span>
                </a>
                <p>
                    {{$settings->footer_content}}
                </p>
                <div class="footer-group-affiliation">
                    <img src="{{ asset('front/assets/logo/ergunbas.png') }}" alt="Ergunbas Group"/>
                    <p>Erdoor is a proud part of Ergunbas Group.</p>
                </div>
                <div class="social-links">
                    <a href="{{$settings->facebook}}" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$settings->twitter}}" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{$settings->instagram}}" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{$settings->linkedin}}" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="{{$settings->youtube}}" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>PRODUCTS</h4>
                <ul>
                    <li><a href="{{route('home')}}#products">{{__('footer.interior-doors')}}</a></li>

                    @foreach($products as $product)
                        <li><a href="{{route('door-single', $product->slug)}}">{{$product->name}}</a></li>
                    @endforeach

                </ul>
            </div>

            <div class="footer-col">
                <h4>RESOURCES</h4>
                <ul>
                    @foreach($resources as $resource)
                        <li><a href="{{route('resources.single', $resource->slug)}}">{{$resource->title}}</a></li>
                    @endforeach

                </ul>
            </div>

            <div class="footer-col">
                <h4>COMPANY</h4>
                <ul>
                    <li><a href="{{route('about')}}">About Erdoor</a></li>
                    <li><a href="{{route('why-wpc-doors')}}">Why WPC Door</a></li>
                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>{{$settings->footer_copyright}}</p>
            <div class="footer-legal">
                <span>{{$settings->footer_address}}</span>
            </div>
        </div>
    </div>
</footer>


