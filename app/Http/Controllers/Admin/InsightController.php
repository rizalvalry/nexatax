<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InsightController extends Controller
{
    public function index()
    {
        $insights = Insight::orderBy('order')->get();
        return view('admin.insights.index', compact('insights'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg,webp|max:5120',
            'badge' => 'nullable|string|max:100',
            'published_date' => 'nullable|date',
        ]);

        $path = $request->file('thumbnail')->store('uploads/insights', 'public');

        Insight::create([
            'title' => $request->input('title'),
            'thumbnail' => '/storage/' . $path,
            'badge' => $request->input('badge'),
            'published_date' => $request->input('published_date'),
            'order' => Insight::max('order') + 1,
        ]);

        return back()->with('success', 'Insight berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $insight = Insight::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'badge' => 'nullable|string|max:100',
            'published_date' => 'nullable|date',
        ]);

        $data = [
            'title' => $request->input('title'),
            'badge' => $request->input('badge'),
            'published_date' => $request->input('published_date'),
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old
            if (!empty($insight->thumbnail) && str_starts_with($insight->thumbnail, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $insight->thumbnail));
            }
            $path = $request->file('thumbnail')->store('uploads/insights', 'public');
            $data['thumbnail'] = '/storage/' . $path;
        }

        $insight->update($data);

        return back()->with('success', 'Insight berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $insight = Insight::findOrFail($id);
        if (!empty($insight->thumbnail) && str_starts_with($insight->thumbnail, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $insight->thumbnail));
        }
        $insight->delete();

        return back()->with('success', 'Insight berhasil dihapus.');
    }
}
