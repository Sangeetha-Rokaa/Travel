<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        // Top 4 featured destinations → the dest-grid row
        $featured = Destination::active()
            ->featured()
            ->ordered()
            ->take(4)
            ->get();

        // Next 2 active (non-featured, or whatever fills the bottom row)
        $bottom = Destination::active()
            ->where('is_featured', false)
            ->ordered()
            ->take(2)
            ->get();

        // Hero content – pull from first featured destination,
        // or keep a fallback if none exist yet.
        $hero = $featured->first();

        return view('frontend.destinations.index', [
            'featured' => $featured,
            'bottom' => $bottom,
            'hero' => $hero
        ]);
    }

    public function show(string $slug)
    {
        $destination = Destination::active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.destinations.show', compact('destination'));
    }
}
