{{-- resources/views/layouts/sidebar.blade.php --}}
<div class="sidebar">
    <h3>
        <i class="fas fa-mountain-city"></i>
        नेपाल यात्रा<br>
        <span style="font-size: 0.8rem; display: block; color:#e9b35f;">Nepal Travel</span>
    </h3>

    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-dharmachakra"></i>
        <span>ड्यासबोर्ड / Dashboard</span>
    </a>
    <a href="{{ route('admin.treks.index') }}">
        <i class="fas fa-person-hiking"></i>
        <span>ट्रेकहरू / Treks</span>
    </a>
    <a href="{{ route('admin.destinations.index') }}">
        <i class="fas fa-map-location-dot"></i>
        <span>गन्तव्य / Destinations</span>
    </a>
    <a href="{{ route('admin.packages.index') }}">
        <i class="fas fa-kitchen-set"></i>
        <span>यात्रा प्याकेज / Packages</span>
    </a>
    <a href="{{ route('admin.contacts.index') }}">
        <i class="fas fa-envelope-open-text"></i>
        <span>सम्पर्क / Contacts</span>
    </a>
    <a href="{{ route('admin.testimonials.index') }}">
        <i class="fas fa-star-of-life"></i>
        <span>प्रशंसापत्र / Testimonials</span>
    </a>

    <div style="margin-top: 50px; border-top: 1px solid #3e5a4a; padding-top: 20px;">
        <div style="font-size: 0.75rem; text-align: center; color:#b9a88b;">
            <i class="fas fa-flag-checkered"></i> सगरमाथाको माया
        </div>
    </div>
</div>
