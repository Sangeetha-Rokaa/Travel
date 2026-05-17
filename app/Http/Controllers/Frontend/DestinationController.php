<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::active()
            ->ordered()
            ->paginate(12);

        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $relatedDestinations = Destination::where('id', '!=', $destination->id)
            ->active()
            ->take(4)
            ->get();

        return view('frontend.destinations.show', compact(
            'destination',
            'relatedDestinations'
        ));
    }
}
