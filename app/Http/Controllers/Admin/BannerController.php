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
            'badge' => 'NEXA TAX INDONESIA', 'line3' => 'Active Creative', 'line4' => 'Emphatic', 'video' => '',
        ];
        return view('admin.banner', compact('banner'));
    }

    public function update(Request $request)
    {
        $oldBanner = optional(Setting::where('key', 'site.banner')->first())->value ?? [];
        $videoUrl = $oldBanner['video'] ?? '';

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $request->validate(['video_file' => 'file|mimes:mp4,webm|max:51200']);

            // Delete old video if exists
            if (!empty($videoUrl) && str_starts_with($videoUrl, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $videoUrl));
            }

            $path = $request->file('video_file')->store('uploads/banner', 'public');
            $videoUrl = '/storage/' . $path;
        }

        $data = [
            'badge' => $request->input('badge', 'NEXA TAX INDONESIA'),
            'line3' => $request->input('line3', 'Active Creative'),
            'line4' => $request->input('line4', 'Emphatic'),
            'video' => $videoUrl,
        ];

        Setting::updateOrCreate(['key' => 'site.banner'], ['value' => $data, 'type' => 'json', 'group' => 'banner', 'label' => 'Hero Banner']);

        return back()->with('success', 'Banner berhasil diperbarui.');
    }
}
