@extends('layouts.admin')
@section('title', 'Add Testimonial')

@section('content')
<form action="{{ route('admin.testimonials.store') }}" method="POST" class="max-w-xl">
    @csrf
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Quote</label>
            <textarea name="quote" rows="4" required class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ old('quote') }}</textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Author Name</label>
                <input type="text" name="author_name" value="{{ old('author_name') }}" required class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Title</label>
                <input type="text" name="author_title" value="{{ old('author_title') }}" placeholder="e.g. CEO" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Company</label>
                <input type="text" name="author_company" value="{{ old('author_company') }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Order</label>
            <input type="number" name="order" value="{{ old('order', 0) }}" class="w-32 px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            <label for="is_active" class="text-sm text-slate-700">Active</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2 rounded text-sm border text-slate-600 hover:bg-slate-50">Batal</a>
        </div>
    </div>
</form>
@endsection
