<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientLogoController extends Controller
{
    public function index()
    {
        $logos = ClientLogo::orderBy('order')->get();
        return view('admin.client-logos.index', compact('logos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('uploads/client-logos', 'public');

        ClientLogo::create([
            'name' => $request->input('name'),
            'image' => '/storage/' . $path,
            'order' => ClientLogo::max('order') + 1,
            'is_active' => true,
        ]);

        return back()->with('success', 'Client logo berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $logo = ClientLogo::findOrFail($id);
        if (!empty($logo->image) && str_starts_with($logo->image, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $logo->image));
        }
        $logo->delete();

        return back()->with('success', 'Client logo berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->input('order', []) as $id => $order) {
            ClientLogo::where('id', $id)->update(['order' => $order]);
        }
        return back()->with('success', 'Urutan berhasil diperbarui.');
    }
}
