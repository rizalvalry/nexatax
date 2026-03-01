<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $contacts = ContactSubmission::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts', compact('contacts'));
    }

    public function markAsRead($id)
    {
        ContactSubmission::findOrFail($id)->update(['is_read' => true]);
        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy($id)
    {
        ContactSubmission::findOrFail($id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
