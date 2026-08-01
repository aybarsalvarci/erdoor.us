<footer>
    <div class="footer-newsletter">
        <div class="container">
            <div class="newsletter-wrapper">
                <div class="newsletter-text">
                    <h3>Stay Connected</h3>
                    <p>
                        Join our mailing list to receive the latest news, product updates,
                        and special offers directly to your inbox.
                    </p>
                </div>
                <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                    <div class="input-group">
                        <input type="email" placeholder="Enter your email address" required/>
                        <button type="submit">Subscribe</button>
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
                    <li><a href="{{route('home')}}#products">Interior Doors</a></li>

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
{{--                <a href="#">Privacy Policy</a>--}}
{{--                <span class="sep">&bull;</span>--}}
{{--                <a href="#">Terms of Use</a>--}}
{{--                <span class="sep">&bull;</span>--}}
                <span>{{$settings->footer_address}}</span>
            </div>
        </div>
    </div>
</footer>


