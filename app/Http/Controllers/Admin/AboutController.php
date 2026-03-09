<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $company = optional(Setting::where('key', 'site.company')->first())->value ?? [];
        $ourfirm = optional(Setting::where('key', 'site.ourfirm')->first())->value ?? ['title' => 'Our Firm', 'cards' => []];
        $consultation = optional(Setting::where('key', 'site.consultation')->first())->value ?? [];
        return view('admin.about', compact('company', 'ourfirm', 'consultation'));
    }

    public function update(Request $request)
    {
        // Company info
        Setting::updateOrCreate(['key' => 'site.company'], [
            'value' => [
                'name' => $request->input('company_name'),
                'tagline' => $request->input('company_tagline'),
                'description' => $request->input('company_description'),
                'address' => $request->input('company_address'),
                'phone' => $request->input('company_phone'),
                'email' => $request->input('company_email'),
                'office_hours' => $request->input('company_office_hours'),
            ],
            'type' => 'json', 'group' => 'company', 'label' => 'Company Info',
        ]);

        // Our Firm
        $cards = [];
        foreach ($request->input('cards', []) as $card) {
            $cards[] = ['title' => $card['title'] ?? '', 'description' => $card['description'] ?? ''];
        }
        Setting::updateOrCreate(['key' => 'site.ourfirm'], [
            'value' => ['title' => $request->input('ourfirm_title', 'Our Firm'), 'cards' => $cards],
            'type' => 'json', 'group' => 'sections', 'label' => 'Our Firm Section',
        ]);

        // Consultation - handle image upload
        $oldConsultation = optional(Setting::where('key', 'site.consultation')->first())->value ?? [];
        $consultationImage = $oldConsultation['image'] ?? '';

        if ($request->hasFile('consultation_image_file')) {
            $request->validate(['consultation_image_file' => 'image|mimes:png,jpg,jpeg,webp|max:5120']);

            // Delete old image
            if (!empty($consultationImage) && str_starts_with($consultationImage, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $consultationImage));
            }

            $path = $request->file('consultation_image_file')->store('uploads/consultation', 'public');
            $consultationImage = '/storage/' . $path;
        }

        Setting::updateOrCreate(['key' => 'site.consultation'], [
            'value' => [
                'heading' => $request->input('consultation_heading'),
                'heading_highlight' => $request->input('consultation_highlight'),
                'image' => $consultationImage,
            ],
            'type' => 'json', 'group' => 'sections', 'label' => 'Consultation Section',
        ]);

        return back()->with('success', 'Data berhasil diperbarui.');
    }
}
