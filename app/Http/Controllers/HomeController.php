<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\ClientLogo;
use App\Models\Insight;

class HomeController extends Controller
{
    public function index()
    {
        $banner = optional(Setting::where('key', 'site.banner')->first())->value ?? [
            'slides' => [],
            'badge' => 'NEXA TAX INDONESIA',
            'line3' => 'Active Creative',
            'line4' => 'Emphatic',
        ];

        $company = optional(Setting::where('key', 'site.company')->first())->value ?? [
            'name' => 'NEXA TAX Indonesia',
            'tagline' => 'Integrity and Loyalty',
            'description' => 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.',
            'address' => 'Jakarta, Indonesia',
            'phone' => '+(62) 21-80868212',
            'email' => 'info@nexatax.com',
            'office_hours' => 'Mon-Fri 08:00 - 17:00',
        ];

        $menu = optional(Setting::where('key', 'site.menu')->first())->value ?? [
            ['label' => 'OUR FIRM', 'url' => '#ourfirm'],
            ['label' => 'ABOUT US', 'url' => '#consultation'],
            ['label' => 'PRACTICE AREA', 'url' => '#practicearea'],
            ['label' => 'TESTIMONIALS', 'url' => '#testimonials'],
            ['label' => 'CONTACT', 'url' => '#contact'],
        ];

        $ourfirm = optional(Setting::where('key', 'site.ourfirm')->first())->value ?? [
            'title' => 'Our Firm',
            'cards' => [],
        ];

        $consultation = optional(Setting::where('key', 'site.consultation')->first())->value ?? [
            'heading' => "Let's Consult With Our",
            'heading_highlight' => 'Leading Experts.',
            'image' => '',
        ];

        $stats = optional(Setting::where('key', 'site.stats')->first())->value ?? [
            'projects' => 111,
            'projects_label' => 'Project Completed',
            'experience' => '5 +',
            'experience_label' => 'Years Experience',
        ];

        $social = optional(Setting::where('key', 'site.social')->first())->value ?? [
            'facebook' => '#',
            'instagram' => '#',
        ];

        $whatsapp = optional(Setting::where('key', 'site.whatsapp')->first())->value ?? [
            'number' => '622180868212',
            'message' => '',
        ];

        $footer = optional(Setting::where('key', 'site.footer')->first())->value ?? [
            'description' => 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.',
            'quick_links' => [],
        ];

        $contactForm = optional(Setting::where('key', 'site.contactForm')->first())->value ?? [
            'title' => 'Get In Touch',
            'subtitle' => 'Send us a message and we will get back to you shortly.',
        ];

        $services = Service::where('is_active', true)->orderBy('order')->get();

        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();

        $logo = optional(Setting::where('key', 'site.logo')->first())->value ?? ['image' => null];

        $clientLogos = ClientLogo::where('is_active', 1)->orderBy('order')->get();

        $insights = Insight::where('is_active', 1)->orderBy('order')->take(3)->get();

        return view('home', compact(
            'banner', 'company', 'menu', 'ourfirm', 'consultation',
            'stats', 'social', 'whatsapp', 'footer', 'contactForm',
            'services', 'testimonials', 'logo', 'clientLogos', 'insights'
        ));
    }
}
