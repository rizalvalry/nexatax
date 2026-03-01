<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $stats = optional(Setting::where('key', 'site.stats')->first())->value ?? [];
        $social = optional(Setting::where('key', 'site.social')->first())->value ?? [];
        $whatsapp = optional(Setting::where('key', 'site.whatsapp')->first())->value ?? [];
        $footer = optional(Setting::where('key', 'site.footer')->first())->value ?? [];
        $menu = optional(Setting::where('key', 'site.menu')->first())->value ?? [];
        $contactForm = optional(Setting::where('key', 'site.contactForm')->first())->value ?? [];

        return view('admin.settings', compact('stats', 'social', 'whatsapp', 'footer', 'menu', 'contactForm'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section');

        if ($section === 'stats') {
            Setting::updateOrCreate(['key' => 'site.stats'], [
                'value' => [
                    'projects' => $request->input('projects'),
                    'projects_label' => $request->input('projects_label'),
                    'experience' => $request->input('experience'),
                    'experience_label' => $request->input('experience_label'),
                ],
                'type' => 'json', 'group' => 'stats', 'label' => 'Statistics',
            ]);
        } elseif ($section === 'social') {
            Setting::updateOrCreate(['key' => 'site.social'], [
                'value' => ['facebook' => $request->input('facebook'), 'instagram' => $request->input('instagram')],
                'type' => 'json', 'group' => 'social', 'label' => 'Social Media Links',
            ]);
        } elseif ($section === 'whatsapp') {
            Setting::updateOrCreate(['key' => 'site.whatsapp'], [
                'value' => ['number' => $request->input('wa_number'), 'message' => $request->input('wa_message')],
                'type' => 'json', 'group' => 'contact', 'label' => 'WhatsApp',
            ]);
        } elseif ($section === 'footer') {
            $links = [];
            foreach ($request->input('footer_links', []) as $link) {
                $links[] = ['label' => $link['label'] ?? '', 'url' => $link['url'] ?? '#'];
            }
            Setting::updateOrCreate(['key' => 'site.footer'], [
                'value' => ['description' => $request->input('footer_description'), 'quick_links' => $links],
                'type' => 'json', 'group' => 'footer', 'label' => 'Footer',
            ]);
        }

        return back()->with('success', 'Settings berhasil diperbarui.');
    }
}
