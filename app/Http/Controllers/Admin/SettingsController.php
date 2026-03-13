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
        $career = optional(Setting::where('key', 'site.career')->first())->value ?? [];
        $servicesSection = optional(Setting::where('key', 'site.servicesSection')->first())->value ?? [];

        return view('admin.settings', compact('stats', 'social', 'whatsapp', 'footer', 'menu', 'contactForm', 'map', 'career', 'servicesSection'));
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
        } elseif ($section === 'career') {
            Setting::updateOrCreate(['key' => 'site.career'], [
                'value' => [
                    'title' => $request->input('career_title', 'Career'),
                    'subtitle' => $request->input('career_subtitle', 'Open Position'),
                    'description' => $request->input('career_description', ''),
                    'email' => $request->input('career_email', ''),
                ],
                'type' => 'json', 'group' => 'career', 'label' => 'Career',
            ]);
        } elseif ($section === 'servicesSection') {
            Setting::updateOrCreate(['key' => 'site.servicesSection'], [
                'value' => [
                    'label' => $request->input('services_label', 'Our Practice Areas'),
                    'heading' => $request->input('services_heading', ''),
                    'heading_highlight' => $request->input('services_heading_highlight', ''),
                    'description' => $request->input('services_description', ''),
                ],
                'type' => 'json', 'group' => 'sections', 'label' => 'Services Section',
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

        // Extract place name and coordinates from full Google Maps URL
        // Format: https://www.google.com/maps/place/Place+Name/@lat,lng,zoom
        if (preg_match('/place\/([^\/\?@]+)/', $url, $placeMatch)) {
            $placeName = urldecode(str_replace('+', ' ', $placeMatch[1]));

            // Also try to extract coordinates for precision
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $coordMatch)) {
                $query = urlencode($placeName) . '&center=' . $coordMatch[1] . ',' . $coordMatch[2];
            } else {
                $query = urlencode($placeName);
            }

            return "https://maps.google.com/maps?q=" . urlencode($placeName) . "&t=&z=17&ie=UTF8&iwloc=&output=embed";
        }

        // Extract coordinates from URL with @lat,lng
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
            return "https://maps.google.com/maps?q={$matches[1]},{$matches[2]}&t=&z=17&ie=UTF8&iwloc=&output=embed";
        }

        // For short links or any other format, use query embed
        $query = urlencode($url);
        return "https://maps.google.com/maps?q={$query}&t=&z=17&ie=UTF8&iwloc=&output=embed";
    }
}
