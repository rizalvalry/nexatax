<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@nexatax.com',
            'password' => Hash::make('password'),
        ]);

        // === SETTINGS ===

        // Banner / Hero slides
        Setting::create([
            'key' => 'site.banner',
            'value' => [
                'slides' => [
                    [
                        'tagline_1' => 'Honesty',
                        'tagline_2' => 'Innovative',
                        'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    ],
                    [
                        'tagline_1' => 'Strategic',
                        'tagline_2' => 'Excellence',
                        'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    ],
                    [
                        'tagline_1' => 'Global',
                        'tagline_2' => 'Compliance',
                        'image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    ],
                ],
                'badge' => 'NEXA TAX INDONESIA',
                'line3' => 'Active Creative',
                'line4' => 'Emphatic',
            ],
            'type' => 'json',
            'group' => 'banner',
            'label' => 'Hero Banner',
        ]);

        // Company info
        Setting::create([
            'key' => 'site.company',
            'value' => [
                'name' => 'NEXA TAX Indonesia',
                'tagline' => 'Integrity and Loyalty',
                'description' => 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.',
                'address' => 'Jakarta, Indonesia',
                'phone' => '+(62) 21-80868212',
                'email' => 'info@nexatax.com',
                'office_hours' => 'Mon-Fri 08:00 - 17:00',
            ],
            'type' => 'json',
            'group' => 'company',
            'label' => 'Company Info',
        ]);

        // Navigation menu
        Setting::create([
            'key' => 'site.menu',
            'value' => [
                ['label' => 'OUR FIRM', 'url' => '#ourfirm'],
                ['label' => 'ABOUT US', 'url' => '#consultation'],
                ['label' => 'PRACTICE AREA', 'url' => '#practicearea'],
                ['label' => 'TESTIMONIALS', 'url' => '#testimonials'],
                ['label' => 'CONTACT', 'url' => '#contact'],
            ],
            'type' => 'json',
            'group' => 'navigation',
            'label' => 'Header Menu',
        ]);

        // Our Firm section
        Setting::create([
            'key' => 'site.ourfirm',
            'value' => [
                'title' => 'Our Firm',
                'cards' => [
                    [
                        'title' => 'Quick and Efficient Solutions',
                        'description' => 'At NEXA TAX, our team of professionals provide all the most essential tax related services.',
                    ],
                    [
                        'title' => 'Our Philosophy',
                        'description' => 'Tax Dispute and Litigation can be laden with emotion and uncertainty. Our attorneys are here.',
                    ],
                    [
                        'title' => 'Our Achievements',
                        'description' => 'When you choose to work with NEXA TAX, you are choosing some of the best Tax Lawyers.',
                    ],
                ],
            ],
            'type' => 'json',
            'group' => 'sections',
            'label' => 'Our Firm Section',
        ]);

        // Consultation section
        Setting::create([
            'key' => 'site.consultation',
            'value' => [
                'heading' => "Let's Consult With Our",
                'heading_highlight' => 'Leading Experts.',
                'image' => 'https://images.unsplash.com/photo-1518458028785-8fbcd101ebb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
            ],
            'type' => 'json',
            'group' => 'sections',
            'label' => 'Consultation Section',
        ]);

        // Stats
        Setting::create([
            'key' => 'site.stats',
            'value' => [
                'projects' => 111,
                'projects_label' => 'Project Completed',
                'experience' => '5 +',
                'experience_label' => 'Years Experience',
            ],
            'type' => 'json',
            'group' => 'stats',
            'label' => 'Statistics',
        ]);

        // Social media
        Setting::create([
            'key' => 'site.social',
            'value' => [
                'facebook' => '#',
                'instagram' => '#',
            ],
            'type' => 'json',
            'group' => 'social',
            'label' => 'Social Media Links',
        ]);

        // WhatsApp
        Setting::create([
            'key' => 'site.whatsapp',
            'value' => [
                'number' => '622180868212',
                'message' => 'Halo NEXA TAX, saya ingin konsultasi.',
            ],
            'type' => 'json',
            'group' => 'contact',
            'label' => 'WhatsApp',
        ]);

        // Footer
        Setting::create([
            'key' => 'site.footer',
            'value' => [
                'description' => 'NEXA TAX aspires to be the foremost innovative Tax Consulting Firm.',
                'quick_links' => [
                    ['label' => 'Our Firm', 'url' => '#ourfirm'],
                    ['label' => 'Practice Area', 'url' => '#practicearea'],
                    ['label' => 'Career', 'url' => '#contact'],
                ],
            ],
            'type' => 'json',
            'group' => 'footer',
            'label' => 'Footer',
        ]);

        // Logo
        Setting::create([
            'key' => 'site.logo',
            'value' => ['image' => null],
            'type' => 'json',
            'group' => 'branding',
            'label' => 'Site Logo',
        ]);

        // Contact form settings
        Setting::create([
            'key' => 'site.contactForm',
            'value' => [
                'title' => 'Get In Touch',
                'subtitle' => 'Send us a message and we will get back to you shortly.',
                'namePlaceholder' => 'Full Name',
                'emailPlaceholder' => 'Email Address',
                'phonePlaceholder' => 'Phone Number',
                'servicePlaceholder' => 'Select Service',
                'messagePlaceholder' => 'Your Message',
                'submitButton' => 'Send Message',
            ],
            'type' => 'json',
            'group' => 'contact',
            'label' => 'Contact Form',
        ]);

        // === SERVICES (Practice Area) ===
        $services = [
            'TAX AUDIT REPRESENTATION',
            'TAX OBJECTION',
            'TAX APPEAL & TAX LAWSUIT',
            'RECONSIDERATION',
            'TRANSFER PRICING',
            'TAX COMPLIANCE SERVICE',
            'TAX ADVISORY SERVICES',
        ];

        foreach ($services as $i => $title) {
            Service::create([
                'title' => $title,
                'order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // === TESTIMONIALS ===
        Testimonial::create([
            'quote' => 'NEXA TAX has been a game changer for our business compliance. Their team is incredibly proactive.',
            'author_name' => 'Amanda Seyfried',
            'author_title' => 'Founder & CEO',
            'author_company' => 'Arcade Systems',
            'order' => 1,
            'is_active' => true,
        ]);
    }
}
