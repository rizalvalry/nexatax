@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
<div class="space-y-8">
    {{-- Services Section Text --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="servicesSection">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Services Section (Text)</h3>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Label (kecil, di atas heading)</label>
                <input type="text" name="services_label" value="{{ $servicesSection['label'] ?? 'Our Practice Areas' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Heading (teks utama)</label>
                <input type="text" name="services_heading" value="{{ $servicesSection['heading'] ?? 'We continue to provide the best services to all enterprises in' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Heading Highlight (teks warna biru)</label>
                <input type="text" name="services_heading_highlight" value="{{ $servicesSection['heading_highlight'] ?? 'Indonesia and even worldwide.' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi (paragraph di bawah heading)</label>
                <textarea name="services_description" rows="2" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ $servicesSection['description'] ?? 'Delivering comprehensive tax, legal, and business advisory solutions with integrity and professional excellence.' }}</textarea>
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan Services Text</button>
        </div>
    </form>

    {{-- Stats --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="stats">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Statistics</h3>
            <p class="text-xs text-slate-400">Icon ditampilkan di samping angka statistik pada section Consultation/Our Client.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Projects Count</label>
                    <input type="text" name="projects" value="{{ $stats['projects'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Projects Label</label>
                    <input type="text" name="projects_label" value="{{ $stats['projects_label'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Projects Icon</label>
                    <select name="projects_icon" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                        <option value="briefcase" {{ ($stats['projects_icon'] ?? 'briefcase') === 'briefcase' ? 'selected' : '' }}>Briefcase (Portofolio)</option>
                        <option value="clipboard-check" {{ ($stats['projects_icon'] ?? '') === 'clipboard-check' ? 'selected' : '' }}>Clipboard Check (Task Done)</option>
                        <option value="chart-bar" {{ ($stats['projects_icon'] ?? '') === 'chart-bar' ? 'selected' : '' }}>Chart Bar (Grafik)</option>
                        <option value="folder" {{ ($stats['projects_icon'] ?? '') === 'folder' ? 'selected' : '' }}>Folder (Dokumen)</option>
                        <option value="rocket" {{ ($stats['projects_icon'] ?? '') === 'rocket' ? 'selected' : '' }}>Rocket (Launch)</option>
                        <option value="check-circle" {{ ($stats['projects_icon'] ?? '') === 'check-circle' ? 'selected' : '' }}>Check Circle (Selesai)</option>
                        <option value="trophy" {{ ($stats['projects_icon'] ?? '') === 'trophy' ? 'selected' : '' }}>Trophy (Pencapaian)</option>
                        <option value="building" {{ ($stats['projects_icon'] ?? '') === 'building' ? 'selected' : '' }}>Building (Perusahaan)</option>
                        <option value="users" {{ ($stats['projects_icon'] ?? '') === 'users' ? 'selected' : '' }}>Users (Client)</option>
                        <option value="shield-check" {{ ($stats['projects_icon'] ?? '') === 'shield-check' ? 'selected' : '' }}>Shield Check (Terpercaya)</option>
                    </select>
                </div>
                <div></div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Experience</label>
                    <input type="text" name="experience" value="{{ $stats['experience'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Experience Label</label>
                    <input type="text" name="experience_label" value="{{ $stats['experience_label'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Experience Icon</label>
                    <select name="experience_icon" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                        <option value="clock" {{ ($stats['experience_icon'] ?? 'clock') === 'clock' ? 'selected' : '' }}>Clock (Waktu)</option>
                        <option value="calendar" {{ ($stats['experience_icon'] ?? '') === 'calendar' ? 'selected' : '' }}>Calendar (Tahun)</option>
                        <option value="star" {{ ($stats['experience_icon'] ?? '') === 'star' ? 'selected' : '' }}>Star (Bintang)</option>
                        <option value="award" {{ ($stats['experience_icon'] ?? '') === 'award' ? 'selected' : '' }}>Award (Penghargaan)</option>
                        <option value="trending-up" {{ ($stats['experience_icon'] ?? '') === 'trending-up' ? 'selected' : '' }}>Trending Up (Pertumbuhan)</option>
                        <option value="lightning" {{ ($stats['experience_icon'] ?? '') === 'lightning' ? 'selected' : '' }}>Lightning (Cepat)</option>
                        <option value="globe" {{ ($stats['experience_icon'] ?? '') === 'globe' ? 'selected' : '' }}>Globe (Global)</option>
                        <option value="heart" {{ ($stats['experience_icon'] ?? '') === 'heart' ? 'selected' : '' }}>Heart (Dedikasi)</option>
                        <option value="flag" {{ ($stats['experience_icon'] ?? '') === 'flag' ? 'selected' : '' }}>Flag (Milestone)</option>
                        <option value="sparkles" {{ ($stats['experience_icon'] ?? '') === 'sparkles' ? 'selected' : '' }}>Sparkles (Excellence)</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan Stats</button>
        </div>
    </form>

    {{-- WhatsApp --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="whatsapp">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">WhatsApp</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Number (tanpa +, contoh: 622180868212)</label>
                    <input type="text" name="wa_number" value="{{ $whatsapp['number'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Default Message</label>
                    <input type="text" name="wa_message" value="{{ $whatsapp['message'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan WhatsApp</button>
        </div>
    </form>

    {{-- Social Media --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="social">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Social Media</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Facebook URL</label>
                    <input type="text" name="facebook" value="{{ $social['facebook'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Instagram URL</label>
                    <input type="text" name="instagram" value="{{ $social['instagram'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan Social Media</button>
        </div>
    </form>

    {{-- Google Maps --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="map">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Google Maps</h3>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Google Maps URL</label>
                <input type="text" name="map_url" value="{{ $map['url'] ?? '' }}" placeholder="https://maps.app.goo.gl/... atau https://www.google.com/maps/embed?..." class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                <p class="text-xs text-slate-400 mt-1">Paste link Google Maps (share link atau embed link). Contoh: https://maps.app.goo.gl/ciKg7T4MQhTrzXeW8</p>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Label Lokasi</label>
                <input type="text" name="map_label" value="{{ $map['label'] ?? '' }}" placeholder="Nama kantor / lokasi" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            @if(!empty($map['url']))
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Preview</label>
                <iframe src="{{ $map['embed_url'] ?? '' }}" width="100%" height="200" style="border:0; border-radius:8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            @endif
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan Maps</button>
        </div>
    </form>

    {{-- Footer --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="footer">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Footer</h3>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Footer Description</label>
                <textarea name="footer_description" rows="2" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ $footer['description'] ?? '' }}</textarea>
            </div>
            <h4 class="font-semibold text-slate-700 text-sm">Quick Links</h4>
            @foreach(($footer['quick_links'] ?? []) as $i => $link)
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="footer_links[{{ $i }}][label]" value="{{ $link['label'] ?? '' }}" placeholder="Label" class="px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                <input type="text" name="footer_links[{{ $i }}][url]" value="{{ $link['url'] ?? '' }}" placeholder="URL" class="px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            @endforeach
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan Footer</button>
        </div>
    </form>

    {{-- Career --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="career">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Career (Footer)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Title</label>
                    <input type="text" name="career_title" value="{{ $career['title'] ?? 'Career' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Subtitle</label>
                    <input type="text" name="career_subtitle" value="{{ $career['subtitle'] ?? 'Open Position' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                <textarea name="career_description" rows="2" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ $career['description'] ?? 'Ready for New Challenge? Apply Now!' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Recruitment Email</label>
                <input type="email" name="career_email" value="{{ $career['email'] ?? '' }}" placeholder="recruitment@nexataxindonesia.com" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan Career</button>
        </div>
    </form>
</div>
@endsection
