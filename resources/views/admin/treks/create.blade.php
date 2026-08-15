{{-- resources/views/admin/treks/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create New Trek - Nepal Travel')
@section('page_title', 'Create New Trek')
@section('page_icon', 'fas fa-mountain')

@section('content')
    <div class="tc-wrap">
        {{-- HEADER --}}
        <div class="tc-top">
            <div>
                <p class="tc-breadcrumb">Treks / <span>Create New</span></p>
                <h1 class="tc-title"><i class="fas fa-person-hiking"></i> Add New Trek</h1>
            </div>
            <a href="{{ route('admin.treks.index') }}" class="tc-btn-ghost">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        {{-- ERRORS --}}
        @if ($errors->any())
            <div class="tc-error-box" id="errorBox">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    <strong>Fix these errors before saving:</strong>
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.closest('.tc-error-box').remove()" type="button"><i
                        class="fas fa-xmark"></i></button>
            </div>
        @endif

        <form action="{{ route('admin.treks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="tc-layout">

                {{-- ═══ MAIN COLUMN ═══ --}}
                <div class="tc-main">

                    {{-- 1. BASIC INFO --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-circle-info"></i> Basic Information</div>

                        <div class="tc-row-2">
                            <div class="tc-field">
                                <label>Trek Name <span class="req">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="tc-input @error('name') err @enderror" placeholder="e.g. Everest Base Camp Trek"
                                    required>
                                @error('name')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>URL Slug <small>— leave blank to auto-generate</small></label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                    class="tc-input @error('slug') err @enderror" placeholder="everest-base-camp-trek">
                                @error('slug')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>Destination</label>
                                <select name="destination_id"
                                    class="tc-input tc-select @error('destination_id') err @enderror">
                                    <option value="">— Select —</option>

                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}"
                                            {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('destination_id')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>Difficulty <span class="req">*</span></label>
                                <select name="difficulty" class="tc-input tc-select @error('difficulty') err @enderror"
                                    required>
                                    <option value="">— Select —</option>
                                    @foreach ($difficulties as $d)
                                        <option value="{{ $d }}"
                                            {{ old('difficulty') == $d ? 'selected' : '' }}>
                                            {{ $d }}</option>
                                    @endforeach
                                </select>
                                @error('difficulty')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="tc-field tc-mt">
                            <label>Short Description <span class="req">*</span></label>
                            <textarea id="short_description" name="short_description" rows="3"
                                class="tc-input tc-ta @error('short_description') err @enderror"
                                placeholder="Brief overview shown in search results and cards…" required>{{ old('short_description') }}</textarea>
                            <div class="tc-counter-row">
                                <span>Max 500 characters</span>
                                <span id="charCounter" class="tc-counter">500 left</span>
                            </div>
                            @error('short_description')
                                <span class="tc-err">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="tc-field tc-mt">
                            <label>Full Description <span class="req">*</span></label>
                            <textarea id="description" name="description" rows="6" class="tc-input tc-ta @error('description') err @enderror"
                                placeholder="Detailed, engaging description of the trek experience…" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="tc-err">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- 2. TREK DETAILS --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-route"></i> Trek Details</div>

                        <div class="tc-row-4">
                            <div class="tc-field">
                                <label>Duration (Days)</label>
                                <input type="number" name="duration_days" value="{{ old('duration_days') }}"
                                    class="tc-input @error('duration_days') err @enderror" min="1" placeholder="14">
                                @error('duration_days')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>Max Altitude</label>
                                <input type="text" name="max_altitude" value="{{ old('max_altitude') }}"
                                    class="tc-input @error('max_altitude') err @enderror" placeholder="5,364m">
                                @error('max_altitude')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>Start Point</label>
                                <input type="text" name="start_point" value="{{ old('start_point') }}"
                                    class="tc-input @error('start_point') err @enderror" placeholder="Lukla">
                                @error('start_point')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>End Point</label>
                                <input type="text" name="end_point" value="{{ old('end_point') }}"
                                    class="tc-input @error('end_point') err @enderror" placeholder="Kathmandu">
                                @error('end_point')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="tc-row-2 tc-mt">
                            <div class="tc-field">
                                <label>Best Season</label>
                                <input type="text" name="best_season" value="{{ old('best_season') }}"
                                    class="tc-input @error('best_season') err @enderror"
                                    placeholder="Spring (Mar–May) & Autumn (Sep–Nov)">
                                @error('best_season')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tc-field">
                                <label>Price (USD)</label>
                                <div class="tc-prefix-wrap">
                                    <span class="tc-prefix">$</span>
                                    <input type="number" step="0.01" name="price_usd"
                                        value="{{ old('price_usd') }}"
                                        class="tc-input tc-input-prefixed @error('price_usd') err @enderror"
                                        placeholder="1499.00">
                                </div>
                                @error('price_usd')
                                    <span class="tc-err">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 3. HIGHLIGHTS & FEATURES --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-list-check"></i> Highlights & Features
                            <small>— one item per line</small>
                        </div>

                        <div class="tc-row-2">
                            <div class="tc-field">
                                <label><span class="dot dot-gold"></span> Highlights</label>
                                <textarea name="highlights" rows="6" class="tc-input tc-ta tc-mono"
                                    placeholder="Stunning Everest views&#10;Namche Bazaar market&#10;Kala Patthar sunrise">{{ old('highlights') }}</textarea>
                            </div>
                            <div class="tc-field">
                                <label><span class="dot dot-green"></span> What's Included</label>
                                <textarea name="included" rows="6" class="tc-input tc-ta tc-mono"
                                    placeholder="Airport transfers&#10;Teahouse accommodation&#10;All meals on trek">{{ old('included') }}</textarea>
                            </div>
                            <div class="tc-field">
                                <label><span class="dot dot-red"></span> What's Excluded</label>
                                <textarea name="excluded" rows="6" class="tc-input tc-ta tc-mono"
                                    placeholder="International flights&#10;Travel insurance&#10;Personal gear">{{ old('excluded') }}</textarea>
                            </div>
                            <div class="tc-field">
                                <label><span class="dot dot-purple"></span> Required Gear</label>
                                <textarea name="required_gear" rows="6" class="tc-input tc-ta tc-mono"
                                    placeholder="Down jacket&#10;Trekking boots&#10;Trekking poles">{{ old('required_gear') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 4. ITINERARY — Quill Rich Editor --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-calendar-days"></i> Day-by-Day Itinerary</div>

                        {{-- Hidden input that holds the HTML for form submission --}}
                        <input type="hidden" name="itinerary" id="itinerary_hidden">

                        {{-- Quill toolbar + editor --}}
                        <div id="quill-toolbar">
                            <span class="ql-formats">
                                <select class="ql-header">
                                    <option value="1">Heading</option>
                                    <option value="2">Sub-heading</option>
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
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="quill-editor" style="min-height:300px;">
                            {!! old('itinerary') !!}
                        </div>
                    </div>

                </div>{{-- /tc-main --}}

                {{-- ═══ SIDEBAR ═══ --}}
                <div class="tc-sidebar">

                    {{-- SUBMIT --}}
                    <div class="tc-card tc-card-cta">
                        <button type="submit" class="tc-btn-primary w-100">
                            <i class="fas fa-floppy-disk"></i> Publish Trek
                        </button>
                        <a href="{{ route('admin.treks.index') }}" class="tc-btn-cancel w-100">
                            <i class="fas fa-xmark"></i> Discard
                        </a>
                    </div>

                    {{-- IMAGES --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-images"></i> Media</div>

                        <div class="tc-field">
                            <label>Featured Image</label>
                            <label class="tc-dropzone" id="dropzone" for="featured_image">
                                <div id="dzIdle">
                                    <i class="fas fa-cloud-arrow-up"></i>
                                    <span>Click to upload</span>
                                    <small>PNG, JPG, WEBP · max 5MB</small>
                                </div>
                                <div id="dzPreview" class="d-none">
                                    <img id="previewImage" alt="">
                                    <button type="button" id="removeImg"><i class="fas fa-xmark"></i></button>
                                </div>
                            </label>
                            <input type="file" id="featured_image" name="featured_image" accept="image/*"
                                class="d-none
                            @error('featured_image') err @enderror">
                            @error('featured_image')
                                <span class="tc-err">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="tc-field tc-mt">
                            <label>Gallery Images</label>
                            <label class="tc-gallery-btn" for="gallery_images">
                                <i class="fas fa-photo-film"></i> Choose multiple photos
                            </label>
                            <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                                class="d-none">
                            <div class="tc-thumbs" id="galleryThumbs"></div>
                        </div>
                    </div>

                    {{-- GROUP SIZE --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-users"></i> Group Size</div>
                        <div class="tc-row-2">
                            <div class="tc-field">
                                <label>Minimum</label>
                                <input type="number" name="group_size_min" min="1"
                                    value="{{ old('group_size_min', 1) }}" class="tc-input">
                            </div>
                            <div class="tc-field">
                                <label>Maximum</label>
                                <input type="number" name="group_size_max" min="1"
                                    value="{{ old('group_size_max', 16) }}" class="tc-input">
                            </div>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="tc-card">
                        <div class="tc-card-label"><i class="fas fa-sliders"></i> Settings</div>

                        <label class="tc-toggle-row">
                            <div>
                                <span>Featured Trek</span>
                                <small>Show on homepage</small>
                            </div>
                            <div class="tc-switch">
                                <input type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <span></span>
                            </div>
                        </label>

                        <label class="tc-toggle-row">
                            <div>
                                <span>Active / Published</span>
                                <small>Visible on website</small>
                            </div>
                            <div class="tc-switch">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', '1') ? 'checked' : '' }}>
                                <span></span>
                            </div>
                        </label>

                        <div class="tc-field tc-mt">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', 0) }}"
                                class="tc-input">
                        </div>
                    </div>

                </div>{{-- /tc-sidebar --}}

            </div>
        </form>
    </div>
@endsection

@push('styles')
    {{-- Quill snow theme --}}
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <style>
        /* ════════════════════════════════════
                                           TOKENS
                                        ════════════════════════════════════ */
        :root {
            --c-bg: #f4f6f8;
            --c-surface: #ffffff;
            --c-border: #e2e8f0;
            --c-text: #1e293b;
            --c-muted: #64748b;
            --c-faint: #94a3b8;
            --c-primary: #1e3a32;
            --c-gold: #d97706;
            --c-gold-bg: rgba(217, 119, 6, .08);
            --c-focus: rgba(217, 119, 6, .22);
            --c-danger: #dc2626;
            --c-danger-bg: #fef2f2;
            --r: 12px;
        }

        /* ════════════════════════════════════
                                           WRAPPER
                                        ════════════════════════════════════ */
        .tc-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding-bottom: 60px;
            color: var(--c-text);
            font-family: system-ui, -apple-system, sans-serif;
            font-size: 14px;
        }

        /* ════════════════════════════════════
                                           TOP BAR
                                        ════════════════════════════════════ */
        .tc-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .tc-breadcrumb {
            font-size: 12px;
            color: var(--c-faint);
            margin: 0 0 4px;
        }

        .tc-breadcrumb span {
            color: var(--c-gold);
            font-weight: 600;
        }

        .tc-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--c-text);
        }

        .tc-title i {
            color: var(--c-gold);
            font-size: 1.1rem;
        }

        /* ════════════════════════════════════
                                           ERROR BOX
                                        ════════════════════════════════════ */
        .tc-error-box {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: var(--c-danger-bg);
            border: 1px solid rgba(220, 38, 38, .2);
            border-left: 4px solid var(--c-danger);
            border-radius: var(--r);
            padding: 16px 18px;
            margin-bottom: 20px;
            color: #7f1d1d;
        }

        .tc-error-box>i {
            color: var(--c-danger);
            margin-top: 2px;
            font-size: 16px;
        }

        .tc-error-box>div {
            flex: 1;
        }

        .tc-error-box strong {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .tc-error-box ul {
            margin: 0;
            padding-left: 16px;
            font-size: 12.5px;
        }

        .tc-error-box ul li {
            margin-bottom: 2px;
        }

        .tc-error-box>button {
            background: none;
            border: none;
            cursor: pointer;
            color: #7f1d1d;
            opacity: .5;
            font-size: 15px;
            padding: 0;
        }

        .tc-error-box>button:hover {
            opacity: 1;
        }

        /* ════════════════════════════════════
                                           LAYOUT
                                        ════════════════════════════════════ */
        .tc-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
            align-items: start;
        }

        .tc-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .tc-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: sticky;
            top: 72px;
        }

        @media (max-width: 1024px) {
            .tc-layout {
                grid-template-columns: 1fr;
            }

            .tc-sidebar {
                position: static;
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .tc-sidebar .tc-card-cta {
                grid-column: 1/-1;
            }
        }

        @media (max-width: 600px) {
            .tc-sidebar {
                grid-template-columns: 1fr;
            }
        }

        /* ════════════════════════════════════
                                           CARDS
                                        ════════════════════════════════════ */
        .tc-card {
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
        }

        .tc-card-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--c-text);
            letter-spacing: .01em;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .tc-card-label i {
            color: var(--c-gold);
        }

        .tc-card-label small {
            font-weight: 400;
            color: var(--c-faint);
        }

        .tc-card-cta {
            background: var(--c-primary);
            border-color: transparent;
        }

        /* ════════════════════════════════════
                                           GRID HELPERS
                                        ════════════════════════════════════ */
        .tc-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .tc-row-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .tc-mt {
            margin-top: 14px;
        }

        @media (max-width: 768px) {
            .tc-row-4 {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 500px) {

            .tc-row-2,
            .tc-row-4 {
                grid-template-columns: 1fr;
            }
        }

        /* ════════════════════════════════════
                                           FIELDS
                                        ════════════════════════════════════ */
        .tc-field label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--c-muted);
            margin-bottom: 6px;
        }

        .tc-field label small {
            font-weight: 400;
            color: var(--c-faint);
        }

        .req {
            color: var(--c-danger);
        }

        .tc-input {
            width: 100%;
            height: 42px;
            padding: 0 13px;
            background: var(--c-bg);
            border: 1.5px solid var(--c-border);
            border-radius: var(--r);
            font-size: 13.5px;
            color: var(--c-text);
            font-family: inherit;
            transition: border-color .18s, box-shadow .18s;
            outline: none;
            -webkit-appearance: none;
        }

        .tc-input:focus {
            border-color: var(--c-gold);
            background: #fff;
            box-shadow: 0 0 0 3px var(--c-focus);
        }

        .tc-input.err {
            border-color: var(--c-danger);
            background: var(--c-danger-bg);
        }

        .tc-input.err:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, .15);
        }

        .tc-ta {
            height: auto !important;
            padding: 11px 13px;
            line-height: 1.6;
            resize: vertical;
        }

        .tc-mono {
            font-family: 'Courier New', monospace;
            font-size: 12.5px;
            line-height: 1.9;
        }

        .tc-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;
            padding-right: 32px;
            cursor: pointer;
        }

        .tc-prefix-wrap {
            display: flex;
        }

        .tc-prefix {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            background: var(--c-bg);
            border: 1.5px solid var(--c-border);
            border-right: none;
            border-radius: var(--r) 0 0 var(--r);
            font-weight: 700;
            color: var(--c-muted);
            font-size: 13px;
            flex-shrink: 0;
        }

        .tc-input-prefixed {
            border-radius: 0 var(--r) var(--r) 0;
            padding-left: 12px;
        }

        .tc-counter-row {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 11.5px;
            color: var(--c-faint);
        }

        .tc-counter.warn {
            color: #f59e0b;
        }

        .tc-counter.over {
            color: var(--c-danger);
            font-weight: 700;
        }

        .tc-err {
            display: block;
            margin-top: 4px;
            font-size: 11.5px;
            color: var(--c-danger);
            font-weight: 600;
        }

        /* ════════════════════════════════════
                                           COLORED DOTS
                                        ════════════════════════════════════ */
        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot-gold {
            background: #d97706;
        }

        .dot-green {
            background: #16a34a;
        }

        .dot-red {
            background: #dc2626;
        }

        .dot-purple {
            background: #7c3aed;
        }

        /* ════════════════════════════════════
                                           QUILL EDITOR
                                        ════════════════════════════════════ */
        #quill-toolbar {
            border: 1.5px solid var(--c-border);
            border-bottom: none;
            border-radius: var(--r) var(--r) 0 0;
            background: var(--c-bg);
            padding: 6px 10px;
        }

        #quill-editor {
            border: 1.5px solid var(--c-border);
            border-top: none;
            border-radius: 0 0 var(--r) var(--r);
            font-size: 13.5px;
            line-height: 1.75;
            background: #fff;
        }

        #quill-editor .ql-editor {
            min-height: 300px;
            padding: 16px 18px;
        }

        #quill-editor .ql-editor.ql-blank::before {
            color: var(--c-faint);
            font-style: normal;
            font-size: 13px;
        }

        .ql-snow .ql-toolbar button:hover,
        .ql-snow .ql-toolbar button.ql-active,
        .ql-snow .ql-toolbar .ql-picker-label:hover {
            color: var(--c-gold) !important;
        }

        .ql-snow .ql-toolbar button:hover .ql-stroke,
        .ql-snow .ql-toolbar button.ql-active .ql-stroke {
            stroke: var(--c-gold) !important;
        }

        .ql-snow .ql-toolbar button:hover .ql-fill,
        .ql-snow .ql-toolbar button.ql-active .ql-fill {
            fill: var(--c-gold) !important;
        }

        /* ════════════════════════════════════
                                           IMAGE DROPZONE
                                        ════════════════════════════════════ */
        .tc-dropzone {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 140px;
            border: 2px dashed var(--c-border);
            border-radius: var(--r);
            cursor: pointer;
            transition: border-color .18s, background .18s;
            overflow: hidden;
            position: relative;
            text-align: center;
        }

        .tc-dropzone:hover {
            border-color: var(--c-gold);
            background: var(--c-gold-bg);
        }

        #dzIdle {
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        #dzIdle i {
            font-size: 28px;
            color: var(--c-faint);
        }

        #dzIdle span {
            font-size: 13px;
            font-weight: 600;
            color: var(--c-muted);
        }

        #dzIdle small {
            font-size: 11.5px;
            color: var(--c-faint);
        }

        #dzPreview {
            width: 100%;
            position: relative;
        }

        #dzPreview img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
        }

        #removeImg {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 26px;
            height: 26px;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: background .15s;
        }

        #removeImg:hover {
            background: var(--c-danger);
        }

        .tc-gallery-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            background: var(--c-bg);
            border: 1.5px dashed var(--c-border);
            border-radius: var(--r);
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: var(--c-muted);
            transition: border-color .18s, color .18s;
        }

        .tc-gallery-btn:hover {
            border-color: var(--c-gold);
            color: var(--c-gold);
        }

        .tc-gallery-btn i {
            font-size: 16px;
        }

        .tc-thumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 10px;
        }

        .tc-thumbs img {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            border: 1.5px solid var(--c-border);
            transition: transform .15s;
        }

        .tc-thumbs img:hover {
            transform: scale(1.08);
        }

        /* ════════════════════════════════════
                                           TOGGLES
                                        ════════════════════════════════════ */
        .tc-toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--c-border);
            cursor: pointer;
        }

        .tc-toggle-row:last-of-type {
            border-bottom: none;
        }

        .tc-toggle-row>div>span {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--c-text);
        }

        .tc-toggle-row>div>small {
            display: block;
            font-size: 11.5px;
            color: var(--c-faint);
            margin-top: 1px;
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
            transition: background .2s;
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
            transition: transform .2s;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .18);
        }

        .tc-switch input:checked~span {
            background: var(--c-gold);
        }

        .tc-switch input:checked~span::after {
            transform: translateX(18px);
        }

        /* ════════════════════════════════════
                                           BUTTONS
                                        ════════════════════════════════════ */
        .tc-btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 46px;
            padding: 0 20px;
            background: var(--c-gold);
            color: #fff;
            border: none;
            border-radius: var(--r);
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: filter .2s, transform .15s;
            text-decoration: none;
        }

        .tc-btn-primary:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
            color: #fff;
        }

        .tc-btn-primary:active {
            transform: translateY(0);
        }

        .tc-btn-cancel {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 40px;
            padding: 0 20px;
            background: rgba(255, 255, 255, .12);
            color: rgba(255, 255, 255, .7);
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: var(--r);
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background .18s, color .18s;
            text-decoration: none;
            margin-top: 8px;
        }

        .tc-btn-cancel:hover {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .tc-btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            border-radius: var(--r);
            font-size: 13px;
            font-weight: 600;
            color: var(--c-muted);
            cursor: pointer;
            text-decoration: none;
            transition: background .18s, color .18s;
        }

        .tc-btn-ghost:hover {
            background: var(--c-bg);
            color: var(--c-text);
        }

        .w-100 {
            width: 100%;
        }

        /* ════════════════════════════════════
                                           RESPONSIVE
                                        ════════════════════════════════════ */
        @media (max-width: 768px) {
            .tc-card {
                padding: 16px;
            }

            .tc-title {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@push('scripts')
    {{-- Quill JS --}}
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        (function() {
            /* ── Quill ── */
            const quill = new Quill('#quill-editor', {
                modules: {
                    toolbar: '#quill-toolbar'
                },
                theme: 'snow',
                placeholder: 'Day 1: Arrival in Kathmandu\nWrite a detailed day-by-day itinerary here…'
            });

            /* Sync hidden input before form submit */
            document.querySelector('form').addEventListener('submit', function() {
                document.getElementById('itinerary_hidden').value = quill.root.innerHTML;
            });

            /* ── Auto slug ── */
            const nameEl = document.getElementById('name');
            const slugEl = document.getElementById('slug');
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

            /* ── Char counter ── */
            const sd = document.getElementById('short_description');
            const cc = document.getElementById('charCounter');
            if (sd && cc) {
                function updateCC() {
                    const r = 500 - sd.value.length;
                    cc.textContent = r + ' left';
                    cc.className = 'tc-counter' + (r < 0 ? ' over' : r < 80 ? ' warn' : '');
                }
                sd.addEventListener('input', updateCC);
                updateCC();
            }

            /* ── Featured image dropzone ── */
            const fi = document.getElementById('featured_image');
            const dzP = document.getElementById('dzPreview');
            const dzI = document.getElementById('dzIdle');
            const pi = document.getElementById('previewImage');
            const rm = document.getElementById('removeImg');

            if (fi) {
                fi.addEventListener('change', function() {
                    const f = this.files[0];
                    if (!f) return;
                    const r = new FileReader();
                    r.onload = e => {
                        pi.src = e.target.result;
                        dzP.classList.remove('d-none');
                        dzI.classList.add('d-none');
                    };
                    r.readAsDataURL(f);
                });
            }
            if (rm) {
                rm.addEventListener('click', function(e) {
                    e.preventDefault();
                    fi.value = '';
                    dzP.classList.add('d-none');
                    dzI.classList.remove('d-none');
                });
            }

            /* ── Gallery thumbnails ── */
            const gi = document.getElementById('gallery_images');
            const gt = document.getElementById('galleryThumbs');
            if (gi && gt) {
                gi.addEventListener('change', function() {
                    gt.innerHTML = '';
                    Array.from(this.files).forEach(f => {
                        const r = new FileReader();
                        r.onload = e => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.title = f.name;
                            gt.appendChild(img);
                        };
                        r.readAsDataURL(f);
                    });
                });
            }
        })();
    </script>
@endpush
