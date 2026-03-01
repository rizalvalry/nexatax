@extends('layouts.admin')
@section('title', 'Edit Service')

@section('content')
<form action="{{ route('admin.services.update', $service) }}" method="POST" class="max-w-xl">
    @csrf @method('PUT')
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Order</label>
            <input type="number" name="order" value="{{ old('order', $service->order) }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="text-sm text-slate-700">Active</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Update</button>
            <a href="{{ route('admin.services.index') }}" class="px-6 py-2 rounded text-sm border text-slate-600 hover:bg-slate-50">Batal</a>
        </div>
    </div>
</form>
@endsection
