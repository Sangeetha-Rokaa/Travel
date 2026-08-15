{{--
    Navigation Component
    Sections: Home | Destinations (dropdown: Treks, Packages) | About Us | Contact
--}}
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                {{-- Replace with <img src="{{ asset('images/logo.svg') }}"> when design is ready --}}
                <span class="text-2xl font-bold text-red-600">🏔 Nepal Travel</span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-1">

                {{-- Home --}}
                <a href="{{ route('home') }}"
                    class="px-4 py-2 text-gray-700 hover:text-red-600 font-medium transition-colors
                          {{ request()->routeIs('home') ? 'text-red-600 border-b-2 border-red-600' : '' }}">
                    Home
                </a>

                {{-- Destinations --}}
                <a href="{{ route('destinations.index') }}"
                    class="px-4 py-2 text-gray-700 hover:text-red-600 font-medium transition-colors
                          {{ request()->routeIs('destinations.*') ? 'text-red-600 border-b-2 border-red-600' : '' }}">
                    Destinations
                </a>

                {{-- Dropdown: Treks & Packages --}}
                <div class="relative group">
                    <button
                        class="flex items-center gap-1 px-4 py-2 text-gray-700 hover:text-red-600 font-medium transition-colors
                                   {{ request()->routeIs('treks.*') || request()->routeIs('packages.*') ? 'text-red-600' : '' }}">
                        Explore
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown panel --}}
                    <div
                        class="absolute top-full left-0 mt-1 w-52 bg-white border border-gray-100 shadow-xl rounded-lg
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('treks.index') }}"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-t-lg transition-colors">
                            <span class="text-xl">🥾</span>
                            <div>
                                <div class="font-medium">Treks</div>
                                <div class="text-xs text-gray-400">Himalayan trekking routes</div>
                            </div>
                        </a>
                        <a href="{{ route('packages.index') }}"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-b-lg transition-colors">
                            <span class="text-xl">🎒</span>
                            <div>
                                <div class="font-medium">Packages</div>
                                <div class="text-xs text-gray-400">Cultural & adventure tours</div>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- About Us --}}
                <a href="{{ route('about.index') }}"
                    class="px-4 py-2 text-gray-700 hover:text-red-600 font-medium transition-colors
                          {{ request()->routeIs('about.*') ? 'text-red-600 border-b-2 border-red-600' : '' }}">
                    About Us
                </a>

                {{-- Contact --}}
                <a href="{{ route('contact.index') }}"
                    class="ml-2 px-5 py-2 bg-red-600 text-white rounded-full font-medium hover:bg-red-700 transition-colors
                          {{ request()->routeIs('contact.*') ? 'bg-red-700' : '' }}">
                    Contact Us
                </a>

            </div>{{-- /Desktop Menu --}}

            {{-- Mobile hamburger --}}
            <button id="mobile-menu-btn" class="md:hidden p-2 rounded-md text-gray-600 hover:text-red-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-2 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-red-600 font-medium">Home</a>
            <a href="{{ route('destinations.index') }}"
                class="block px-3 py-2 text-gray-700 hover:text-red-600 font-medium">Destinations</a>
            <a href="{{ route('treks.index') }}" class="block px-3 py-2 pl-6 text-gray-600 hover:text-red-600">🥾
                Treks</a>
            <a href="{{ route('packages.index') }}" class="block px-3 py-2 pl-6 text-gray-600 hover:text-red-600">🎒
                Packages</a>
            <a href="{{ route('about.index') }}"
                class="block px-3 py-2 text-gray-700 hover:text-red-600 font-medium">About Us</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-red-600 font-medium">Contact Us</a>
        </div>
    </div>

</nav>

@push('scripts')
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
@endpush
