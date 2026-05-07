<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = Contact::latest();

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', $request->inquiry_type);
        }

        $contacts = $query->paginate(20);
        $statuses = Contact::STATUSES;
        $inquiryTypes = Contact::INQUIRY_TYPES;

        return view('admin.contacts.index', compact('contacts', 'statuses', 'inquiryTypes'));
    }

    public function show(Contact $contact): View
    {
        // Auto-mark as read on first open
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, Contact $contact): RedirectResponse
    {
        $request->validate([
            'status'      => 'required|in:' . implode(',', Contact::STATUSES),
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $data = ['status' => $request->status, 'admin_notes' => $request->admin_notes];

        if ($request->status === 'replied') {
            $data['replied_at'] = now();
        }

        $contact->update($data);

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Contact status updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted.');
    }
}
