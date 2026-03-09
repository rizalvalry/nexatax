@extends('layouts.admin')
@section('title', 'Featured Insights')

@section('content')
<div class="space-y-6">
    {{-- Add New Insight --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-slate-800 mb-4">Add New Insight</h3>
        <form action="{{ route('admin.insights.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Title *</label>
                    <input type="text" name="title" required placeholder="e.g. PMK 53/2025 Resmi Berlaku..." class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Badge Label</label>
                    <input type="text" name="badge" placeholder="e.g. NEXA TAX" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Thumbnail Image *</label>
                    <input type="file" name="thumbnail" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, WebP. Max 5MB.</p>
                    @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Published Date</label>
                    <input type="date" name="published_date" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                </div>
            </div>
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Tambah Insight</button>
        </form>
    </div>

    {{-- Existing Insights --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-slate-800 mb-4">Current Insights ({{ $insights->count() }})</h3>
        @if($insights->isEmpty())
            <p class="text-slate-400 text-sm">Belum ada insight. Tambah insight pertama di atas.</p>
        @else
            <div class="space-y-4">
                @foreach($insights as $insight)
                <div class="border rounded-lg p-4 flex flex-col md:flex-row gap-4 items-start">
                    @if($insight->thumbnail)
                    <img src="{{ $insight->thumbnail }}" alt="{{ $insight->title }}" class="w-32 h-20 object-cover rounded flex-shrink-0">
                    @endif
                    <div class="flex-1">
                        <form action="{{ route('admin.insights.update', $insight->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <input type="text" name="title" value="{{ $insight->title }}" class="w-full px-3 py-1.5 border rounded text-sm focus:outline-none focus:border-primary-brand">
                                </div>
                                <div>
                                    <input type="text" name="badge" value="{{ $insight->badge }}" placeholder="Badge" class="w-full px-3 py-1.5 border rounded text-sm focus:outline-none focus:border-primary-brand">
                                </div>
                                <div>
                                    <input type="date" name="published_date" value="{{ $insight->published_date?->format('Y-m-d') }}" class="w-full px-3 py-1.5 border rounded text-sm focus:outline-none focus:border-primary-brand">
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <input type="file" name="thumbnail" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700">
                                <button type="submit" class="bg-primary-brand text-white font-bold px-4 py-1.5 rounded text-xs hover:bg-blue-700 transition">Update</button>
                            </div>
                        </form>
                    </div>
                    <form action="{{ route('admin.insights.destroy', $insight->id) }}" method="POST" onsubmit="return confirm('Hapus insight ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 text-xs font-bold hover:underline">Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
