@extends('layouts.admin')
@section('title', 'Logo')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        @if(!empty($logo['image']))
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Current Logo</label>
            <img src="{{ $logo['image'] }}" alt="Logo" class="h-20 object-contain bg-slate-50 p-2 rounded">
            <form action="{{ route('admin.logo.destroy') }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus logo?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-500 text-xs font-bold hover:underline">Remove Logo</button>
            </form>
        </div>
        @endif

        <form action="{{ route('admin.logo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Upload Logo</label>
                <input type="file" name="logo" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
                <p class="text-xs text-slate-400 mt-1">PNG, JPG, SVG, WebP. Max 2MB.</p>
                @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Upload</button>
        </form>
    </div>
</div>
@endsection
