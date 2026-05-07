<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Trek;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $treks    = Trek::active()->ordered()->pluck('name', 'id');
        $packages = Package::active()->ordered()->pluck('name', 'id');

        return view('frontend.contact.index', compact('treks', 'packages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|max:150',
            'phone'            => 'nullable|string|max:30',
            'country'          => 'nullable|string|max:100',
            'subject'          => 'required|string|max:200',
            'message'          => 'required|string|max:2000',
            'inquiry_type'     => 'required|in:general,trek,package,custom',
            'trek_or_package'  => 'nullable|string|max:200',
            'travel_date'      => 'nullable|date|after:today',
            'group_size'       => 'nullable|integer|min:1|max:100',
        ]);

        Contact::create($validated);

        // Optionally send notification email to admin
        // Mail::to(config('mail.admin_address'))->send(new NewContactMail($contact));

        return redirect()
            ->route('contact.index')
            ->with('success', 'Thank you! We will get back to you within 24 hours.');
    }
}
