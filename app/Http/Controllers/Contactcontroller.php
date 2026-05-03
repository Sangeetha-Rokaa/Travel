<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // Mail::to('info@visitnepal.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent! We\'ll get back to you within 24 hours.');
    }
}