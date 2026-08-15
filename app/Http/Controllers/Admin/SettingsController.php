<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.settings.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            // General
            'site_name'     => 'nullable|string|max:255',
            'app_name'      => 'nullable|string|max:255',
            'admin_email'   => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'currency'      => 'nullable|string|max:10',
            'timezone'      => 'nullable|string|max:100',

            // Branding
            'site_logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon'       => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:512',
            'tagline'       => 'nullable|string|max:255',
            'theme_color'   => 'nullable|string|max:20',

            // SEO
            'meta_title'       => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords'    => 'nullable|string|max:255',
            'og_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',

            // Contact
            'contact_email'  => 'nullable|email|max:255',
            'support_email'  => 'nullable|email|max:255',
            'address'        => 'nullable|string|max:500',
            'working_hours'  => 'nullable|string|max:100',
            'whatsapp'       => 'nullable|string|max:50',
            'maps_url'       => 'nullable|string|max:1000',

            // Social
            'facebook_url'   => 'nullable|url|max:255',
            'instagram_url'  => 'nullable|url|max:255',
            'twitter_url'    => 'nullable|url|max:255',
            'youtube_url'    => 'nullable|url|max:255',
            'linkedin_url'   => 'nullable|url|max:255',
            'tiktok_url'     => 'nullable|url|max:255',

            // Footer
            'footer_text'    => 'nullable|string|max:1000',
            'copyright'      => 'nullable|string|max:255',
            'powered_by'     => 'nullable|string|max:255',
        ]);

        // ── TEXT / SELECT FIELDS ───────────────────────────────
        $textFields = [
            // General
            'site_name',
            'app_name',
            'admin_email',
            'phone',
            'currency',
            'timezone',
            // Branding
            'tagline',
            'theme_color',
            // SEO
            'meta_title',
            'meta_description',
            'meta_keywords',
            // Contact
            'contact_email',
            'support_email',
            'address',
            'working_hours',
            'whatsapp',
            'maps_url',
            // Social
            'facebook_url',
            'instagram_url',
            'twitter_url',
            'youtube_url',
            'linkedin_url',
            'tiktok_url',
            // Footer
            'footer_text',
            'copyright',
            'powered_by',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                $this->saveSetting($field, $request->input($field));
            }
        }

        // ── FILE UPLOADS ───────────────────────────────────────
        $fileFields = [
            'site_logo' => 'settings/logos',
            'favicon'   => 'settings/favicons',
            'og_image'  => 'settings/seo',
        ];

        foreach ($fileFields as $field => $folder) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                // Delete old file if it exists
                $old = setting($field);
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }

                $path = $request->file($field)->store($folder, 'public');
                $this->saveSetting($field, $path);
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Settings saved successfully.');
    }

    private function saveSetting(string $key, mixed $value = null): void
    {
        // Don't save null — only save empty string or actual values
        if ($value === null) {
            return;
        }

        SiteSetting::updateOrCreate(
            ['key'   => $key],
            ['value' => $value]
        );
    }
}
