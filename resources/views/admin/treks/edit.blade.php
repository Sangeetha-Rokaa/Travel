@extends('layouts.admin')

@section('title', 'Edit Trek')
@section('page-title', 'Edit Trek')

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        /* ── Layout ──────────────────────────────────────────────── */
        .trek-edit-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 22px;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .trek-edit-grid {
                grid-template-columns: 1fr;
            }
        }

        .trek-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .trek-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: sticky;
            top: 86px;
        }

        @media (max-width: 1100px) {
            .trek-sidebar {
                position: static;
            }
        }

        /* ── Cards ───────────────────────────────────────────────── */
        .e-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .e-card-header {
            padding: 14px 22px;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .e-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .e-card-header h3 {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .e-card-body {
            padding: 22px;
        }

        /* ── Field grid helpers ───────────────────────────────────── */
        .fg-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .fg-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .fg-1 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .fg-4 {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {

            .fg-2,
            .fg-4 {
                grid-template-columns: 1fr;
            }
        }

        /* ── Labels & inputs ─────────────────────────────────────── */
        .e-field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .e-label {
            font-size: 11.5px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .e-input,
        .e-select,
        .e-textarea {
            border: 1.5px solid #e8edf3;
            border-radius: 10px;
            padding: 9px 13px;
            font-size: 13.5px;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            width: 100%;
            font-family: inherit;
            transition: border 0.15s, background 0.15s, box-shadow 0.15s;
        }

        .e-input:focus,
        .e-select:focus,
        .e-textarea:focus {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.10);
        }

        .e-input.is-invalid,
        .e-select.is-invalid,
        .e-textarea.is-invalid {
            border-color: #f87171;
            background: #fff;
        }

        .e-textarea {
            resize: vertical;
            min-height: 90px;
            line-height: 1.6;
        }

        .e-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;
            background-size: 10px;
            padding-right: 34px;
        }

        .e-prefix-wrap {
            position: relative;
        }

        .e-prefix-wrap .e-prefix-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 12px;
            pointer-events: none;
        }

        .e-prefix-wrap .e-input {
            padding-left: 30px;
        }

        .e-error {
            font-size: 11.5px;
            color: #ef4444;
            margin-top: 1px;
        }

        /* ── Section divider ─────────────────────────────────────── */
        .e-sep {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin: 20px 0 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .e-sep::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0f4f8;
        }

        /* ── Quill editor ────────────────────────────────────────── */
        .quill-wrap {
            border-radius: 10px;
            overflow: hidden;
            border: 1.5px solid #e8edf3;
        }

        .quill-wrap:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.10);
        }

        #quill-toolbar {
            background: #f8fafc;
            border: none;
            border-bottom: 1px solid #e8edf3;
            padding: 6px 10px;
        }

        #quill-editor {
            background: #fff;
            border: none;
        }

        #quill-editor .ql-editor {
            min-height: 280px;
            padding: 16px 18px;
            font-size: 13.5px;
            line-height: 1.75;
            color: #1e293b;
        }

        #quill-editor .ql-editor.ql-blank::before {
            color: #94a3b8;
            font-style: normal;
            font-size: 13px;
        }

        .ql-snow .ql-toolbar button:hover,
        .ql-snow .ql-toolbar button.ql-active {
            color: #3b82f6 !important;
        }

        .ql-snow .ql-toolbar button:hover .ql-stroke,
        .ql-snow .ql-toolbar button.ql-active .ql-stroke {
            stroke: #3b82f6 !important;
        }

        .ql-snow .ql-toolbar button:hover .ql-fill,
        .ql-snow .ql-toolbar button.ql-active .ql-fill {
            fill: #3b82f6 !important;
        }

        /* ── Image dropzone ──────────────────────────────────────── */
        .dropzone {
            border: 2px dashed #e8edf3;
            border-radius: 12px;
            cursor: pointer;
            transition: border-color 0.18s, background 0.18s;
            overflow: hidden;
        }

        .dropzone:hover {
            border-color: #3b82f6;
            background: #f0f7ff;
        }

        .dz-idle {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            padding: 28px 16px;
            text-align: center;
        }

        .dz-idle i {
            font-size: 26px;
            color: #cbd5e1;
        }

        .dz-idle span {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .dz-idle small {
            font-size: 11.5px;
            color: #94a3b8;
        }

        .dz-preview {
            position: relative;
            display: none;
        }

        .dz-preview img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            display: block;
        }

        .dz-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.55);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .dz-remove:hover {
            background: #dc2626;
        }

        .dz-replace {
            padding: 8px 14px;
            font-size: 12px;
            color: #64748b;
            background: #f8fafc;
            border-top: 1px solid #e8edf3;
            text-align: center;
        }

        /* ── Toggle switches ─────────────────────────────────────── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f4f8;
            cursor: pointer;
        }

        .toggle-row:last-of-type {
            border-bottom: none;
        }

        .toggle-row .t-label {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .toggle-row .t-sub {
            font-size: 11.5px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .tc-switch {
            position: relative;
            flex-shrink: 0;
        }

        .tc-switch input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .tc-switch span {
            display: block;
            width: 42px;
            height: 24px;
            background: #cbd5e1;
            border-radius: 100px;
            transition: background 0.2s;
            position: relative;
        }

        .tc-switch span::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 18px;
            height: 18px;
            background: #fff;
            border-radius: 50%;
            transition: transform 0.2s;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.18);
        }

        .tc-switch input:checked~span {
            background: #3b82f6;
        }

        .tc-switch input:checked~span::after {
            transform: translateX(18px);
        }

        /* ── Buttons ─────────────────────────────────────────────── */
        .save-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            height: 46px;
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background 0.15s, transform 0.13s;
        }

        .save-btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 9px;
            border: 1.5px solid #e8edf3;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s;
        }

        .back-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #334155;
        }

        .cancel-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: color 0.13s;
        }

        .cancel-link:hover {
            color: #334155;
        }

        /* ── Error box ───────────────────────────────────────────── */
        .error-box {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: #fef2f2;
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-left: 4px solid #dc2626;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 20px;
            color: #7f1d1d;
        }

        .error-box i {
            color: #dc2626;
            font-size: 15px;
            margin-top: 1px;
        }

        .error-box strong {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 16px;
            font-size: 12.5px;
        }

        .error-box ul li {
            margin-bottom: 3px;
        }

        /* ── Success flash ───────────────────────────────────────── */
        .alert-ok {
            background: #dcfce7;
            color: #15803d;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Trek ref badge ──────────────────────────────────────── */
        .trek-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid #bfdbfe;
        }

        .diff-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 4px;
        }
    </style>
@endpush

@section('content')

    {{-- ── Top bar ─────────────────────────────────────────────────── --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.treks.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <div>
                <div style="font-size:12px; color:#94a3b8; margin-bottom:3px;">Treks / Edit</div>
                <span class="trek-badge">
                    <i class="fas fa-mountain" style="font-size:10px;"></i>
                    {{ $trek->name }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            @if ($trek->is_active)
                <span
                    style="background:#dcfce7;color:#16a34a;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;">Active</span>
            @else
                <span
                    style="background:#f1f5f9;color:#64748b;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;">Inactive</span>
            @endif
            @if ($trek->is_featured)
                <span
                    style="background:#fef3c7;color:#d97706;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;">
                    <i class="fas fa-star" style="font-size:9px;margin-right:2px;"></i> Featured
                </span>
            @endif
        </div>
    </div>

    {{-- ── Errors ───────────────────────────────────────────────────── --}}
    @if ($errors->any())
        <div class="error-box">
            <i class="fas fa-circle-exclamation"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="alert-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    {{-- ── Form ─────────────────────────────────────────────────────── --}}
    <form action="{{ route('admin.treks.update', $trek->slug) }}" method="POST" enctype="multipart/form-data"
        id="trekForm">
        @csrf
        @method('PUT')

        <div class="trek-edit-grid">

            {{-- ══ LEFT COLUMN ══════════════════════════════════════════ --}}
            <div class="trek-main">

                {{-- Basic Information --}}
                <div class="e-card">
                    <div class="e-card-header">
                        <div class="e-card-icon" style="background:#eff6ff;">
                            <i class="fas fa-circle-info text-blue-500"></i>
                        </div>
                        <h3>Basic Information</h3>
                    </div>
                    <div class="e-card-body">

                        <div class="fg-2">
                            <div class="e-field">
                                <label class="e-label">Trek Name <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="name" id="trekName"
                                    class="e-input @error('name') is-invalid @enderror"
                                    value="{{ old('name', $trek->name) }}" placeholder="e.g. Everest Base Camp Trek">
                                @error('name')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Slug</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-link e-prefix-icon"></i>
                                    <input type="text" name="slug" id="trekSlug"
                                        class="e-input @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $trek->slug) }}" placeholder="everest-base-camp-trek">
                                </div>
                                @error('slug')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="fg-2" style="margin-top:16px;">
                            <div class="e-field">
                                <label class="e-label">Destination</label>
                                <select name="destination_id"
                                    class="e-select @error('destination_id') is-invalid @enderror">
                                    <option value="">— Select Destination —</option>
                                    @foreach ($destinations as $id => $dest)
                                        <option value="{{ $id }}"
                                            {{ old('destination_id', $trek->destination_id) == $id ? 'selected' : '' }}>
                                            {{ $dest }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('destination_id')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Difficulty</label>
                                <select name="difficulty" class="e-select @error('difficulty') is-invalid @enderror">
                                    @foreach ($difficulties as $d)
                                        <option value="{{ $d }}"
                                            {{ old('difficulty', $trek->difficulty) == $d ? 'selected' : '' }}>
                                            {{ ucfirst($d) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('difficulty')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top:16px;">
                            <div class="e-field">
                                <label class="e-label">Short Description
                                    <span style="font-weight:400;text-transform:none;color:#94a3b8;margin-left:4px;"
                                        id="shortDescCounter"></span>
                                </label>
                                <textarea name="short_description" id="shortDesc" class="e-textarea @error('short_description') is-invalid @enderror"
                                    rows="3" placeholder="A brief compelling summary shown on listing pages...">{{ old('short_description', $trek->short_description) }}</textarea>
                                @error('short_description')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top:16px;">
                            <div class="e-field">
                                <label class="e-label">Full Description</label>
                                <textarea name="description" class="e-textarea @error('description') is-invalid @enderror" rows="5"
                                    placeholder="Detailed overview of the trek, highlights, and what to expect...">{{ old('description', $trek->description) }}</textarea>
                                @error('description')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Trek Details --}}
                <div class="e-card">
                    <div class="e-card-header">
                        <div class="e-card-icon" style="background:#f0fdf4;">
                            <i class="fas fa-route text-green-500"></i>
                        </div>
                        <h3>Trek Details</h3>
                    </div>
                    <div class="e-card-body">

                        <div class="fg-4">
                            <div class="e-field">
                                <label class="e-label">Duration (Days)</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-clock e-prefix-icon"></i>
                                    <input type="number" name="duration_days" min="1"
                                        class="e-input @error('duration_days') is-invalid @enderror"
                                        value="{{ old('duration_days', $trek->duration_days) }}" placeholder="14">
                                </div>
                                @error('duration_days')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Max Altitude</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-mountain e-prefix-icon"></i>
                                    <input type="text" name="max_altitude"
                                        class="e-input @error('max_altitude') is-invalid @enderror"
                                        value="{{ old('max_altitude', $trek->max_altitude) }}" placeholder="5,364 m">
                                </div>
                                @error('max_altitude')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Start Point</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-map-pin e-prefix-icon"></i>
                                    <input type="text" name="start_point"
                                        class="e-input @error('start_point') is-invalid @enderror"
                                        value="{{ old('start_point', $trek->start_point) }}" placeholder="Lukla">
                                </div>
                                @error('start_point')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">End Point</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-flag-checkered e-prefix-icon"></i>
                                    <input type="text" name="end_point"
                                        class="e-input @error('end_point') is-invalid @enderror"
                                        value="{{ old('end_point', $trek->end_point) }}" placeholder="Kathmandu">
                                </div>
                                @error('end_point')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="fg-4" style="margin-top:16px;">
                            <div class="e-field">
                                <label class="e-label">Best Season</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-sun e-prefix-icon"></i>
                                    <input type="text" name="best_season"
                                        class="e-input @error('best_season') is-invalid @enderror"
                                        value="{{ old('best_season', $trek->best_season) }}"
                                        placeholder="Oct–Nov, Mar–May">
                                </div>
                                @error('best_season')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Price (USD)</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-dollar-sign e-prefix-icon"></i>
                                    <input type="number" name="price_usd" min="0" step="0.01"
                                        class="e-input @error('price_usd') is-invalid @enderror"
                                        value="{{ old('price_usd', $trek->price_usd) }}" placeholder="1250">
                                </div>
                                @error('price_usd')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Min Group Size</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-user e-prefix-icon"></i>
                                    <input type="number" name="group_size_min" min="1"
                                        class="e-input @error('group_size_min') is-invalid @enderror"
                                        value="{{ old('group_size_min', $trek->group_size_min) }}" placeholder="1">
                                </div>
                                @error('group_size_min')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="e-field">
                                <label class="e-label">Max Group Size</label>
                                <div class="e-prefix-wrap">
                                    <i class="fas fa-users e-prefix-icon"></i>
                                    <input type="number" name="group_size_max" min="1"
                                        class="e-input @error('group_size_max') is-invalid @enderror"
                                        value="{{ old('group_size_max', $trek->group_size_max) }}" placeholder="16">
                                </div>
                                @error('group_size_max')
                                    <span class="e-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Itinerary (Quill) --}}
                <div class="e-card">
                    <div class="e-card-header">
                        <div class="e-card-icon" style="background:#fef9c3;">
                            <i class="fas fa-list-ol" style="color:#d97706;"></i>
                        </div>
                        <h3>Itinerary</h3>
                    </div>
                    <div class="e-card-body">
                        <input type="hidden" name="itinerary" id="itinerary_hidden">
                        <div class="quill-wrap">
                            <div id="quill-toolbar">
                                <span class="ql-formats">
                                    <select class="ql-header">
                                        <option value="2">Heading</option>
                                        <option value="3">Subheading</option>
                                        <option selected>Normal</option>
                                    </select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-link"></button>
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-clean"></button>
                                </span>
                            </div>
                            <div id="quill-editor">{!! old('itinerary', $trek->itinerary) !!}</div>
                        </div>
                        @error('itinerary')
                            <span class="e-error" style="margin-top:6px;display:block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- ══ RIGHT SIDEBAR ════════════════════════════════════════ --}}
            <div class="trek-sidebar">

                {{-- Save button --}}
                <div class="e-card">
                    <div class="e-card-body" style="padding:16px;">
                        <button type="submit" class="save-btn">
                            <i class="fas fa-save"></i> Update Trek
                        </button>
                        <a href="{{ route('admin.treks.index') }}" class="cancel-link">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="e-card">
                    <div class="e-card-header">
                        <div class="e-card-icon" style="background:#fdf4ff;">
                            <i class="fas fa-image" style="color:#9333ea;"></i>
                        </div>
                        <h3>Featured Image</h3>
                    </div>
                    <div class="e-card-body" style="padding-top:16px;">
                        <div class="dropzone" id="dropzone" onclick="document.getElementById('featured_image').click()">
                            {{-- Idle state --}}
                            <div class="dz-idle" id="dzIdle">
                                @if ($trek->featured_image)
                                    {{-- hidden by JS after load --}}
                                @else
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Click to upload image</span>
                                    <small>JPG, PNG or WebP · Max 2MB</small>
                                @endif
                            </div>
                            {{-- Preview state --}}
                            <div class="dz-preview" id="dzPreview">
                                <img id="previewImg" src="" alt="Preview">
                                <button type="button" class="dz-remove" id="removeImg"
                                    onclick="event.stopPropagation(); removeImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="dz-replace">Click to replace</div>
                            </div>
                        </div>
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            style="display:none;">
                        @error('featured_image')
                            <span class="e-error" style="display:block;margin-top:6px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Status & Visibility --}}
                <div class="e-card">
                    <div class="e-card-header">
                        <div class="e-card-icon" style="background:#f0fdf4;">
                            <i class="fas fa-toggle-on text-green-500"></i>
                        </div>
                        <h3>Visibility</h3>
                    </div>
                    <div class="e-card-body" style="padding-top:12px; padding-bottom:12px;">

                        <label class="toggle-row" for="is_active">
                            <div>
                                <span class="t-label">Active</span>
                                <span class="t-sub">Visible on the website</span>
                            </div>
                            <div class="tc-switch">
                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                    {{ old('is_active', $trek->is_active) ? 'checked' : '' }}>
                                <span></span>
                            </div>
                        </label>

                        <label class="toggle-row" for="is_featured">
                            <div>
                                <span class="t-label">Featured</span>
                                <span class="t-sub">Show in featured sections</span>
                            </div>
                            <div class="tc-switch">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                    {{ old('is_featured', $trek->is_featured) ? 'checked' : '' }}>
                                <span></span>
                            </div>
                        </label>

                        <div class="e-field" style="margin-top:16px;">
                            <label class="e-label">Sort Order</label>
                            <input type="number" name="sort_order" min="0" class="e-input"
                                value="{{ old('sort_order', $trek->sort_order ?? 0) }}" placeholder="0">
                        </div>

                    </div>
                </div>

                {{-- Quick info --}}
                <div class="e-card">
                    <div class="e-card-header">
                        <div class="e-card-icon" style="background:#f0f9ff;">
                            <i class="fas fa-info-circle text-sky-500"></i>
                        </div>
                        <h3>Quick Info</h3>
                    </div>
                    <div class="e-card-body" style="padding-top:14px; padding-bottom:14px;">
                        <div style="display:flex;flex-direction:column;gap:0;">
                            @php
                                $rows = [
                                    ['label' => 'Created', 'value' => $trek->created_at->format('M j, Y')],
                                    ['label' => 'Updated', 'value' => $trek->updated_at->diffForHumans()],
                                    ['label' => 'Bookings', 'value' => $trek->bookings_count ?? '—'],
                                ];
                            @endphp
                            @foreach ($rows as $row)
                                <div
                                    style="display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid #f3f6fa;">
                                    <span
                                        style="font-size:12.5px;color:#94a3b8;font-weight:500;">{{ $row['label'] }}</span>
                                    <span
                                        style="font-size:12.5px;font-weight:600;color:#334155;">{{ $row['value'] }}</span>
                                </div>
                            @endforeach
                            <div style="display:flex;justify-content:space-between;align-items:center;padding:9px 0;">
                                <span style="font-size:12.5px;color:#94a3b8;font-weight:500;">View Live</span>
                                <a href="{{ route('treks.show', $trek->slug) }}" target="_blank"
                                    style="font-size:12.5px;font-weight:600;color:#3b82f6;text-decoration:none;">
                                    Open <i class="fas fa-external-link-alt" style="font-size:10px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </form>

@endsection

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Quill editor ────────────────────────────────────────────
            const quill = new Quill('#quill-editor', {
                modules: {
                    toolbar: '#quill-toolbar'
                },
                theme: 'snow',
                placeholder: 'Day 1: Arrival in Kathmandu…\nWrite a detailed day-by-day itinerary here.'
            });

            // Sync hidden input on submit
            document.getElementById('trekForm').addEventListener('submit', function() {
                document.getElementById('itinerary_hidden').value = quill.root.innerHTML;
            });

            // ── Auto-generate slug from name ─────────────────────────────
            const nameEl = document.getElementById('trekName');
            const slugEl = document.getElementById('trekSlug');
            if (nameEl && slugEl) {
                nameEl.addEventListener('blur', function() {
                    if (!slugEl.value.trim()) {
                        slugEl.value = this.value.trim().toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                    }
                });
            }

            // ── Short description char counter ───────────────────────────
            const sdEl = document.getElementById('shortDesc');
            const ccEl = document.getElementById('shortDescCounter');
            const SD_MAX = 500;
            if (sdEl && ccEl) {
                function updateCounter() {
                    const rem = SD_MAX - sdEl.value.length;
                    ccEl.textContent = rem >= 0 ? rem + ' chars left' : Math.abs(rem) + ' over limit';
                    ccEl.style.color = rem < 0 ? '#ef4444' : rem < 80 ? '#f59e0b' : '#94a3b8';
                }
                sdEl.addEventListener('input', updateCounter);
                updateCounter();
            }

            // ── Featured image dropzone ───────────────────────────────────
            const fileInput = document.getElementById('featured_image');
            const dzIdle = document.getElementById('dzIdle');
            const dzPreview = document.getElementById('dzPreview');
            const previewImg = document.getElementById('previewImg');

            // Show existing image on load
            @if ($trek->featured_image)
                dzIdle.style.display = 'none';
                dzPreview.style.display = 'block';
                previewImg.src = '{{ Storage::url($trek->featured_image) }}';
            @endif

            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    dzIdle.style.display = 'none';
                    dzPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });

            window.removeImage = function() {
                fileInput.value = '';
                previewImg.src = '';
                dzPreview.style.display = 'none';
                dzIdle.style.display = 'flex';
                dzIdle.innerHTML = `
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Click to upload image</span>
            <small>JPG, PNG or WebP · Max 2MB</small>
        `;
            };

        });
    </script>
@endpush
