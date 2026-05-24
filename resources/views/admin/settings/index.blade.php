@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@push('styles')
    <style>
        .settings-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Section card */
        .section-card {
            background: #fff;
            border: 1px solid #eef2f7;
            border-radius: 14px;
            margin-bottom: 18px;
            overflow: hidden;
        }

        .section-header {
            padding: 14px 18px;
            font-size: 14px;
            font-weight: 700;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-body {
            padding: 18px;
        }

        /* Grid */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        @media(max-width:768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        /* Field */
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
        }

        input,
        textarea,
        select {
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            font-size: 13px;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: #3b82f6;
            background: #fff;
        }

        textarea {
            min-height: 90px;
        }

        /* Logo preview */
        .preview-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }

        .preview-box img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            object-fit: cover;
        }

        /* Save bar */
        .save-bar {
            position: sticky;
            bottom: 0;
            background: #fff;
            padding: 14px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            background: #2563eb;
            color: #fff;
            padding: 10px 18px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }
    </style>
@endpush

@section('content')

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="settings-container">

            {{-- ================= GENERAL ================= --}}
            <div class="section-card">
                <div class="section-header">
                    ⚙ General Settings
                </div>
                <div class="section-body">

                    <div class="grid-2">
                        <div class="field">
                            <label>Site Name</label>
                            <input name="site_name" value="{{ setting('site_name') }}">
                        </div>

                        <div class="field">
                            <label>App Name</label>
                            <input name="app_name" value="{{ setting('app_name') }}">
                        </div>

                        <div class="field">
                            <label>Currency</label>
                            <input name="currency" value="{{ setting('currency') }}">
                        </div>

                        <div class="field">
                            <label>Timezone</label>
                            <input name="timezone" value="{{ setting('timezone') }}">
                        </div>

                        <div class="field">
                            <label>Admin Email</label>
                            <input name="admin_email" value="{{ setting('admin_email') }}">
                        </div>

                        <div class="field">
                            <label>Phone</label>
                            <input name="phone" value="{{ setting('phone') }}">
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================= BRANDING ================= --}}
            <div class="section-card">
                <div class="section-header">
                    🎨 Branding
                </div>
                <div class="section-body">

                    <div class="grid-2">

                        <div class="field">
                            <label>Site Logo</label>
                            <input type="file" name="site_logo">
                            <div class="preview-box">
                                <img src="{{ asset(setting('site_logo')) }}">
                                <small>Logo</small>
                            </div>
                        </div>

                        <div class="field">
                            <label>Favicon</label>
                            <input type="file" name="favicon">
                            <div class="preview-box">
                                <img src="{{ asset(setting('favicon')) }}">
                                <small>Favicon</small>
                            </div>
                        </div>

                        <div class="field">
                            <label>Tagline</label>
                            <input name="tagline" value="{{ setting('tagline') }}">
                        </div>

                        <div class="field">
                            <label>Theme Color</label>
                            <input name="theme_color" value="{{ setting('theme_color') }}">
                        </div>

                    </div>

                </div>
            </div>

            {{-- ================= SEO ================= --}}
            <div class="section-card">
                <div class="section-header">
                    🔍 SEO Settings
                </div>
                <div class="section-body">

                    <div class="field">
                        <label>Meta Title</label>
                        <input name="meta_title" value="{{ setting('meta_title') }}">
                    </div>

                    <div class="field">
                        <label>Meta Description</label>
                        <textarea name="meta_description">{{ setting('meta_description') }}</textarea>
                    </div>

                    <div class="field">
                        <label>Meta Keywords</label>
                        <input name="meta_keywords" value="{{ setting('meta_keywords') }}">
                    </div>

                    <div class="field">
                        <label>OG Image</label>
                        <input type="file" name="og_image">
                    </div>

                </div>
            </div>

            {{-- ================= CONTACT ================= --}}
            <div class="section-card">
                <div class="section-header">
                    📞 Contact Information
                </div>
                <div class="section-body">

                    <div class="grid-2">
                        <div class="field">
                            <label>Email</label>
                            <input name="contact_email" value="{{ setting('contact_email') }}">
                        </div>

                        <div class="field">
                            <label>Support Email</label>
                            <input name="support_email" value="{{ setting('support_email') }}">
                        </div>

                        <div class="field">
                            <label>Address</label>
                            <input name="address" value="{{ setting('address') }}">
                        </div>

                        <div class="field">
                            <label>Working Hours</label>
                            <input name="working_hours" value="{{ setting('working_hours') }}">
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================= SOCIAL ================= --}}
            <div class="section-card">
                <div class="section-header">
                    🌐 Social Media
                </div>
                <div class="section-body">

                    <div class="grid-2">
                        <div class="field">
                            <label>Facebook</label>
                            <input name="facebook_url" value="{{ setting('facebook_url') }}">
                        </div>

                        <div class="field">
                            <label>Instagram</label>
                            <input name="instagram_url" value="{{ setting('instagram_url') }}">
                        </div>

                        <div class="field">
                            <label>Twitter</label>
                            <input name="twitter_url" value="{{ setting('twitter_url') }}">
                        </div>

                        <div class="field">
                            <label>YouTube</label>
                            <input name="youtube_url" value="{{ setting('youtube_url') }}">
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================= FOOTER ================= --}}
            <div class="section-card">
                <div class="section-header">
                    🧾 Footer Settings
                </div>
                <div class="section-body">

                    <div class="field">
                        <label>Footer Text</label>
                        <textarea name="footer_text">{{ setting('footer_text') }}</textarea>
                    </div>

                    <div class="grid-2">
                        <div class="field">
                            <label>Copyright</label>
                            <input name="copyright" value="{{ setting('copyright') }}">
                        </div>

                        <div class="field">
                            <label>Powered By</label>
                            <input name="powered_by" value="{{ setting('powered_by') }}">
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- SAVE BUTTON --}}
        <div class="save-bar">
            <button class="btn">
                Save Settings
            </button>
        </div>

    </form>

@endsection
