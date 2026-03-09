@extends('layouts.admin')
@section('title', 'Client Logos')

@section('content')
<div class="space-y-6">
    {{-- Upload New --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-slate-800 mb-4">Add Client Logo</h3>
        <form action="{{ route('admin.client-logos.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-end gap-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Client Name (optional)</label>
                <input type="text" name="name" placeholder="e.g. RUSAL" class="px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand w-48">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Logo Image *</label>
                <input type="file" name="image" accept="image/*" required class="text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Upload</button>
        </form>
        @error('image') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
        <p class="text-xs text-slate-400 mt-2">PNG, JPG, SVG, WebP. Max 2MB. Disarankan format transparan (PNG/SVG).</p>
    </div>

    {{-- Existing Logos --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-slate-800 mb-4">Current Client Logos ({{ $logos->count() }})</h3>
        @if($logos->isEmpty())
            <p class="text-slate-400 text-sm">Belum ada client logo. Upload logo pertama di atas.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($logos as $logo)
                <div class="border rounded-lg p-4 text-center group relative">
                    <img src="{{ $logo->image }}" alt="{{ $logo->name ?? 'Client' }}" class="h-12 mx-auto object-contain mb-2">
                    @if($logo->name)
                    <p class="text-xs text-slate-500 truncate">{{ $logo->name }}</p>
                    @endif
                    <form action="{{ route('admin.client-logos.destroy', $logo->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus logo ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 text-[10px] font-bold hover:underline">Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
