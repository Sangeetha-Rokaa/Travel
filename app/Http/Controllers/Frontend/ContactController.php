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
use App\Mail\ContactUserReplyMail;
use App\Mail\ContactAdminNotificationMail;
use App\Services\MailConfigService;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index(): View
    {
        $treks    = Trek::active()->ordered()->pluck('name', 'id');
        $packages = Package::active()->ordered()->pluck('name', 'id');

        return view('frontend.contact.index', compact('treks', 'packages'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'nullable|string|max:50',
            'country'         => 'nullable|string|max:100',
            'subject'         => 'required|string|max:255',
            'inquiry_type'    => 'required|in:general,trek,package,custom',
            'trek_or_package' => 'nullable|string|max:255',
            'travel_date'     => 'nullable|date',
            'group_size'      => 'nullable|integer|min:1|max:100',
            'message'         => 'required|string',
        ]);

        $contact = Contact::create($data);

        // Load DB settings into Laravel config
        MailConfigService::load();

        // Resolve from — column is from_address, not mail_from_address
        $fromAddress = MailConfigService::get('from_address')
            ?: env('MAIL_FROM_ADDRESS', 'no-reply@visitnepal.com');

        $fromName = MailConfigService::get('from_name')
            ?: env('MAIL_FROM_NAME', 'Visit Nepal');

        $adminEmail = MailConfigService::get('from_address')
            ?: env('MAIL_FROM_ADDRESS', $fromAddress);

        try {
            Mail::to($adminEmail)
                ->send(new ContactAdminNotificationMail($contact, $fromAddress, $fromName));

            Mail::to($contact->email)
                ->send(new ContactFormMail($contact, $fromAddress, $fromName));
        } catch (\Exception $e) {
            \Log::error('Contact mail failed: ' . $e->getMessage());
            return back()->with('error', 'Message saved but email could not be sent. Please try again later.');
        }

        return back()->with('success', 'Your message has been sent. We will get back to you soon!');
    }
}
