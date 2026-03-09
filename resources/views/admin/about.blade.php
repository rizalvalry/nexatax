@extends('layouts.admin')
@section('title', 'Company Info')

@section('content')
<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    {{-- Company --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800 text-lg">Company Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Company Name</label>
                <input type="text" name="company_name" value="{{ $company['name'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tagline</label>
                <input type="text" name="company_tagline" value="{{ $company['tagline'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                <textarea name="company_description" rows="3" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ $company['description'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Address</label>
                <input type="text" name="company_address" value="{{ $company['address'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Phone</label>
                <input type="text" name="company_phone" value="{{ $company['phone'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="company_email" value="{{ $company['email'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Office Hours</label>
                <input type="text" name="company_office_hours" value="{{ $company['office_hours'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
    </div>

    {{-- Our Firm --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800 text-lg">Our Firm Section</h3>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Section Title</label>
            <input type="text" name="ourfirm_title" value="{{ $ourfirm['title'] ?? 'Our Firm' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
        </div>
        @foreach(($ourfirm['cards'] ?? []) as $i => $card)
        <div class="border rounded p-4 space-y-2">
            <label class="block text-sm font-bold text-slate-600">Card {{ $i + 1 }}</label>
            <input type="text" name="cards[{{ $i }}][title]" value="{{ $card['title'] ?? '' }}" placeholder="Title" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            <textarea name="cards[{{ $i }}][description]" rows="2" placeholder="Description" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ $card['description'] ?? '' }}</textarea>
        </div>
        @endforeach
    </div>

    {{-- Consultation --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800 text-lg">Consultation Section</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Heading</label>
                <input type="text" name="consultation_heading" value="{{ $consultation['heading'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Heading Highlight</label>
                <input type="text" name="consultation_highlight" value="{{ $consultation['heading_highlight'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Consultation Image</label>
            <input type="file" name="consultation_image_file" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
            <p class="text-xs text-slate-400 mt-1">PNG, JPG, WebP. Max 5MB. Kosongkan jika tidak ingin mengubah gambar.</p>
        </div>
        @if(!empty($consultation['image']))
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Current Image</label>
            <img src="{{ $consultation['image'] }}" alt="Consultation Preview" class="h-40 object-cover rounded border">
        </div>
        @endif
    </div>

    <button type="submit" class="bg-primary-brand text-white font-bold px-8 py-3 rounded text-sm hover:bg-blue-700 transition">Simpan</button>
</form>
@endsection
