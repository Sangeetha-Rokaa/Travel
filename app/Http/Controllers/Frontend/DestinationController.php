<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Trek;
use App\Models\Package;

class DestinationController extends Controller
{
    /**
     * List all active destinations.
     */
    public function index()
    {
        $destinations = Destination::active()
            ->ordered()
            ->withCount(['treks' => fn($q) => $q->active()])
            ->paginate(12);

        $regions = Destination::active()->distinct()->pluck('region')->filter()->sort()->values();

        return view('frontend.destinations.index', compact('destinations', 'regions'));
    }

    /**
     * Show a single destination with its related treks/packages.
     */
    public function show(Destination $destination)
    {
        abort_if(! $destination->is_active, 404);

        $treks    = $destination->treks()->active()->ordered()->get();
        $related  = Destination::active()->where('id', '!=', $destination->id)->inRandomOrder()->take(3)->get();

        return view('frontend.destinations.show', compact('destination', 'treks', 'related'));
    }
}
