<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\ContactSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalTestimonials = Testimonial::count();
        $totalContacts = ContactSubmission::count();
        $unreadContacts = ContactSubmission::where('is_read', false)->count();

        return view('admin.dashboard', compact('totalServices', 'totalTestimonials', 'totalContacts', 'unreadContacts'));
    }
}
