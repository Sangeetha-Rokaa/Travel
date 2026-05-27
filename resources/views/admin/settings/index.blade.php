@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

        :root {
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --primary-dark: #1d4ed8;
            --surface: #ffffff;
            --surface-2: #f8fafc;
            --border: #e8edf5;
            --border-focus: #93c5fd;
            --text-1: #0f172a;
            --text-2: #475569;
            --text-3: #94a3b8;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 4px 16px rgba(0, 0, 0, .04);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, .05), 0 10px 30px rgba(0, 0, 0, .08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .settings-page {
            font-family: 'DM Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            padding: 0 0 80px;
        }

        /* ── Top bar ── */
        .settings-topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            height: 64px;
            box-shadow: 0 1px 0 var(--border);
        }

        .settings-topbar-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 16px;
        }

        .topbar-label {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-1);
        }

        .topbar-sub {
            font-size: 12px;
            color: var(--text-3);
            margin-top: 1px;
        }

        .btn-save-top {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background .15s, transform .1s, box-shadow .15s;
            box-shadow: 0 2px 8px rgba(37, 99, 235, .25);
        }

        .btn-save-top:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 14px rgba(37, 99, 235, .35);
        }

        .btn-save-top:active {
            transform: scale(.98);
        }

        /* ── Layout ── */
        .settings-layout {
            max-width: 1160px;
            margin: 28px auto 0;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── Sidebar nav ── */
        .settings-nav {
            background: var(--surface);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            overflow: hidden;
            position: sticky;
            top: 80px;
            box-shadow: var(--shadow);
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--text-3);
            padding: 14px 16px 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-2);
            border-left: 3px solid transparent;
            transition: all .15s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: var(--surface-2);
            color: var(--text-1);
        }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .nav-item i {
            width: 16px;
            text-align: center;
            font-size: 13px;
        }

        /* ── Panels ── */
        .settings-panels {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .settings-panel {
            display: none;
        }

        .settings-panel.active {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ── Card ── */
        .s-card {
            background: var(--surface);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: box-shadow .2s;
        }

        .s-card:hover {
            box-shadow: var(--shadow-md);
        }

        .s-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .s-card-header-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .s-card-header-text h3 {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-1);
        }

        .s-card-header-text p {
            font-size: 12px;
            color: var(--text-3);
            margin-top: 1px;
        }

        .s-card-body {
            padding: 22px;
        }

        /* ── Grid ── */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .col-full {
            grid-column: 1 / -1;
        }

        /* ── Field ── */
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--text-2);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .field label .req {
            color: var(--danger);
        }

        .field label .badge-optional {
            font-size: 9px;
            background: #f1f5f9;
            color: var(--text-3);
            padding: 1px 6px;
            border-radius: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .field input,
        .field select,
        .field textarea {
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface-2);
            font-size: 13px;
            color: var(--text-1);
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color .15s, background .15s, box-shadow .15s;
            width: 100%;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--border-focus);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
        }

        .field input[type="color"] {
            padding: 4px 6px;
            height: 42px;
            cursor: pointer;
        }

        .field textarea {
            min-height: 90px;
            resize: vertical;
            line-height: 1.6;
        }

        .field-hint {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 2px;
        }

        /* ── Upload zone ── */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
            position: relative;
            background: var(--surface-2);
        }

        .upload-zone:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            border: none;
            background: none;
            padding: 0;
        }

        .upload-zone-icon {
            font-size: 28px;
            color: var(--text-3);
            margin-bottom: 6px;
        }

        .upload-zone-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-2);
        }

        .upload-zone-sub {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 2px;
        }

        /* ── Image preview ── */
        .img-preview-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 12px;
            padding: 12px;
            background: var(--surface-2);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
        }

        .img-preview-wrap img {
            width: 52px;
            height: 52px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: #fff;
        }

        .img-preview-info {
            flex: 1;
        }

        .img-preview-info .img-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-1);
        }

        .img-preview-info .img-note {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 2px;
        }

        /* ── Toggle switch ── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .toggle-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .toggle-row:first-child {
            padding-top: 0;
        }

        .toggle-info h4 {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-1);
        }

        .toggle-info p {
            font-size: 12px;
            color: var(--text-3);
            margin-top: 2px;
        }

        .toggle {
            position: relative;
            width: 42px;
            height: 24px;
            flex-shrink: 0;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            background: #cbd5e1;
            border-radius: 24px;
            cursor: pointer;
            transition: background .2s;
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
            top: 3px;
            left: 3px;
            transition: transform .2s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
        }

        .toggle input:checked+.toggle-slider {
            background: var(--primary);
        }

        .toggle input:checked+.toggle-slider::before {
            transform: translateX(18px);
        }

        /* ── Social icon row ── */
        .social-field {
            position: relative;
        }

        .social-field .social-prefix {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            pointer-events: none;
            z-index: 1;
        }

        .social-field input {
            padding-left: 36px;
        }

        /* ── Alert ── */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ── Divider ── */
        .s-divider {
            height: 1px;
            background: var(--border);
            margin: 18px 0;
        }

        /* ── Color swatch row ── */
        .color-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .color-row input[type="color"] {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            padding: 2px;
            border-radius: 8px;
        }

        .color-row input[type="text"] {
            flex: 1;
            font-family: 'DM Mono', monospace;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .settings-layout {
                grid-template-columns: 1fr;
            }

            .settings-nav {
                position: static;
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                padding: 10px;
            }

            .nav-section-label {
                display: none;
            }

            .nav-item {
                border-left: none;
                border-radius: 8px;
                border-bottom: 2px solid transparent;
                padding: 8px 14px;
            }

            .nav-item.active {
                border-bottom-color: var(--primary);
            }

            .grid-2,
            .grid-3 {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    <div class="settings-page">

        @if (session('success'))
            <div style="max-width:1160px;margin:16px auto 0;padding:0 24px;">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div style="max-width:1160px;margin:16px auto 0;padding:0 24px;">
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> Please fix the errors below.
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settings-form">
            @csrf

            {{-- ── TOP BAR ── --}}
            <div class="settings-topbar">
                <div class="settings-topbar-title">
                    <div class="topbar-icon"><i class="fas fa-cog"></i></div>
                    <div>
                        <div class="topbar-label">Site Settings</div>
                        <div class="topbar-sub">Manage your site configuration</div>
                    </div>
                </div>
                <button type="submit" class="btn-save-top">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>

            <div class="settings-layout">

                {{-- ── SIDEBAR NAV ── --}}
                <nav class="settings-nav">
                    <div class="nav-section-label">Configuration</div>
                    <a class="nav-item active" onclick="switchTab('general', this)">
                        <i class="fas fa-sliders-h"></i> General
                    </a>
                    <a class="nav-item" onclick="switchTab('branding', this)">
                        <i class="fas fa-palette"></i> Branding
                    </a>
                    <a class="nav-item" onclick="switchTab('seo', this)">
                        <i class="fas fa-search"></i> SEO
                    </a>
                    <a class="nav-item" onclick="switchTab('contact', this)">
                        <i class="fas fa-address-card"></i> Contact
                    </a>
                    <a class="nav-item" onclick="switchTab('social', this)">
                        <i class="fas fa-share-alt"></i> Social Media
                    </a>
                    <a class="nav-item" onclick="switchTab('footer', this)">
                        <i class="fas fa-layer-group"></i> Footer
                    </a>
                </nav>

                {{-- ── PANELS ── --}}
                <div class="settings-panels">

                    {{-- ═══════════ GENERAL ═══════════ --}}
                    <div class="settings-panel active" id="panel-general">
                        <div class="s-card">
                            <div class="s-card-header">
                                <div class="s-card-header-icon" style="background:#eff6ff;color:#2563eb;">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="s-card-header-text">
                                    <h3>General Settings</h3>
                                    <p>Basic site information and configuration</p>
                                </div>
                            </div>
                            <div class="s-card-body">
                                <div class="grid-2">

                                    <div class="field">
                                        <label>Site Name <span class="req">*</span></label>
                                        <input name="site_name" value="{{ setting('site_name') }}"
                                            placeholder="e.g. Visit Nepal">
                                    </div>

                                    <div class="field">
                                        <label>App Name</label>
                                        <input name="app_name" value="{{ setting('app_name') }}"
                                            placeholder="e.g. VisitNepal">
                                    </div>

                                    <div class="field">
                                        <label>Admin Email <span class="req">*</span></label>
                                        <input type="email" name="admin_email" value="{{ setting('admin_email') }}"
                                            placeholder="admin@example.com">
                                    </div>

                                    <div class="field">
                                        <label>Support Phone</label>
                                        <input name="phone" value="{{ setting('phone') }}" placeholder="+977 9800000000">
                                    </div>

                                    <div class="field">
                                        <label>Currency</label>
                                        <select name="currency">
                                            @foreach (['USD' => 'USD – US Dollar', 'NPR' => 'NPR – Nepali Rupee', 'EUR' => 'EUR – Euro', 'GBP' => 'GBP – British Pound', 'AUD' => 'AUD – Australian Dollar'] as $code => $label)
                                                <option value="{{ $code }}"
                                                    {{ setting('currency') === $code ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="field">
                                        <label>Timezone</label>
                                        <select name="timezone">
                                            @foreach (['Asia/Kathmandu', 'UTC', 'America/New_York', 'Europe/London', 'Asia/Kolkata', 'Asia/Tokyo', 'Australia/Sydney'] as $tz)
                                                <option value="{{ $tz }}"
                                                    {{ setting('timezone') === $tz ? 'selected' : '' }}>
                                                    {{ $tz }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════ BRANDING ═══════════ --}}
                    <div class="settings-panel" id="panel-branding">
                        <div class="s-card">
                            <div class="s-card-header">
                                <div class="s-card-header-icon" style="background:#fdf4ff;color:#a855f7;">
                                    <i class="fas fa-paint-brush"></i>
                                </div>
                                <div class="s-card-header-text">
                                    <h3>Branding</h3>
                                    <p>Logo, favicon, colours and tagline</p>
                                </div>
                            </div>
                            <div class="s-card-body">

                                <div class="grid-2">

                                    {{-- Logo --}}
                                    <div class="field">
                                        <label>Site Logo</label>
                                        <div class="upload-zone" id="logo-zone">
                                            <input type="file" name="site_logo" accept="image/*"
                                                onchange="previewImage(this,'logo-preview','logo-name')">
                                            <div class="upload-zone-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <div class="upload-zone-text">Click to upload logo</div>
                                            <div class="upload-zone-sub">PNG, JPG, WEBP — max 2 MB</div>
                                        </div>
                                        <div class="img-preview-wrap" id="logo-preview-wrap">
                                            <img id="logo-preview"
                                                src="{{ setting('site_logo') ? asset('storage/' . setting('site_logo')) : asset('images/placeholder.png') }}"
                                                onerror="this.src='https://via.placeholder.com/52x52?text=Logo'">
                                            <div class="img-preview-info">
                                                <div class="img-name" id="logo-name">
                                                    {{ setting('site_logo') ? basename(setting('site_logo')) : 'Current logo' }}
                                                </div>
                                                <div class="img-note">Recommended: 200×60 px</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Favicon --}}
                                    <div class="field">
                                        <label>Favicon</label>
                                        <div class="upload-zone" id="favicon-zone">
                                            <input type="file" name="favicon" accept="image/*"
                                                onchange="previewImage(this,'favicon-preview','favicon-name')">
                                            <div class="upload-zone-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <div class="upload-zone-text">Click to upload favicon</div>
                                            <div class="upload-zone-sub">PNG, ICO — max 512 KB</div>
                                        </div>
                                        <div class="img-preview-wrap">
                                            <img id="favicon-preview"
                                                src="{{ setting('favicon') ? asset('storage/' . setting('favicon')) : asset('images/placeholder.png') }}"
                                                onerror="this.src='https://via.placeholder.com/52x52?text=Fav'">
                                            <div class="img-preview-info">
                                                <div class="img-name" id="favicon-name">
                                                    {{ setting('favicon') ? basename(setting('favicon')) : 'Current favicon' }}
                                                </div>
                                                <div class="img-note">Recommended: 32×32 px</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label>Tagline</label>
                                        <input name="tagline" value="{{ setting('tagline') }}"
                                            placeholder="e.g. Discover the Himalayas">
                                    </div>

                                    <div class="field">
                                        <label>Theme / Brand Color</label>
                                        <div class="color-row">
                                            <input type="color" id="color-picker"
                                                value="{{ setting('theme_color', '#2563eb') }}"
                                                oninput="document.getElementById('color-hex').value=this.value">
                                            <input type="text" id="color-hex" name="theme_color"
                                                value="{{ setting('theme_color', '#2563eb') }}" placeholder="#2563eb"
                                                oninput="document.getElementById('color-picker').value=this.value">
                                        </div>
                                        <span class="field-hint">Used across buttons, links, and accents.</span>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ═══════════ SEO ═══════════ --}}
                    <div class="settings-panel" id="panel-seo">
                        <div class="s-card">
                            <div class="s-card-header">
                                <div class="s-card-header-icon" style="background:#fff7ed;color:#ea580c;">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="s-card-header-text">
                                    <h3>SEO Settings</h3>
                                    <p>Meta tags and search engine optimisation</p>
                                </div>
                            </div>
                            <div class="s-card-body">
                                <div style="display:flex;flex-direction:column;gap:16px;">

                                    <div class="field">
                                        <label>Meta Title</label>
                                        <input name="meta_title" value="{{ setting('meta_title') }}"
                                            placeholder="Visit Nepal – Discover the Himalayas" maxlength="70">
                                        <span class="field-hint">Recommended: 50–70 characters</span>
                                    </div>

                                    <div class="field">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" placeholder="Brief description for search engine results..." maxlength="160">{{ setting('meta_description') }}</textarea>
                                        <span class="field-hint">Recommended: 120–160 characters</span>
                                    </div>

                                    <div class="field">
                                        <label>Meta Keywords</label>
                                        <input name="meta_keywords" value="{{ setting('meta_keywords') }}"
                                            placeholder="nepal, trekking, himalayas, tour">
                                        <span class="field-hint">Comma-separated keywords</span>
                                    </div>

                                    <div class="field">
                                        <label>OG / Social Share Image</label>
                                        <div class="upload-zone">
                                            <input type="file" name="og_image" accept="image/*"
                                                onchange="previewImage(this,'og-preview','og-name')">
                                            <div class="upload-zone-icon"><i class="fas fa-image"></i></div>
                                            <div class="upload-zone-text">Click to upload OG image</div>
                                            <div class="upload-zone-sub">1200×630 px recommended</div>
                                        </div>
                                        @if (setting('og_image'))
                                            <div class="img-preview-wrap">
                                                <img id="og-preview" src="{{ asset('storage/' . setting('og_image')) }}"
                                                    onerror="this.src='https://via.placeholder.com/52x52?text=OG'">
                                                <div class="img-preview-info">
                                                    <div class="img-name" id="og-name">
                                                        {{ basename(setting('og_image')) }}</div>
                                                    <div class="img-note">Used when sharing on social media</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════ CONTACT ═══════════ --}}
                    <div class="settings-panel" id="panel-contact">
                        <div class="s-card">
                            <div class="s-card-header">
                                <div class="s-card-header-icon" style="background:#f0fdf4;color:#16a34a;">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <div class="s-card-header-text">
                                    <h3>Contact Information</h3>
                                    <p>Public-facing contact details</p>
                                </div>
                            </div>
                            <div class="s-card-body">
                                <div class="grid-2">

                                    <div class="field">
                                        <label>Contact Email</label>
                                        <input type="email" name="contact_email"
                                            value="{{ setting('contact_email') }}" placeholder="contact@visitnepal.com">
                                    </div>

                                    <div class="field">
                                        <label>Support Email</label>
                                        <input type="email" name="support_email"
                                            value="{{ setting('support_email') }}" placeholder="support@visitnepal.com">
                                    </div>

                                    <div class="field col-full">
                                        <label>Address</label>
                                        <input name="address" value="{{ setting('address') }}"
                                            placeholder="Thamel, Kathmandu, Nepal">
                                    </div>

                                    <div class="field">
                                        <label>Working Hours</label>
                                        <input name="working_hours" value="{{ setting('working_hours') }}"
                                            placeholder="Sun–Fri, 9am – 6pm">
                                    </div>

                                    <div class="field">
                                        <label>WhatsApp Number <span class="badge-optional">optional</span></label>
                                        <input name="whatsapp" value="{{ setting('whatsapp') }}"
                                            placeholder="+977 9800000000">
                                    </div>

                                    <div class="field col-full">
                                        <label>Google Maps Embed URL <span class="badge-optional">optional</span></label>
                                        <input name="maps_url" value="{{ setting('maps_url') }}"
                                            placeholder="https://maps.google.com/...">
                                        <span class="field-hint">Paste the full iframe src URL from Google Maps.</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════ SOCIAL ═══════════ --}}
                    <div class="settings-panel" id="panel-social">
                        <div class="s-card">
                            <div class="s-card-header">
                                <div class="s-card-header-icon" style="background:#fef3c7;color:#d97706;">
                                    <i class="fas fa-share-alt"></i>
                                </div>
                                <div class="s-card-header-text">
                                    <h3>Social Media</h3>
                                    <p>Links shown in the header and footer</p>
                                </div>
                            </div>
                            <div class="s-card-body">
                                <div class="grid-2">

                                    @php
                                        $socials = [
                                            'facebook_url' => ['fab fa-facebook', '#1877f2', 'Facebook URL'],
                                            'instagram_url' => ['fab fa-instagram', '#e1306c', 'Instagram URL'],
                                            'twitter_url' => ['fab fa-twitter', '#1da1f2', 'Twitter / X URL'],
                                            'youtube_url' => ['fab fa-youtube', '#ff0000', 'YouTube URL'],
                                            'linkedin_url' => ['fab fa-linkedin', '#0077b5', 'LinkedIn URL'],
                                            'tiktok_url' => ['fab fa-tiktok', '#010101', 'TikTok URL'],
                                        ];
                                    @endphp

                                    @foreach ($socials as $key => [$icon, $color, $placeholder])
                                        <div class="field">
                                            <label><i class="{{ $icon }}"
                                                    style="color:{{ $color }};"></i> {{ $placeholder }}</label>
                                            <div class="social-field">
                                                <span class="social-prefix"><i class="{{ $icon }}"
                                                        style="color:{{ $color }};font-size:13px;"></i></span>
                                                <input name="{{ $key }}" value="{{ setting($key) }}"
                                                    placeholder="https://...">
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════ FOOTER ═══════════ --}}
                    <div class="settings-panel" id="panel-footer">
                        <div class="s-card">
                            <div class="s-card-header">
                                <div class="s-card-header-icon" style="background:#f0f9ff;color:#0284c7;">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <div class="s-card-header-text">
                                    <h3>Footer Settings</h3>
                                    <p>Footer text, copyright and powered-by notice</p>
                                </div>
                            </div>
                            <div class="s-card-body">
                                <div style="display:flex;flex-direction:column;gap:16px;">

                                    <div class="field">
                                        <label>Footer Description</label>
                                        <textarea name="footer_text" placeholder="A short description shown in the footer...">{{ setting('footer_text') }}</textarea>
                                    </div>

                                    <div class="grid-2">
                                        <div class="field">
                                            <label>Copyright Text</label>
                                            <input name="copyright" value="{{ setting('copyright') }}"
                                                placeholder="© 2025 Visit Nepal. All rights reserved.">
                                        </div>

                                        <div class="field">
                                            <label>Powered By</label>
                                            <input name="powered_by" value="{{ setting('powered_by') }}"
                                                placeholder="Your Company Name">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /panels --}}
            </div>{{-- /layout --}}

        </form>
    </div>

@endsection

@push('scripts')
    <script>
        /* ── Tab switching ── */
        function switchTab(tab, el) {
            document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            document.getElementById('panel-' + tab).classList.add('active');
            el.classList.add('active');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ── Image preview ── */
        function previewImage(input, imgId, nameId) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(imgId);
                if (img) img.src = e.target.result;
                const name = document.getElementById(nameId);
                if (name) name.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }

        /* ── Drag-over highlight on upload zones ── */
        document.querySelectorAll('.upload-zone').forEach(zone => {
            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.style.borderColor = 'var(--primary)';
                zone.style.background = 'var(--primary-light)';
            });
            zone.addEventListener('dragleave', () => {
                zone.style.borderColor = '';
                zone.style.background = '';
            });
            zone.addEventListener('drop', () => {
                zone.style.borderColor = '';
                zone.style.background = '';
            });
        });
    </script>
@endpush
