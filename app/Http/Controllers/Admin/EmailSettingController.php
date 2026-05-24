<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSetting;

class EmailSettingController extends Controller
{
    /**
     * Show all email settings
     */
    public function index()
    {
        $emails = EmailSetting::latest()->get();
        return view('admin.email.index', compact('emails'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.email.create');
    }

    /**
     * Store new SMTP config
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mailer' => 'required|string|max:50',
            'host' => 'required|string|max:255',
            'port' => 'required|integer',
            'username' => 'required|email',
            'password' => 'required|string',
            'encryption' => 'nullable|string|max:10',
            'from_address' => 'required|email',
            'from_name' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        // Ensure only ONE active SMTP
        if (!empty($validated['is_active'])) {
            EmailSetting::query()->update(['is_active' => false]);
        }

        $validated['is_active'] = $request->has('is_active');

        EmailSetting::create($validated);

        return redirect()
            ->route('admin.email.index')
            ->with('success', 'Email configuration created successfully.');
    }

    /**
     * Edit form
     */
    public function edit(EmailSetting $emailSetting)
    {
        return view('admin.email.edit', compact('emailSetting'));
    }

    /**
     * Update SMTP config
     */
    public function update(Request $request, EmailSetting $emailSetting)
    {
        $validated = $request->validate([
            'mailer' => 'required|string|max:50',
            'host' => 'required|string|max:255',
            'port' => 'required|integer',
            'username' => 'required|email',
            'password' => 'nullable|string',
            'encryption' => 'nullable|string|max:10',
            'from_address' => 'required|email',
            'from_name' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        // Ensure only ONE active SMTP
        if (!empty($validated['is_active'])) {
            EmailSetting::where('id', '!=', $emailSetting->id)
                ->update(['is_active' => false]);
        }

        $validated['is_active'] = $request->has('is_active');

        $emailSetting->update($validated);

        return redirect()
            ->route('admin.email.index')
            ->with('success', 'Email configuration updated successfully.');
    }

    /**
     * Delete SMTP config
     */
    public function destroy(EmailSetting $emailSetting)
    {
        $emailSetting->delete();

        return redirect()
            ->route('admin.email.index')
            ->with('success', 'Email configuration deleted successfully.');
    }
}
