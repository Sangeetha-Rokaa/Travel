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

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'country'       => 'nullable|string|max:100',
            'subject'       => 'required|string|max:255',
            'inquiry_type'  => 'required|in:general,trek,package,custom',
            'trek_or_package' => 'nullable|string|max:255',
            'travel_date'   => 'nullable|date',
            'group_size'    => 'nullable|integer|min:1|max:100',
            'message'       => 'required|string',
        ]);

        Contact::create($request->only([
            'name',
            'email',
            'phone',
            'country',
            'subject',
            'inquiry_type',
            'trek_or_package',
            'travel_date',
            'group_size',
            'message'
        ]));

        return back()->with('success', 'Your message has been sent. We will get back to you soon!');
    }
}
