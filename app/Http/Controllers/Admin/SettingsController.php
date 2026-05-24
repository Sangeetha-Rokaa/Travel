<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Show settings page
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Update all settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'footer_text' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'admin_email' => 'nullable|email|max:255',
            'timezone' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'app_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        // ── TEXT SETTINGS (KEY-VALUE SAVE) ─────────────────────────
        $this->saveSetting('site_name', $request->site_name);
        $this->saveSetting('currency', $request->currency);
        $this->saveSetting('footer_text', $request->footer_text);
        $this->saveSetting('contact_email', $request->contact_email);
        $this->saveSetting('meta_title', $request->meta_title);
        $this->saveSetting('meta_description', $request->meta_description);
        $this->saveSetting('admin_email', $request->admin_email);
        $this->saveSetting('timezone', $request->timezone);
        $this->saveSetting('facebook_url', $request->facebook_url);
        $this->saveSetting('twitter_url', $request->twitter_url);
        $this->saveSetting('instagram_url', $request->instagram_url);
        $this->saveSetting('linkedin_url', $request->linkedin_url);
        $this->saveSetting('app_name', $request->app_name);
        $this->saveSetting('phone', $request->phone);
        $this->saveSetting('address', $request->address);

        // ── LOGO UPLOAD ────────────────────────────────────────────
        if ($request->hasFile('site_logo')) {

            $path = $request->file('site_logo')->store('settings', 'public');

            $this->saveSetting('site_logo', $path);
        }

        return redirect()
            ->back()
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Helper: save key-value setting
     */
    private function saveSetting($key, $value = null)
    {
        if ($value === null) {
            return;
        }

        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
