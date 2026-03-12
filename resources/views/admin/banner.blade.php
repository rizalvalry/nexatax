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

    {{-- Video Banner --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800">Banner Video</h3>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Upload Video</label>
            <input type="file" name="video_file" accept="video/mp4,video/webm" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
            <p class="text-xs text-slate-400 mt-1">MP4 atau WebM. Max 50MB. Kosongkan jika tidak ingin mengubah video.</p>
        </div>
        @if(!empty($banner['video']))
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Video Saat Ini</label>
            <video src="{{ $banner['video'] }}" class="h-48 rounded border" controls muted></video>
        </div>
        @else
        <p class="text-xs text-slate-500">Belum ada video. Menggunakan video default.</p>
        @endif
    </div>

    <button type="submit" class="bg-primary-brand text-white font-bold px-8 py-3 rounded text-sm hover:bg-blue-700 transition">Simpan</button>
</form>
@endsection
