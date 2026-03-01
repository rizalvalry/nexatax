<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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

        foreach ($request->input('slides', []) as $slide) {
            $data['slides'][] = [
                'tagline_1' => $slide['tagline_1'] ?? '',
                'tagline_2' => $slide['tagline_2'] ?? '',
                'image' => $slide['image'] ?? '',
            ];
        }

        Setting::updateOrCreate(['key' => 'site.banner'], ['value' => $data, 'type' => 'json', 'group' => 'banner', 'label' => 'Hero Banner']);

        return back()->with('success', 'Banner berhasil diperbarui.');
    }
}
