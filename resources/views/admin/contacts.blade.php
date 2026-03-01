@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b">
            <tr>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Name</th>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Email</th>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Service</th>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Message</th>
                <th class="text-left px-6 py-3 font-semibold text-slate-600">Date</th>
                <th class="text-right px-6 py-3 font-semibold text-slate-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($contacts as $c)
            <tr class="{{ $c->is_read ? '' : 'bg-blue-50' }} hover:bg-slate-50">
                <td class="px-6 py-4 font-medium {{ $c->is_read ? '' : 'font-bold' }}">{{ $c->name }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $c->email }}</td>
                <td class="px-6 py-4 text-slate-500 text-xs">{{ $c->service ?? '-' }}</td>
                <td class="px-6 py-4 text-slate-500 max-w-xs truncate">{{ Str::limit($c->message, 60) }}</td>
                <td class="px-6 py-4 text-slate-400 text-xs">{{ $c->created_at->format('d M Y H:i') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    @if(!$c->is_read)
                    <form action="{{ route('admin.contacts.read', $c->id) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-green-600 hover:underline text-xs font-bold">Mark Read</button>
                    </form>
                    @endif
                    <form action="{{ route('admin.contacts.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-xs font-bold">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($contacts->hasPages())
<div class="mt-6">{{ $contacts->links() }}</div>
@endif
@endsection
