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
        $map = optional(Setting::where('key', 'site.map')->first())->value ?? [];

        return view('admin.settings', compact('stats', 'social', 'whatsapp', 'footer', 'menu', 'contactForm', 'map'));
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
        } elseif ($section === 'map') {
            $mapUrl = $request->input('map_url', '');
            $embedUrl = $this->convertToEmbedUrl($mapUrl);

            Setting::updateOrCreate(['key' => 'site.map'], [
                'value' => [
                    'url' => $mapUrl,
                    'embed_url' => $embedUrl,
                    'label' => $request->input('map_label', ''),
                ],
                'type' => 'json', 'group' => 'map', 'label' => 'Google Maps',
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

    private function convertToEmbedUrl(string $url): string
    {
        if (empty($url)) {
            return '';
        }

        // Already an embed URL
        if (str_contains($url, 'google.com/maps/embed')) {
            return $url;
        }

        // Extract place/coordinates from various Google Maps URL formats
        // Format: https://www.google.com/maps/place/.../@lat,lng,zoom
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
            $lat = $matches[1];
            $lng = $matches[2];
            return "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3000!2d{$lng}!3d{$lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1";
        }

        // Short link or other format - use the place query embed
        // Extract place ID or query from URL
        if (preg_match('/place\/([^\/\?@]+)/', $url, $matches)) {
            $query = urlencode(str_replace('+', ' ', $matches[1]));
            return "https://www.google.com/maps/embed/v1/place?key=&q={$query}";
        }

        // For short links (maps.app.goo.gl) or unrecognized formats, use search embed
        // We'll encode the entire URL as a query parameter
        $encodedUrl = urlencode($url);
        return "https://maps.google.com/maps?q={$encodedUrl}&output=embed";
    }
}
