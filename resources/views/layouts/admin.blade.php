<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - NEXA TAX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }, colors: { primary: { brand: '#007AFF', 700: '#0369a1' } } } }
        }
    </script>
    <style>
        /* Sidebar custom scrollbar — thin, blends with dark bg */
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(148,163,184,0.15) transparent;
        }
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
            margin: 8px 0;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(148,163,184,0.15);
            border-radius: 100px;
        }
        .sidebar-scroll:hover::-webkit-scrollbar-thumb {
            background: rgba(148,163,184,0.3);
        }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(148,163,184,0.45);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans" x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 fixed inset-y-0 left-0 z-30 transform transition-transform lg:translate-x-0 flex flex-col"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="p-6 border-b border-slate-800 flex-shrink-0">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary-brand flex items-center justify-center rounded-sm rotate-45">
                        <div class="w-4 h-4 border-2 border-white -rotate-45"></div>
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="text-lg font-black tracking-tighter">NEXA <span class="text-primary-brand">TAX</span></span>
                        <span class="text-[8px] font-bold tracking-[0.15em] text-slate-400">ADMIN PANEL</span>
                    </div>
                </div>
            </div>
            <nav class="p-4 space-y-1 flex-1 overflow-y-auto sidebar-scroll">
                @php $current = request()->route()->getName(); @endphp
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'dashboard') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.banner.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'banner') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 8 10 6 10-6"/></svg>
                    Banner / Hero
                </a>
                <a href="{{ route('admin.about.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'about') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    Company Info
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'services') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    Services
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'testimonials') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Testimonials
                </a>
                <a href="{{ route('admin.client-logos.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'client-logos') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Client Logos
                </a>
                <a href="{{ route('admin.insights.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'insights') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
                    Featured Insights
                </a>
                <a href="{{ route('admin.logo.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'logo.') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    Logo
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'settings') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    Settings
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded text-sm {{ str_contains($current, 'contacts') ? 'bg-primary-brand text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Contact Messages
                    @php $unread = \App\Models\ContactSubmission::where('is_read', false)->count(); @endphp
                    @if($unread > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unread }}</span>
                    @endif
                </a>

                <div class="pt-4 mt-4 border-t border-slate-800">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded text-sm text-slate-300 hover:bg-slate-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        View Website
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded text-sm text-red-400 hover:bg-slate-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-64">
            <header class="bg-white border-b px-6 py-4 flex items-center justify-between">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <h1 class="text-lg font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
                <div class="text-sm text-slate-500">{{ Auth::user()->name }}</div>
            </header>
            <main class="p-6">
                @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6 text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6 text-sm">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Overlay for mobile sidebar --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 lg:hidden" x-transition.opacity></div>
</body>
</html>
