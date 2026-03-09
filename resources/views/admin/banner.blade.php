@extends('layouts.admin')
@section('title', 'Banner / Hero')

@section('content')
<form action="{{ route('admin.banner.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800">General</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Badge Text</label>
                <input type="text" name="badge" value="{{ $banner['badge'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Line 3</label>
                <input type="text" name="line3" value="{{ $banner['line3'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Line 4 (italic)</label>
                <input type="text" name="line4" value="{{ $banner['line4'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
    </div>

    @foreach(($banner['slides'] ?? []) as $i => $slide)
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800">Slide {{ $i + 1 }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tagline 1</label>
                <input type="text" name="slides[{{ $i }}][tagline_1]" value="{{ $slide['tagline_1'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tagline 2 (colored)</label>
                <input type="text" name="slides[{{ $i }}][tagline_2]" value="{{ $slide['tagline_2'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Slide Image</label>
            <input type="file" name="slides[{{ $i }}][image_file]" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
            <p class="text-xs text-slate-400 mt-1">PNG, JPG, WebP. Max 5MB. Kosongkan jika tidak ingin mengubah gambar.</p>
        </div>
        @if(!empty($slide['image']))
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Current Image</label>
            <img src="{{ $slide['image'] }}" alt="Preview Slide {{ $i + 1 }}" class="h-40 object-cover rounded border">
        </div>
        @endif
    </div>
    @endforeach

    <button type="submit" class="bg-primary-brand text-white font-bold px-8 py-3 rounded text-sm hover:bg-blue-700 transition">Simpan</button>
</form>
@endsection
