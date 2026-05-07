<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Trek;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::active()->featured()->ordered()->take(6)->get();
        $featuredTreks        = Trek::active()->featured()->ordered()->with('destination')->take(6)->get();
        $featuredPackages     = Package::active()->featured()->ordered()->take(6)->get();
        $testimonials         = Testimonial::active()->featured()->latest()->take(6)->get();

        $stats = [
            'destinations' => Destination::active()->count(),
            'treks'        => Trek::active()->count(),
            'packages'     => Package::active()->count(),
            'happy_clients' => 5000, // can be a site setting
        ];

        return view('frontend.home.index', compact(
            'featuredDestinations',
            'featuredTreks',
            'featuredPackages',
            'testimonials',
            'stats',
        ));
    }
}
