@extends('front.layouts.master')

@section('title', 'Homepage')

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/resources.css')}}">
@endpush

@section('content')

    <main>
        <section class="resource-hero" aria-labelledby="resource-title">
            <div class="container resource-hero-inner">
                <p class="resource-eyebrow">Knowledge &amp; support</p>
                <h1 id="resource-title">Clarity at every step.<br>Support that lasts.</h1>
                <p class="resource-hero-copy">A well-designed door is only the beginning. Our resource library brings
                    together the guidance, documentation, and inspiration you need to plan with confidence, install with
                    precision, and protect your investment for years to come.</p>
            </div>
        </section>

        <section class="resource-intro" aria-labelledby="resource-intro-title">
            <div class="container resource-intro-grid">
                <div class="resource-intro-copy">
                    <p class="resource-section-label">Built around your project</p>
                    <h2 id="resource-intro-title">The right information, exactly when you need it</h2>
                    <p>Every successful project depends on informed decisions. Whether you are comparing designs,
                        preparing an opening, reviewing performance requirements, or confirming long-term coverage,
                        Erdoor makes essential information easy to find and simple to use.</p>
                    <p>These resources are created for architects, contractors, distributors, designers, and
                        homeowners—bringing product knowledge and practical support together in one considered
                        experience.</p>
                </div>

                <div class="resource-journey" aria-label="How Erdoor resources support your project">
                    <article>
                        <span>01</span>
                        <div><h3>Explore</h3>
                            <p>Discover door collections, finishes, and completed spaces that bring design ideas into
                                focus.</p></div>
                    </article>
                    <article>
                        <span>02</span>
                        <div><h3>Prepare</h3>
                            <p>Use clear installation guidance and product information to plan every detail before work
                                begins.</p></div>
                    </article>
                    <article>
                        <span>03</span>
                        <div><h3>Verify</h3>
                            <p>Review performance testing, technical records, certificates, and warranty coverage with
                                confidence.</p></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="resource-directory" aria-label="Resource library">
            <div class="container">
                <div class="resource-directory-heading">
                    <p class="resource-section-label">Resource library</p>
                    <h2>Explore, understand,<br>and build with confidence</h2>
                    <p>Six focused destinations give you direct access to Erdoor knowledge, documentation, and design
                        inspiration.</p>
                </div>

                <div class="resource-table">
                    @foreach($pages as $page)
                        <article class="resource-table-card">
                            <a href="{{route('resources.single', $page->slug)}}" class="resource-table-image" aria-label="Open Installation">
                                <img src="{{$page->image->url}}" alt="Erdoor interior door installation" loading="eager">
                                <span><i class="{{$page->icon}}" aria-hidden="true"></i></span>
                            </a>
                            <div class="resource-table-content">
                                <h3>{{$page->title}}</h3>
                                <p>{{$page->description}}</p>
                                <a href="{{route('resources.single', $page->slug)}}" class="resource-table-link">{{$page->link_text}} <i
                                        class="fa-solid {{$page->icon}}" aria-hidden="true"></i></a>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </section>

        <section class="resource-support">
            <div class="container resource-support-inner">
                <div><p class="resource-section-label">Project support</p>
                    <h2>Looking for something more specific?</h2>
                    <p>Our team can help with project documentation, product selection, technical questions, and sample
                        requests.</p></div>
                <a href="contact.html" class="resource-support-link">Start a conversation <span aria-hidden="true">&rarr;</span></a>
            </div>
        </section>
    </main>

@endsection

@push('js')
@endpush
