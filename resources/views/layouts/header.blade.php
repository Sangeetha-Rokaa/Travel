{{-- resources/views/layouts/header.blade.php --}}
<div class="top-header">
    <div class="page-title">
        @hasSection('page_icon')
            <i class="@yield('page_icon')"></i>
        @else
            <i class="fas fa-mountain-sun"></i>
        @endif
        @yield('page_title', 'Dashboard')
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="text-muted" style="font-size: 0.85rem;">
            <i class="fas fa-map-marker-alt" style="color:#e9b35f;"></i>
            Nepal, A pride
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" class="mb-0">
            @csrf
            <button class="btn logout-btn text-white" type="submit">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </button>
        </form>
    </div>
</div>
