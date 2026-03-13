@extends('layouts.admin')
@section('title', 'Company Info')

@section('content')
<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    {{-- Company --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800 text-lg">Company Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Company Name</label>
                <input type="text" name="company_name" value="{{ $company['name'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tagline</label>
                <input type="text" name="company_tagline" value="{{ $company['tagline'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                <textarea name="company_description" rows="3" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">{{ $company['description'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Address</label>
                <input type="text" name="company_address" value="{{ $company['address'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Phone</label>
                <input type="text" name="company_phone" value="{{ $company['phone'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="company_email" value="{{ $company['email'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Office Hours</label>
                <input type="text" name="company_office_hours" value="{{ $company['office_hours'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
    </div>

    {{-- Our Firm --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4" x-data="ourfirmManager()">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-lg">Our Firm Section</h3>
            <button type="button" @click="addCard()" class="bg-green-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-green-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14m-7-7h14"/></svg>
                Tambah Card
            </button>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Section Title</label>
            <input type="text" name="ourfirm_title" value="{{ $ourfirm['title'] ?? 'Our Firm' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
        </div>

        <template x-for="(card, i) in cards" :key="i">
            <div class="border rounded p-4 space-y-3 relative">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-bold text-slate-600" x-text="'Card ' + (i + 1)"></label>
                    <button type="button" @click="removeCard(i)" class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1 transition" x-show="cards.length > 1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus
                    </button>
                </div>
                <input type="text" :name="'cards[' + i + '][title]'" x-model="card.title" placeholder="Title" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                <textarea :name="'cards[' + i + '][description]'" x-model="card.description" rows="2" placeholder="Description" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand"></textarea>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Button Text</label>
                        <input type="text" :name="'cards[' + i + '][button_text]'" x-model="card.button_text" placeholder="Free Consultation" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Button Link</label>
                        <input type="text" :name="'cards[' + i + '][button_url]'" x-model="card.button_url" placeholder="#contact" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
                    </div>
                </div>
                {{-- Hidden field for existing image --}}
                <input type="hidden" :name="'cards[' + i + '][existing_image]'" x-model="card.image">
            </div>
        </template>
    </div>

    <script>
        function ourfirmManager() {
            return {
                cards: @json($ourfirm['cards'] ?? []),
                addCard() {
                    this.cards.push({ title: '', description: '', button_text: '', button_url: '#contact', image: '' });
                },
                removeCard(index) {
                    if (confirm('Hapus card ini?')) {
                        this.cards.splice(index, 1);
                    }
                }
            }
        }
    </script>

    {{-- Consultation --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <h3 class="font-bold text-slate-800 text-lg">Consultation Section</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Heading</label>
                <input type="text" name="consultation_heading" value="{{ $consultation['heading'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Heading Highlight</label>
                <input type="text" name="consultation_highlight" value="{{ $consultation['heading_highlight'] ?? '' }}" class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:border-primary-brand">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Consultation Image</label>
            <input type="file" name="consultation_image_file" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-brand file:text-white hover:file:bg-blue-700">
            <p class="text-xs text-slate-400 mt-1">PNG, JPG, WebP. Max 5MB. Kosongkan jika tidak ingin mengubah gambar.</p>
        </div>
        @if(!empty($consultation['image']))
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Current Image</label>
            <img src="{{ $consultation['image'] }}" alt="Consultation Preview" class="h-40 object-cover rounded border">
        </div>
        @endif
    </div>

    <button type="submit" class="bg-primary-brand text-white font-bold px-8 py-3 rounded text-sm hover:bg-blue-700 transition">Simpan</button>
</form>
@endsection
