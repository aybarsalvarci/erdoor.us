@extends('front.layouts.master')

@php
    // JSON içeriğini güvenle değişkenlere alıyoruz
    $content = $page->content ?? [];

    $info = $content['info_section'] ?? [];
    $form = $content['form_section'] ?? [];
    $roles = $form['role_options'] ?? [];
@endphp

@section('title', $page->title ?? 'Contact Us')

@push('css')
    <style>
        /* Admin panelinden gelen iframe'in tasarımı bozmaması ve tam oturması için */
        .map-wrapper iframe {
            width: 100% !important;
            height: 18rem !important; /* Tailwind h-72 (288px) */
            border: 0 !important;
        }
        @media (min-width: 640px) {
            .map-wrapper iframe {
                height: 20rem !important; /* Tailwind sm:h-80 (320px) */
            }
        }
    </style>
@endpush

@section('content')
    <main>
        <section class="px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:gap-16">

                <!-- ================= BİLGİ ALANI (SOL TARAF) ================= -->
                <div class="pt-2">
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold tracking-tight text-[#17202a] sm:text-4xl">
                            {{ $info['title'] ?? 'Contact Information' }}
                        </h1>
                        <div class="mt-4 h-1 w-16 bg-[#c0392b]"></div>
                    </div>

                    <div class="space-y-7">
                        <!-- Konum -->
                        <article class="flex gap-5">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-white text-[#c0392b] shadow-lg shadow-gray-200/80">
                                <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.25A7.25 7.25 0 0 0 4.75 9.5c0 5.44 6.56 11.65 6.84 11.91a.6.6 0 0 0 .82 0c.28-.26 6.84-6.47 6.84-11.91A7.25 7.25 0 0 0 12 2.25Zm0 10a2.75 2.75 0 1 1 0-5.5 2.75 2.75 0 0 1 0 5.5Z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-[#17202a]">{{ $info['location_title'] ?? 'Our Location' }}</h2>
                                <p class="mt-1 text-base leading-relaxed text-gray-600">{{ $info['location_text'] ?? '' }}</p>
                            </div>
                        </article>

                        <!-- Telefon -->
                        <article class="flex gap-5">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-white text-[#c0392b] shadow-lg shadow-gray-200/80">
                                <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79a15.1 15.1 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24 11.36 11.36 0 0 0 3.58.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.58 1 1 0 0 1-.24 1.01l-2.21 2.2Z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-[#17202a]">{{ $info['phone_title'] ?? 'Phone Number' }}</h2>
                                <p class="mt-1 text-base leading-relaxed text-gray-600">
                                    <a class="transition hover:text-[#c0392b]" href="tel:{{ preg_replace('/[^0-9+]/', '', $info['phone_text'] ?? '') }}">
                                        {{ $info['phone_text'] ?? '' }}
                                    </a>
                                </p>
                            </div>
                        </article>

                        <!-- Email -->
                        <article class="flex gap-5">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-white text-[#c0392b] shadow-lg shadow-gray-200/80">
                                <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M4 5h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Zm8 7.2L4.4 7.1A.75.75 0 0 0 4 7.75v.6l7.58 5.08a.75.75 0 0 0 .84 0L20 8.35v-.6a.75.75 0 0 0-.4-.65L12 12.2Z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-[#17202a]">{{ $info['email_title'] ?? 'Email Address' }}</h2>
                                <p class="mt-1 text-base leading-relaxed text-gray-600">
                                    <a class="transition hover:text-[#c0392b]" href="mailto:{{ $info['email_text'] ?? '' }}">
                                        {{ $info['email_text'] ?? '' }}
                                    </a>
                                </p>
                            </div>
                        </article>

                        <!-- Çalışma Saatleri -->
                        <article class="flex gap-5">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-white text-[#c0392b] shadow-lg shadow-gray-200/80">
                                <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 .01 20.01A10 10 0 0 0 12 2Zm1 10.3 3.15 1.88-.9 1.51-4-2.4A.75.75 0 0 1 10.9 13V6.75h1.85v5.12c0 .18.1.34.25.43Z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-[#17202a]">{{ $info['hours_title'] ?? 'Working Hours' }}</h2>
                                <p class="mt-1 text-base leading-relaxed text-gray-600">
                                    {!! $info['hours_text'] ?? '' !!}
                                </p>
                            </div>
                        </article>
                    </div>

                    <!-- Harita (Iframe) Alanı -->
                    <div class="map-wrapper mt-12 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                        @if(!empty($info['map_query']))
                            {!! $info['map_query'] !!}
                        @else
                            <!-- Fallback (Eğer panelden iframe girilmezse boş kalmaması için) -->
                            <iframe
                                title="Erdoor location map fallback"
                                src="https://www.google.com/maps?q=Doral,+Florida&output=embed"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @endif
                    </div>
                </div>

                <!-- ================= FORM ALANI (SAĞ TARAF) ================= -->
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-xl shadow-gray-200/60 sm:p-10 lg:p-12" aria-labelledby="contact-form-title">
                    <h2 id="contact-form-title" class="text-3xl font-bold tracking-tight text-[#17202a]">
                        {{ $form['title'] ?? 'Send a Message' }}
                    </h2>

                    <form id="contactForm" class="mt-8 space-y-7" action="mailto:{{ $info['email_text'] ?? 'erdoor@erdoor.us' }}" method="post" enctype="text/plain">

                        <div>
                            <label for="fullName" class="mb-2 block text-sm font-semibold uppercase tracking-wide text-[#17202a]">{{ $form['name_label'] ?? 'Full Name *' }}</label>
                            <input id="fullName" name="Full Name" type="text" required autocomplete="name" placeholder="{{ $form['name_placeholder'] ?? 'Your Name' }}" class="block w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-base text-[#17202a] outline-none transition placeholder:text-gray-500 focus:border-[#17202a] focus:ring-2 focus:ring-[#17202a]/15">
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold uppercase tracking-wide text-[#17202a]">{{ $form['email_label'] ?? 'Email Address *' }}</label>
                            <input id="email" name="Email Address" type="email" required autocomplete="email" placeholder="{{ $form['email_placeholder'] ?? 'your@email.com' }}" class="block w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-base text-[#17202a] outline-none transition placeholder:text-gray-500 focus:border-[#17202a] focus:ring-2 focus:ring-[#17202a]/15">
                        </div>

                        <div>
                            <label for="phone" class="mb-2 block text-sm font-semibold uppercase tracking-wide text-[#17202a]">{{ $form['phone_label'] ?? 'Phone Number' }}</label>
                            <input id="phone" name="Phone Number" type="tel" autocomplete="tel" placeholder="{{ $form['phone_placeholder'] ?? '+1 (555) 000-0000' }}" class="block w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-base text-[#17202a] outline-none transition placeholder:text-gray-500 focus:border-[#17202a] focus:ring-2 focus:ring-[#17202a]/15">
                        </div>

                        <!-- Dinamik Rol Dropdown -->
                        <div>
                            <label for="role" class="mb-2 block text-sm font-semibold uppercase tracking-wide text-[#17202a]">{{ $form['role_label'] ?? 'I Am A...' }}</label>
                            <select id="role" name="I Am A" class="block w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-base text-[#17202a] outline-none transition focus:border-[#17202a] focus:ring-2 focus:ring-[#17202a]/15">
                                <option value="">{{ $form['role_placeholder'] ?? 'Select Your Role' }}</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="message" class="mb-2 block text-sm font-semibold uppercase tracking-wide text-[#17202a]">{{ $form['message_label'] ?? 'Message *' }}</label>
                            <textarea id="message" name="Message" rows="6" required placeholder="{{ $form['message_placeholder'] ?? 'How can we help you?' }}" class="block w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-base text-[#17202a] outline-none transition placeholder:text-gray-500 focus:border-[#17202a] focus:ring-2 focus:ring-[#17202a]/15"></textarea>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center gap-3 rounded-md bg-[#17202a] px-8 py-4 text-sm font-bold uppercase tracking-[0.18em] text-white transition hover:bg-[#c0392b] focus:outline-none focus:ring-4 focus:ring-[#c0392b]/25">
                            {{ $form['button_text'] ?? 'Send Message' }}
                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M21.7 3.3a1 1 0 0 0-1.05-.23l-18 7a1 1 0 0 0 .06 1.88l7.42 2.47 2.47 7.42a1 1 0 0 0 .9.68h.05a1 1 0 0 0 .9-.55l7.5-17.6a1 1 0 0 0-.25-1.07ZM13.8 18.7l-1.56-4.68 4.1-4.1-1.42-1.42-4.1 4.1L6.3 11.1l12.92-5.02L13.8 18.7Z"></path></svg>
                        </button>
                    </form>
                </section>

            </div>
        </section>
    </main>
@endsection

@push('js')
@endpush
