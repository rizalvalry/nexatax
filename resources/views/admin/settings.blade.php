@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
<div class="space-y-8">
    {{-- Stats --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="section" value="stats">
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-lg">Statistics</h3>
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
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Experience</label>
                    <input type="text" name="experience" value="{{ $stats['experience'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Experience Label</label>
                    <input type="text" name="experience_label" value="{{ $stats['experience_label'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
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
