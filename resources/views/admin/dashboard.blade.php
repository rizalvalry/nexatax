@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-3xl font-black text-primary-brand">{{ $totalServices }}</div>
        <div class="text-sm text-slate-500 mt-1">Services</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-3xl font-black text-primary-brand">{{ $totalTestimonials }}</div>
        <div class="text-sm text-slate-500 mt-1">Testimonials</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-3xl font-black text-primary-brand">{{ $totalContacts }}</div>
        <div class="text-sm text-slate-500 mt-1">Total Messages</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-3xl font-black text-red-500">{{ $unreadContacts }}</div>
        <div class="text-sm text-slate-500 mt-1">Unread Messages</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('admin.banner.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition group">
        <h3 class="font-bold text-slate-800 group-hover:text-primary-brand">Banner / Hero</h3>
        <p class="text-sm text-slate-500 mt-1">Kelola hero slideshow</p>
    </a>
    <a href="{{ route('admin.about.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition group">
        <h3 class="font-bold text-slate-800 group-hover:text-primary-brand">Company Info</h3>
        <p class="text-sm text-slate-500 mt-1">Edit info perusahaan & Our Firm</p>
    </a>
    <a href="{{ route('admin.services.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition group">
        <h3 class="font-bold text-slate-800 group-hover:text-primary-brand">Services</h3>
        <p class="text-sm text-slate-500 mt-1">Kelola Practice Area</p>
    </a>
    <a href="{{ route('admin.settings.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition group">
        <h3 class="font-bold text-slate-800 group-hover:text-primary-brand">Settings</h3>
        <p class="text-sm text-slate-500 mt-1">Stats, Social Media, WhatsApp, Footer</p>
    </a>
</div>
@endsection
