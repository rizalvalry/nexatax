<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banner = optional(Setting::where('key', 'site.banner')->first())->value ?? [
            'slides' => [], 'badge' => 'NEXA TAX INDONESIA', 'line3' => 'Active Creative', 'line4' => 'Emphatic',
        ];
        return view('admin.banner', compact('banner'));
    }

    public function update(Request $request)
    {
        $data = [
            'badge' => $request->input('badge', 'NEXA TAX INDONESIA'),
            'line3' => $request->input('line3', 'Active Creative'),
            'line4' => $request->input('line4', 'Emphatic'),
            'slides' => [],
        ];

        $oldBanner = optional(Setting::where('key', 'site.banner')->first())->value ?? ['slides' => []];
        $oldSlides = $oldBanner['slides'] ?? [];

        foreach ($request->input('slides', []) as $i => $slide) {
            $imageUrl = $oldSlides[$i]['image'] ?? '';

            // Handle file upload
            if ($request->hasFile("slides.{$i}.image_file")) {
                $request->validate(["slides.{$i}.image_file" => 'image|mimes:png,jpg,jpeg,webp|max:5120']);

                // Delete old image if exists
                if (!empty($imageUrl) && str_starts_with($imageUrl, '/storage/')) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $imageUrl));
                }

                $path = $request->file("slides.{$i}.image_file")->store('uploads/banner', 'public');
                $imageUrl = '/storage/' . $path;
            }

            $data['slides'][] = [
                'tagline_1' => $slide['tagline_1'] ?? '',
                'tagline_2' => $slide['tagline_2'] ?? '',
                'image' => $imageUrl,
            ];
        }

        Setting::updateOrCreate(['key' => 'site.banner'], ['value' => $data, 'type' => 'json', 'group' => 'banner', 'label' => 'Hero Banner']);

        return back()->with('success', 'Banner berhasil diperbarui.');
    }
}
