<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $company['name'] ?? 'NEXA TAX' }} - {{ $company['tagline'] ?? 'Integrity and Loyalty' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400;1,9..40,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#0047AB',
                            dark: '#003380',
                            light: '#e8f0fe',
                            50: '#f0f5ff',
                        },
                        navy: {
                            DEFAULT: '#0d1b2a',
                            light: '#1b2d45',
                        },
                    },
                    fontFamily: {
                        heading: ['"DM Sans"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'DM Sans', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="min-h-screen bg-white text-gray-700">

    {{-- ==================== NAVBAR ==================== --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16 md:h-20">
            {{-- Logo --}}
            <a href="/" class="flex-shrink-0">
                @if(!empty($logo['image']))
                    <img src="{{ $logo['image'] }}" alt="{{ $company['name'] ?? 'NEXA TAX' }}" class="h-9 md:h-10 w-auto object-contain">
                @else
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold text-navy font-heading tracking-tight">NEXA</span>
                        <span class="text-brand font-extrabold text-2xl font-heading">TAX</span>
                    </div>
                @endif
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center">
                <a href="#contact" class="border border-gray-900 text-gray-900 text-sm font-semibold px-5 py-2 rounded hover:bg-gray-900 hover:text-white transition-all">
                    Let's Talk
                </a>
            </div>

            {{-- Mobile: Let's Talk button --}}
            <a href="#contact" class="lg:hidden border border-gray-900 text-gray-900 text-sm font-semibold px-4 py-1.5 rounded hover:bg-gray-900 hover:text-white transition-all">
                Let's Talk
            </a>
        </div>
    </nav>

    <main>

        {{-- ==================== HERO BANNER (Video background) ==================== --}}
        <section class="relative overflow-hidden bg-gray-900">
            <div class="relative w-full h-[420px] sm:h-[480px] md:h-[540px] lg:h-[600px]">
                {{-- Video Background --}}
                @php $bannerVideo = !empty($banner['video']) ? $banner['video'] : asset('assets/banner-jakarta-video.mp4'); @endphp
                <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
                    <source src="{{ $bannerVideo }}" type="video/mp4">
                </video>
                {{-- Dark gradient overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                {{-- Text Overlay --}}
                <div class="absolute inset-0 flex items-end">
                    <div class="max-w-7xl mx-auto px-6 w-full pb-12 md:pb-16 lg:pb-20">
                        <div class="max-w-2xl">
                            {{-- Badge --}}
                            <div class="inline-block bg-brand text-white text-[10px] sm:text-xs font-bold tracking-wider px-3 py-1 mb-4">
                                {{ $banner['badge'] ?? 'NEXA TAX INDONESIA' }}
                            </div>
                            {{-- Heading --}}
                            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4 font-heading">
                                {{ $banner['line3'] ?? 'Active Creative' }} {{ $banner['line4'] ?? 'Emphatic' }}
                            </h1>
                            {{-- Description --}}
                            <p class="text-gray-300 text-sm md:text-base leading-relaxed mb-6 max-w-lg">
                                {{ $company['description'] ?? 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.' }}
                            </p>
                            {{-- CTA Button --}}
                            <a href="#consultation" class="inline-flex items-center gap-2 bg-brand text-white text-sm font-semibold px-6 py-3 hover:bg-brand-dark transition-colors">
                                View Our Services
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== SERVICES SECTION ==================== --}}
        <section id="practicearea" class="relative py-14 md:py-20 bg-white overflow-hidden" x-data="{ page: 0, perPage: 2, get totalPages() { return Math.ceil({{ $services->count() }} / this.perPage) } }">
            {{-- Subtle background accent --}}
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-[0.03]">
                <svg viewBox="0 0 600 600" fill="none" class="w-full h-full"><circle cx="300" cy="300" r="280" stroke="#0047AB" stroke-width="1"/><circle cx="300" cy="300" r="200" stroke="#0047AB" stroke-width="1"/><circle cx="300" cy="300" r="120" stroke="#0047AB" stroke-width="1"/></svg>
            </div>
            <div class="relative max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    {{-- Left: Heading + Arrows --}}
                    <div class="lg:col-span-5">
                        <div class="text-[10px] font-bold text-brand tracking-[0.2em] uppercase mb-4">{{ $servicesSection['label'] ?? 'Our Practice Areas' }}</div>
                        <h2 class="text-2xl md:text-3xl lg:text-[2rem] font-bold text-gray-900 leading-snug font-heading mb-4">
                            {{ $servicesSection['heading'] ?? 'We continue to provide the best services to all enterprises in' }}
                            <span class="text-brand">{{ $servicesSection['heading_highlight'] ?? 'Indonesia and even worldwide.' }}</span>
                        </h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-md">{{ $servicesSection['description'] ?? 'Delivering comprehensive tax, legal, and business advisory solutions with integrity and professional excellence.' }}</p>
                        {{-- Arrow Navigation --}}
                        <div class="flex items-center gap-4">
                            <button @click="page = page > 0 ? page - 1 : totalPages - 1" class="w-11 h-11 border border-gray-300 rounded-full flex items-center justify-center text-gray-600 hover:border-brand hover:text-brand hover:bg-brand/5 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19 12H5m7-7-7 7 7 7"/></svg>
                            </button>
                            <button @click="page = (page + 1) % totalPages" class="w-11 h-11 border border-gray-300 rounded-full flex items-center justify-center text-gray-600 hover:border-brand hover:text-brand hover:bg-brand/5 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                            <span class="text-xs text-gray-400 ml-2 font-medium" x-text="(page + 1) + ' / ' + totalPages"></span>
                        </div>
                    </div>
                    {{-- Right: Service Cards --}}
                    <div class="lg:col-span-7">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($services as $si => $service)
                            <div x-show="Math.floor({{ $si }} / perPage) === page"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-3"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="group bg-white border border-gray-200 rounded-2xl p-7 min-h-[240px] flex flex-col hover:shadow-xl hover:border-brand/30 hover:-translate-y-1 transition-all duration-300">
                                <div class="text-[10px] font-bold text-brand tracking-[0.2em] uppercase mb-auto pb-4">SERVICES</div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3 font-heading group-hover:text-brand transition-colors">{{ $service->title }}</h3>
                                    <p class="text-gray-500 text-sm leading-relaxed">{{ $service->description ? Str::limit($service->description, 120) : 'Professional ' . strtolower($service->title) . ' services for individuals and entities in all aspects.' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== GEOMETRIC TRANSITION (Services → Our Firm) ==================== --}}
        <div class="relative w-full h-[100px] md:h-[140px] overflow-hidden bg-white">
            <svg class="absolute bottom-0 left-0 w-full h-full" viewBox="0 0 1440 140" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0 140V90L360 50L720 90L1080 30L1440 70V140H0Z" fill="#e8f4fa" fill-opacity="0.6"/>
                <path d="M0 140V110L480 60L960 100L1440 50V140H0Z" fill="#dceef7" fill-opacity="0.5"/>
                <path d="M0 140V120L240 100L720 80L1200 110L1440 90V140H0Z" fill="#d0e8f4" fill-opacity="0.4"/>
            </svg>
        </div>

        {{-- ==================== OUR FIRM SECTION ==================== --}}
        @php
            $cards = $ourfirm['cards'] ?? [];
            $cardCount = count($cards);
            $bgColors = ['#e8f4fa', '#dceef7', '#dde9f3', '#d2e4f0'];
        @endphp
        <section id="ourfirm" class="relative overflow-hidden">
            {{-- Dynamic background tiles --}}
            <div class="absolute inset-0 grid grid-cols-1 md:grid-cols-2">
                @foreach($cards as $ci => $c)
                <div style="background-color: {{ $bgColors[$ci % 4] }}"></div>
                @endforeach
            </div>
            {{-- Subtle pattern overlay --}}
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%230047AB&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
            <div class="relative max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    @foreach($cards as $index => $card)
                    <div class="px-8 md:px-12 lg:px-14 py-12 md:py-16 {{ $cardCount > 2 && $index >= 2 ? 'border-t border-white/40' : '' }}">
                        {{-- Blue double-chevron icon --}}
                        <div class="mb-5">
                            <svg class="w-10 h-10" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 30L18 18L6 6" stroke="#0047AB" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 30L30 18L18 6" stroke="#0047AB" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 font-heading leading-tight">{{ $card['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-8 max-w-sm">{{ $card['description'] }}</p>
                        @if(!empty($card['button_text']))
                        <a href="{{ $card['button_url'] ?? '#contact' }}" class="inline-flex items-center gap-3 border border-gray-400 text-gray-700 text-sm font-medium px-6 py-3 rounded hover:border-brand hover:text-brand hover:bg-white/50 transition-all">
                            {{ $card['button_text'] }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ==================== CONSULTATION / OUR CLIENT (HNG-style: image left + text right) ==================== --}}
        <section id="consultation" class="py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-0 items-stretch">
                {{-- Left: Image --}}
                <div class="relative min-h-[300px] md:min-h-[400px]">
                    <img src="{{ $consultation['image'] ?? '' }}" alt="Our Client" class="absolute inset-0 w-full h-full object-cover">
                </div>
                {{-- Right: Content --}}
                <div class="bg-white p-8 md:p-12 lg:p-16 flex flex-col justify-center">
                    {{-- Blue arrow icon --}}
                    {{-- <div class="mb-5">
                        <svg class="w-7 h-7 text-brand" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-10.975z"/>
                        </svg>
                    </div> --}}
                    <h2 class="text-2xl md:text-3xl font-bold text-brand mb-3 font-heading">
                        {{ $consultation['heading'] ?? "Let's Consult With Our" }}
                    </h2>
                    <p class="text-brand text-sm font-medium mb-6">
                        {{ $consultation['heading_highlight'] ?? 'Leading Experts.' }}
                    </p>

                    {{-- Stats inline --}}
                    <div class="flex items-center gap-8 mb-6">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 font-heading">{{ $stats['projects'] ?? '111' }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $stats['projects_label'] ?? 'Project Completed' }}</div>
                        </div>
                        <div class="w-px h-10 bg-gray-200"></div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900 font-heading">{{ $stats['experience'] ?? '5 +' }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $stats['experience_label'] ?? 'Years Experience' }}</div>
                        </div>
                    </div>

                    {{-- First testimonial as quote --}}
                    @if($testimonials->count() > 0)
                    @php $firstTestimonial = $testimonials->first(); @endphp
                    <blockquote class="border-l-2 border-gray-200 pl-4 mb-4">
                        <p class="text-gray-600 text-sm leading-relaxed italic">"{{ Str::limit($firstTestimonial->quote, 200) }}"</p>
                    </blockquote>
                    <p class="text-gray-400 text-xs italic">{{ $firstTestimonial->author_name }} — {{ $firstTestimonial->author_title }}</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- ==================== CLIENT LOGOS SECTION (Auto-scroll) ==================== --}}
        @if($clientLogos->count() > 0)
        <section class="py-14 md:py-20 bg-white border-t border-gray-100 overflow-hidden">
            <div class="relative" x-data="{
                offset: 0,
                speed: 1,
                itemWidth: 220,
                totalItems: {{ $clientLogos->count() }},
                get totalWidth() { return this.itemWidth * this.totalItems },
                init() {
                    const animate = () => {
                        this.offset -= this.speed;
                        if (Math.abs(this.offset) >= this.totalWidth) this.offset = 0;
                        requestAnimationFrame(animate);
                    };
                    requestAnimationFrame(animate);
                }
            }">
                <div class="flex" :style="'transform: translateX(' + offset + 'px)'">
                    {{-- Duplicate logos for seamless loop --}}
                    @for($loop_i = 0; $loop_i < 2; $loop_i++)
                    @foreach($clientLogos as $clientLogo)
                    <div class="flex-shrink-0 w-[220px] flex items-center justify-center px-6">
                        <img src="{{ $clientLogo->image }}" alt="{{ $clientLogo->name ?? 'Client' }}" class="h-14 md:h-16 max-w-[180px] w-auto object-contain grayscale hover:grayscale-0 opacity-50 hover:opacity-100 transition-all duration-300">
                    </div>
                    @endforeach
                    @endfor
                </div>
            </div>
        </section>
        @endif

        {{-- ==================== TESTIMONIALS SECTION ==================== --}}
        @if($testimonials->count() > 1)
        <section id="testimonials" class="py-16 md:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 font-heading">What Our Clients Say</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    @foreach($testimonials as $testimonial)
                    <div class="bg-white p-7 border border-gray-100">
                        <div class="text-brand mb-3 opacity-30">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V21c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">"{{ $testimonial->quote }}"</p>
                        <div class="border-t border-gray-100 pt-4">
                            <h4 class="text-sm font-semibold text-gray-900 font-heading">{{ $testimonial->author_name }}</h4>
                            <p class="text-gray-400 text-xs mt-0.5">{{ $testimonial->author_title }}{{ $testimonial->author_company ? ', ' . $testimonial->author_company : '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ==================== FEATURED INSIGHTS SECTION ==================== --}}
        @if($insights->count() > 0)
        <section class="py-16 md:py-24 bg-navy">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-white font-heading">Featured Insights</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    @foreach($insights as $insight)
                    <div class="bg-white rounded overflow-hidden">
                        @if($insight->thumbnail)
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ $insight->thumbnail }}" alt="{{ $insight->title }}" class="w-full h-full object-cover">
                            @if($insight->badge)
                            <div class="absolute top-3 left-3 bg-brand text-white text-[10px] font-bold px-2 py-1 rounded">
                                {{ $insight->badge }}
                            </div>
                            @endif
                        </div>
                        @endif
                        <div class="p-5">
                            <h3 class="text-sm font-bold text-gray-900 leading-snug mb-2 font-heading">{{ $insight->title }}</h3>
                            @if($insight->published_date)
                            <p class="text-xs text-gray-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $insight->published_date->format('F d, Y') }}
                            </p>
                            @endif
                            <p class="text-brand text-xs font-semibold mt-3">Read More</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ==================== CONTACT SECTION ==================== --}}
        <section id="contact" class="py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 font-heading">{{ $contactForm['title'] ?? 'Get In Touch' }}</h2>
                    <p class="text-gray-500 text-sm mt-3 max-w-lg mx-auto">{{ $contactForm['subtitle'] ?? 'Send us a message and we will get back to you shortly.' }}</p>
                </div>

                <div class="max-w-2xl mx-auto">
                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded mb-6 text-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <input type="text" name="name" placeholder="{{ $contactForm['namePlaceholder'] ?? 'Full Name' }}" required
                                    class="w-full px-4 py-3 border border-gray-200 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition @error('name') border-red-400 @enderror"
                                    value="{{ old('name') }}">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="{{ $contactForm['emailPlaceholder'] ?? 'Email Address' }}" required
                                    class="w-full px-4 py-3 border border-gray-200 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition @error('email') border-red-400 @enderror"
                                    value="{{ old('email') }}">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <input type="tel" name="phone" placeholder="{{ $contactForm['phonePlaceholder'] ?? 'Phone Number' }}"
                                    class="w-full px-4 py-3 border border-gray-200 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition"
                                    value="{{ old('phone') }}">
                            </div>
                            <div>
                                <select name="service" class="w-full px-4 py-3 border border-gray-200 text-sm text-gray-500 focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition">
                                    <option value="">{{ $contactForm['servicePlaceholder'] ?? 'Select Service' }}</option>
                                    @foreach($services as $svc)
                                    <option value="{{ $svc->title }}" {{ old('service') == $svc->title ? 'selected' : '' }}>{{ $svc->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <textarea name="message" rows="5" placeholder="{{ $contactForm['messagePlaceholder'] ?? 'Your Message' }}" required
                                class="w-full px-4 py-3 border border-gray-200 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="bg-brand text-white text-sm font-semibold px-8 py-3 hover:bg-brand-dark transition-colors tracking-wide">
                            {{ $contactForm['submitButton'] ?? 'SEND MESSAGE' }}
                        </button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    {{-- ==================== MAPS SECTION (above footer) ==================== --}}
    @if(!empty($map['embed_url']))
    <section class="relative">
        {{-- Map --}}
        <div class="relative w-full h-[350px] md:h-[420px]">
            <iframe src="{{ $map['embed_url'] }}" class="absolute inset-0 w-full h-full" style="border:0; filter: saturate(0.8) contrast(1.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            {{-- Gradient overlay at bottom for smooth transition to footer --}}
            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-navy to-transparent"></div>
        </div>
        {{-- Floating location card --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 md:left-auto md:translate-x-0 md:right-12 z-10">
            <div class="bg-white rounded-xl shadow-2xl px-6 py-5 flex items-center gap-4 min-w-[280px]">
                <div class="flex-shrink-0 w-12 h-12 bg-brand/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C7.31 0 3.5 3.81 3.5 8.5c0 6.38 8.5 15.5 8.5 15.5s8.5-9.12 8.5-15.5C20.5 3.81 16.69 0 12 0zm0 12.5c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900 font-heading">{{ !empty($map['label']) ? $map['label'] : ($company['name'] ?? 'Our Office') }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $company['address'] ?? 'Jakarta, Indonesia' }}</p>
                </div>
                <a href="{{ $map['url'] ?? '#' }}" target="_blank" rel="noopener" class="flex-shrink-0 w-9 h-9 bg-brand rounded-full flex items-center justify-center text-white hover:bg-brand-dark transition-colors ml-2" title="Open in Google Maps">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6m4-3h6v6m-11 5L21 3"/></svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ==================== FOOTER (HNG-style: dark navy, 3 columns) ==================== --}}
    <footer class="bg-navy text-white pt-14 pb-6">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-10">
                {{-- Col 1: Brand + Social --}}
                <div>
                    <div class="mb-4">
                        @if(!empty($logo['image']))
                            <img src="{{ $logo['image'] }}" alt="{{ $company['name'] ?? 'NEXA TAX' }}" class="h-9 md:h-10 w-auto object-contain">
                        @else
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-extrabold text-white font-heading tracking-tight">NEXA</span>
                                <span class="text-brand text-xl font-extrabold font-heading">TAX</span>
                            </div>
                        @endif
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed mb-5 font-heading font-medium">
                        {{ $company['tagline'] ?? 'Integrity and Loyalty' }}
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        {{ $footer['description'] ?? 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.' }}
                    </p>
                    {{-- Social Icons --}}
                    <div class="flex gap-3">
                        <a href="{{ $social['facebook'] ?? '#' }}" target="_blank" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand transition-colors">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="{{ $social['instagram'] ?? '#' }}" target="_blank" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand transition-colors">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        @if(!empty($social['linkedin']))
                        <a href="{{ $social['linkedin'] }}" target="_blank" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand transition-colors">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Col 2: Company Info --}}
                <div>
                    <h3 class="text-sm font-semibold text-white mb-5 font-heading">{{ $company['name'] ?? 'NEXA TAX' }}</h3>
                    <div class="space-y-3 text-sm text-gray-400 leading-relaxed">
                        <p>{{ $company['address'] ?? 'Jakarta, Indonesia' }}</p>
                        @if(!empty($company['phone']))
                        <p>Whatsapp : {{ $company['phone'] }}</p>
                        @endif
                        @if(!empty($company['phone']))
                        <p>Tel : {{ $company['phone'] }}</p>
                        @endif
                        @if(!empty($company['email']))
                        <p>Email : {{ $company['email'] }}</p>
                        @endif
                    </div>
                </div>

                {{-- Col 3: Career --}}
                <div>
                    <h3 class="text-sm font-semibold text-white mb-5 font-heading">{{ $career['title'] ?? 'Career' }}</h3>
                    <p class="text-brand text-sm font-semibold mb-3">{{ $career['subtitle'] ?? 'Open Position' }}</p>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $career['description'] ?? 'Ready for New Challenge? Apply Now!' }}</p>
                    @if(!empty($career['email']))
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-gray-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ $career['email'] }}" class="text-gray-400 text-sm hover:text-brand transition-colors break-all">{{ $career['email'] }}</a>
                    </div>
                    @endif
                </div>

                {{-- Col 4: Newsletter --}}
                <div>
                    <h3 class="text-sm font-semibold text-white mb-5 font-heading">Newsletter Sign Up</h3>
                    <div class="space-y-3">
                        <input type="text" placeholder="Enter your Name" class="w-full bg-transparent border border-gray-600 text-sm text-white placeholder-gray-500 px-4 py-2.5 focus:outline-none focus:border-brand transition">
                        <input type="email" placeholder="Enter your Email" class="w-full bg-transparent border border-gray-600 text-sm text-white placeholder-gray-500 px-4 py-2.5 focus:outline-none focus:border-brand transition">
                        <button class="bg-brand text-white text-xs font-bold tracking-widest px-6 py-2.5 hover:bg-brand-dark transition-colors">
                            SUBSCRIBE
                        </button>
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-white/10 pt-6 text-center">
                <p class="text-gray-500 text-xs">&copy; {{ date('Y') }} {{ $company['name'] ?? 'NEXA TAX Indonesia' }}. All rights reserved</p>
            </div>
        </div>
    </footer>

    {{-- ==================== FLOATING BUTTONS (Scroll-to-top + WhatsApp) ==================== --}}
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-center gap-3">
        {{-- Scroll to Top --}}
        <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            x-data="{ show: false }"
            x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })"
            x-show="show"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75"
            class="bg-brand text-white p-2 rounded-full shadow-lg hover:bg-brand-dark hover:shadow-xl transition-all duration-200"
            aria-label="Scroll to top">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 15l7-7 7 7"/></svg>
        </button>
        {{-- WhatsApp --}}
        @php $waNumber = $whatsapp['number'] ?? '622180868212'; @endphp
        <a href="https://wa.me/{{ $waNumber }}{{ !empty($whatsapp['message']) ? '?text=' . urlencode($whatsapp['message']) : '' }}" target="_blank" rel="noopener noreferrer"
            class="bg-[#25D366] text-white p-3 rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200"
            aria-label="Contact on WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </a>
    </div>

</body>
</html>
