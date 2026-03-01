<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        $logo = optional(Setting::where('key', 'site.logo')->first())->value ?? ['image' => null];
        return view('admin.logo', compact('logo'));
    }

    public function update(Request $request)
    {
        $request->validate(['logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048']);

        $old = optional(Setting::where('key', 'site.logo')->first())->value;
        if (!empty($old['image'])) {
            $oldPath = str_replace('/storage/', '', $old['image']);
            Storage::disk('public')->delete($oldPath);
        }

        $path = $request->file('logo')->store('uploads/logo', 'public');

        Setting::updateOrCreate(['key' => 'site.logo'], [
            'value' => ['image' => '/storage/' . $path],
            'type' => 'json', 'group' => 'branding', 'label' => 'Site Logo',
        ]);

        return back()->with('success', 'Logo berhasil diperbarui.');
    }

    public function destroy()
    {
        $setting = Setting::where('key', 'site.logo')->first();
        if ($setting && !empty($setting->value['image'])) {
            $path = str_replace('/storage/', '', $setting->value['image']);
            Storage::disk('public')->delete($path);
            $setting->update(['value' => ['image' => null]]);
        }
        return back()->with('success', 'Logo berhasil dihapus.');
    }
}
