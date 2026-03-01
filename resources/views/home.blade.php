<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NEXA TAX - {{ $company['tagline'] ?? 'Integrity and Loyalty' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd', 300: '#7dd3fc',
                            400: '#38bdf8', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1',
                            800: '#075985', 900: '#0c4a6e', 950: '#082f49', brand: '#007AFF', accent: '#00D1FF',
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    boxShadow: {
                        'card': '0 10px 30px -5px rgba(0, 122, 255, 0.1)',
                        'elevated': '0 20px 40px -10px rgba(0, 0, 0, 0.15)',
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        .bg-grid-dark {
            background-image: radial-gradient(circle, #ffffff10 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="min-h-screen bg-white font-sans text-slate-900">

    {{-- ==================== TOP BAR ==================== --}}
    <div class="bg-slate-950 text-white text-[10px] font-bold tracking-widest py-3 px-6 hidden md:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center opacity-80">
            <div class="flex gap-8">
                <span>{{ $company['office_hours'] ?? 'Mon-Fri 08:00 - 17:00' }}</span>
                <span>{{ $company['phone'] ?? '+(62) 21-80868212' }}</span>
            </div>
            <div class="flex gap-4">
                <a href="{{ $social['facebook'] ?? '#' }}" class="hover:text-primary-brand">FB</a>
                <a href="{{ $social['instagram'] ?? '#' }}" class="hover:text-primary-brand">IG</a>
            </div>
        </div>
    </div>

    {{-- ==================== NAVBAR ==================== --}}
    <nav class="bg-white border-b border-slate-100 py-4 sticky top-0 z-50" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            {{-- Brand Logo --}}
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-primary-brand flex items-center justify-center rounded-sm rotate-45 hover:rotate-90 transition-transform duration-500">
                    <div class="w-5 h-5 border-2 border-white -rotate-45"></div>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-black tracking-tighter text-slate-900">NEXA <span class="text-primary-brand">TAX</span></span>
                    <span class="text-[0.6rem] font-bold tracking-[0.2em] uppercase text-slate-400">Consulting</span>
                </div>
            </div>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center space-x-8">
                @foreach($menu as $item)
                <a href="{{ $item['url'] }}" class="text-xs font-bold text-slate-600 hover:text-primary-brand tracking-widest flex items-center gap-1 transition-colors">
                    {{ $item['label'] }}
                    @if($item['label'] === 'PRACTICE AREA')
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    @endif
                </a>
                @endforeach
                <a href="#contact" class="bg-primary-brand text-white text-[10px] font-black px-6 py-3 rounded-sm tracking-widest hover:bg-primary-700 transition-all shadow-lg shadow-primary-200">LET'S CONNECT</a>
            </div>

            {{-- Mobile Hamburger --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <template x-if="!mobileOpen"><g><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></g></template>
                    <template x-if="mobileOpen"><g><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></g></template>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen" x-transition class="lg:hidden border-t border-slate-100 bg-white px-6 py-4 space-y-4">
            @foreach($menu as $item)
            <a href="{{ $item['url'] }}" @click="mobileOpen = false" class="block text-xs font-bold text-slate-600 hover:text-primary-brand tracking-widest">{{ $item['label'] }}</a>
            @endforeach
            <a href="#contact" @click="mobileOpen = false" class="block bg-primary-brand text-white text-[10px] font-black px-6 py-3 rounded-sm tracking-widest text-center">LET'S CONNECT</a>
        </div>
    </nav>

    <main>
        {{-- ==================== HERO SECTION ==================== --}}
        @php $slides = $banner['slides'] ?? []; @endphp
        <section class="relative bg-slate-50 overflow-hidden min-h-[500px] md:min-h-[750px] flex items-center" x-data="{ current: 0, total: {{ count($slides) }} }" x-init="setInterval(() => { current = (current + 1) % total }, 5000)">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 items-center w-full relative z-10">
                {{-- Left: Text --}}
                <div class="py-16 md:py-24 text-center lg:text-left">
                    <div class="bg-primary-brand text-white inline-block px-4 py-1.5 mb-8 text-[10px] md:text-xs font-black tracking-[0.2em] animate-bounce">{{ $banner['badge'] ?? 'NEXA TAX INDONESIA' }}</div>
                    <h1 class="text-4xl sm:text-6xl md:text-8xl font-bold text-slate-900 leading-[1.05] mb-8 tracking-tighter">
                        @foreach($slides as $i => $slide)
                        <span x-show="current === {{ $i }}" x-transition.opacity.duration.500ms>{{ $slide['tagline_1'] ?? '' }} </span>
                        @endforeach
                        <span class="text-primary-brand">
                            @foreach($slides as $i => $slide)
                            <span x-show="current === {{ $i }}" x-transition.opacity.duration.500ms>{{ $slide['tagline_2'] ?? '' }}</span>
                            @endforeach
                        </span>
                        <br>
                        {{ $banner['line3'] ?? 'Active Creative' }}<br>
                        <span class="italic font-serif font-light text-slate-400">{{ $banner['line4'] ?? 'Emphatic' }}</span>
                    </h1>
                    {{-- Nav Dots --}}
                    <div class="flex justify-center lg:justify-start gap-3 mt-10 md:mt-16">
                        @foreach($slides as $i => $slide)
                        <button @click="current = {{ $i }}" :class="current === {{ $i }} ? 'w-12 bg-primary-brand' : 'w-2 bg-slate-300 hover:bg-slate-400'" class="h-2 transition-all duration-500 rounded-full"></button>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Images --}}
                <div class="relative h-[400px] md:h-[600px] hidden lg:block">
                    <div class="relative w-full h-full">
                        @foreach($slides as $i => $slide)
                        <div x-show="current === {{ $i }}" x-transition.opacity.duration.1000ms class="absolute inset-0">
                            <img src="{{ $slide['image'] ?? '' }}" alt="Nexa Tax Slide {{ $i + 1 }}" class="w-full h-full object-cover rounded-sm shadow-2xl">
                        </div>
                        @endforeach
                        <div class="absolute -bottom-6 -left-6 w-40 h-40 border-l-[12px] border-b-[12px] border-primary-brand/20 -z-10"></div>
                    </div>
                </div>
            </div>
            {{-- Background decoration --}}
            <div class="absolute top-0 right-0 w-full lg:w-[45%] h-full bg-white -z-0 transform lg:skew-x-[-6deg] lg:translate-x-20 border-l border-slate-100"></div>
        </section>

        {{-- ==================== OUR FIRM SECTION ==================== --}}
        <section id="ourfirm" class="relative pb-20 md:pb-32">
            <div class="max-w-7xl mx-auto px-6 py-12 md:py-20 flex flex-col sm:flex-row justify-between items-center sm:items-end gap-4">
                <div class="text-center sm:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">{{ $ourfirm['title'] ?? 'Our Firm' }}</h2>
                    <div class="w-12 h-1 bg-primary-brand mx-auto sm:mx-0"></div>
                </div>
                <button class="flex items-center gap-2 text-[10px] font-black tracking-widest text-slate-400 hover:text-primary-brand transition-colors">
                    LEARN MORE
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </div>
            {{-- Blue strip --}}
            <div class="absolute left-0 right-0 h-40 md:h-48 bg-primary-brand z-0"></div>
            {{-- Cards --}}
            <div class="max-w-7xl mx-auto px-6 relative z-10 -mt-8 md:-mt-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    @foreach(($ourfirm['cards'] ?? []) as $card)
                    <div class="bg-white p-8 md:p-10 shadow-elevated border-t-8 border-primary-brand hover:-translate-y-2 transition-transform duration-300">
                        <h3 class="text-lg md:text-xl font-bold text-slate-900 mb-4 md:mb-6 text-center">{{ $card['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed text-center font-light">{{ $card['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ==================== CONSULTATION SECTION ==================== --}}
        <section id="consultation" class="py-20 md:py-32 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">
                {{-- Left: Text & Stats --}}
                <div class="order-2 lg:order-1">
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-10 md:mb-14 leading-tight tracking-tight">
                        {{ $consultation['heading'] ?? "Let's Consult With Our" }} <br class="hidden md:block">
                        <span class="relative inline-block">
                            {{ $consultation['heading_highlight'] ?? 'Leading Experts.' }}
                            <div class="absolute -bottom-2 left-0 w-12 h-1 bg-primary-brand"></div>
                        </span>
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                        {{-- Stat 1 --}}
                        <div class="bg-primary-brand p-8 md:p-12 text-center shadow-xl hover:translate-y-[-8px] transition-all duration-500">
                            <div class="flex justify-center mb-5 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                            </div>
                            <div class="text-5xl md:text-6xl font-black text-white mb-2">{{ $stats['projects'] ?? '111' }}</div>
                            <div class="text-[10px] md:text-[12px] font-bold text-primary-100 uppercase tracking-[0.2em]">{{ $stats['projects_label'] ?? 'Project Completed' }}</div>
                        </div>
                        {{-- Stat 2 --}}
                        <div class="bg-primary-brand p-8 md:p-12 text-center shadow-xl hover:translate-y-[-8px] transition-all duration-500">
                            <div class="flex justify-center mb-5 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                            </div>
                            <div class="text-5xl md:text-6xl font-black text-white mb-2">{{ $stats['experience'] ?? '5 +' }}</div>
                            <div class="text-[10px] md:text-[12px] font-bold text-primary-100 uppercase tracking-[0.2em]">{{ $stats['experience_label'] ?? 'Years Experience' }}</div>
                        </div>
                    </div>
                </div>
                {{-- Right: Image --}}
                <div class="relative order-1 lg:order-2">
                    <div class="relative z-10 p-3 md:p-6 bg-white shadow-elevated inline-block w-full border border-slate-50">
                        <div class="overflow-hidden relative">
                            <img src="{{ $consultation['image'] ?? '' }}" alt="Consultation and Strategy" class="w-full h-[300px] md:h-[450px] object-cover hover:scale-105 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-primary-brand/5 pointer-events-none"></div>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-1/2 h-1/2 bg-slate-50 -z-10"></div>
                </div>
            </div>
        </section>

        {{-- ==================== PRACTICE AREA SECTION ==================== --}}
        <section id="practicearea" class="relative py-20 md:py-32 bg-slate-950 bg-grid-dark">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 md:mb-20">
                    <div class="text-primary-brand font-bold text-[10px] tracking-[0.3em] mb-4 uppercase">Our Services</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 md:mb-8">Practice Area</h2>
                    <div class="w-16 h-1 bg-primary-brand mx-auto"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 max-w-5xl mx-auto">
                    @foreach($services as $service)
                    <div class="bg-primary-brand p-6 md:p-8 cursor-pointer hover:bg-white group text-center flex items-center justify-center min-h-[90px] md:min-h-[100px] transition-all duration-300">
                        <h3 class="text-white font-black text-[10px] md:text-xs tracking-widest group-hover:text-primary-brand transition-colors">{{ $service->title }}</h3>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ==================== TESTIMONIALS SECTION ==================== --}}
        <section id="testimonials" class="py-24 bg-white">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <div class="flex justify-center mb-10">
                    <div class="w-16 h-16 rounded-full border border-primary-200 flex items-center justify-center text-primary-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V21c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                    </div>
                </div>
                <h2 class="text-4xl font-serif font-bold text-slate-900 mb-16">Testimonials</h2>
                @foreach($testimonials as $testimonial)
                <div class="space-y-6 mb-12">
                    <p class="text-slate-600 text-lg italic leading-relaxed">"{{ $testimonial->quote }}"</p>
                    <div class="pt-4">
                        <h4 class="text-primary-brand font-bold text-lg">{{ $testimonial->author_name }}</h4>
                        <p class="text-slate-400 text-sm">{{ $testimonial->author_title }}{{ $testimonial->author_company ? ', ' . $testimonial->author_company : '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== CONTACT SECTION ==================== --}}
        <section id="contact" class="py-20 md:py-32 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <div class="text-primary-brand font-bold text-[10px] tracking-[0.3em] mb-4 uppercase">Contact Us</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">{{ $contactForm['title'] ?? 'Get In Touch' }}</h2>
                    <p class="text-slate-500 text-sm max-w-xl mx-auto">{{ $contactForm['subtitle'] ?? 'Send us a message and we will get back to you shortly.' }}</p>
                    <div class="w-16 h-1 bg-primary-brand mx-auto mt-6"></div>
                </div>

                <div class="max-w-2xl mx-auto">
                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded mb-8 text-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <input type="text" name="name" placeholder="{{ $contactForm['namePlaceholder'] ?? 'Full Name' }}" required
                                    class="w-full px-4 py-3 border border-slate-200 rounded-sm text-sm focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand transition @error('name') border-red-400 @enderror"
                                    value="{{ old('name') }}">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="{{ $contactForm['emailPlaceholder'] ?? 'Email Address' }}" required
                                    class="w-full px-4 py-3 border border-slate-200 rounded-sm text-sm focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand transition @error('email') border-red-400 @enderror"
                                    value="{{ old('email') }}">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <input type="tel" name="phone" placeholder="{{ $contactForm['phonePlaceholder'] ?? 'Phone Number' }}"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-sm text-sm focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand transition"
                                    value="{{ old('phone') }}">
                            </div>
                            <div>
                                <select name="service" class="w-full px-4 py-3 border border-slate-200 rounded-sm text-sm text-slate-500 focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand transition">
                                    <option value="">{{ $contactForm['servicePlaceholder'] ?? 'Select Service' }}</option>
                                    @foreach($services as $svc)
                                    <option value="{{ $svc->title }}" {{ old('service') == $svc->title ? 'selected' : '' }}>{{ $svc->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <textarea name="message" rows="5" placeholder="{{ $contactForm['messagePlaceholder'] ?? 'Your Message' }}" required
                                class="w-full px-4 py-3 border border-slate-200 rounded-sm text-sm focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand transition resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="bg-primary-brand text-white text-[10px] font-black px-10 py-4 rounded-sm tracking-widest hover:bg-primary-700 transition-all shadow-lg shadow-primary-200">
                                {{ $contactForm['submitButton'] ?? 'SEND MESSAGE' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-slate-950 text-white pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20 mb-20">
                {{-- Col 1: Brand --}}
                <div class="space-y-8">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-primary-brand flex items-center justify-center rounded-sm rotate-45 hover:rotate-90 transition-transform duration-500">
                            <div class="w-5 h-5 border-2 border-white -rotate-45"></div>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span class="text-2xl font-black tracking-tighter text-white">NEXA <span class="text-primary-brand">TAX</span></span>
                            <span class="text-[0.6rem] font-bold tracking-[0.2em] uppercase text-primary-200">Consulting</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-xs uppercase tracking-wider font-light">
                        {{ $footer['description'] ?? 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.' }}
                    </p>
                </div>
                {{-- Col 2: Quick Links --}}
                <div class="space-y-8">
                    <h3 class="text-primary-brand font-bold uppercase tracking-widest text-sm">Quick Links</h3>
                    <ul class="space-y-4">
                        @foreach(($footer['quick_links'] ?? []) as $link)
                        <li><a href="{{ $link['url'] }}" class="text-slate-500 hover:text-white text-xs uppercase font-bold">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- Col 3: Contact --}}
                <div class="space-y-8">
                    <h3 class="text-primary-brand font-bold uppercase tracking-widest text-sm">Contact</h3>
                    <div class="space-y-3">
                        <p class="text-slate-400 text-xs">{{ $company['address'] ?? 'Jakarta, Indonesia' }}</p>
                        <p class="text-slate-400 text-xs">{{ $company['phone'] ?? '' }}</p>
                        <p class="text-slate-400 text-xs">{{ $company['email'] ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/5 pt-12 text-[10px] text-center">
                <p>&copy; {{ date('Y') }} NEXA TAX INDONESIA.</p>
            </div>
        </div>
    </footer>

    {{-- ==================== WHATSAPP FLOATING BUTTON ==================== --}}
    @php $waNumber = $whatsapp['number'] ?? '622180868212'; @endphp
    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer"
        class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white p-4 rounded-full shadow-2xl hover:scale-110 transition-transform animate-bounce"
        aria-label="Contact on WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>

</body>
</html>
