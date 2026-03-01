@extends('layouts.admin')
@section('title', 'Services / Practice Area')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-slate-500">{{ $services->count() }} services</p>
    <a href="{{ route('admin.services.create') }}" class="bg-primary-brand text-white font-bold px-6 py-2 rounded text-sm hover:bg-blue-700 transition">+ Add Service</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b">
            <tr>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Order</th>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Title</th>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Status</th>
                <th class="text-right px-6 py-3 font-semibold text-slate-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($services as $service)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 text-slate-500">{{ $service->order }}</td>
                <td class="px-6 py-4 font-medium">{{ $service->title }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-xs font-bold {{ $service->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.services.edit', $service) }}" class="text-primary-brand hover:underline text-xs font-bold">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Hapus service ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-xs font-bold">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
