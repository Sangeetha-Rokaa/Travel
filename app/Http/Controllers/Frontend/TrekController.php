<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Trek;
use App\Models\Destination;
use Illuminate\Http\Request;

class TrekController extends Controller
{
    /**
     * List all treks with filtering support.
     */
    public function index(Request $request)
    {
        $query = Trek::active()->ordered();

        // Difficulty filter (radio)
        if ($request->filled('difficulty') && $request->difficulty !== 'difficulty') {
            $query->where('difficulty', ucfirst($request->difficulty));
        }

        // Duration filter (slider — show treks up to N days)
        if ($request->filled('duration')) {
            $query->where('duration_days', '<=', (int) $request->duration);
        }

        // Region filter (checkboxes — matches destination name or trek region via destination)
        if ($request->filled('region')) {
            $regions = (array) $request->region;
            $query->whereHas('destination', function ($q) use ($regions) {
                $q->whereIn(
                    \Illuminate\Support\Facades\DB::raw('LOWER(name)'),
                    array_map('strtolower', $regions)
                );
            });
        }

        $treks = $query->get();

        // Distinct difficulty values for sidebar radios
        $difficulties = Trek::active()
            ->distinct()
            ->orderBy('difficulty')
            ->pluck('difficulty');

        // Distinct destination names for region checkboxes
        $regions = \App\Models\Destination::active()
            ->ordered()
            ->pluck('name', 'slug');

        // Duration bounds for slider
        $maxDuration = Trek::active()->max('duration_days') ?? 30;

        return view('frontend.treks.index', compact('treks', 'difficulties', 'regions', 'maxDuration'));
    }

    public function show(string $slug)
    {
        $trek = Trek::active()
            ->where('slug', $slug)
            ->with('destination')
            ->firstOrFail();

        return view('frontend.treks.show', compact('trek'));
    }
}
