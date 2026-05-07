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
        $query = Trek::active()->ordered()->with('destination');

        // Filter by difficulty
        if ($request->filled('difficulty')) {
            $query->byDifficulty($request->difficulty);
        }

        // Filter by destination
        if ($request->filled('destination')) {
            $query->whereHas('destination', fn($q) => $q->where('slug', $request->destination));
        }

        // Filter by duration
        if ($request->filled('duration')) {
            [$min, $max] = explode('-', $request->duration);
            $query->whereBetween('duration_days', [(int) $min, (int) $max]);
        }

        // Filter by max price
        if ($request->filled('max_price')) {
            $query->where('price_usd', '<=', $request->max_price);
        }

        $treks        = $query->paginate(12)->withQueryString();
        $difficulties = Trek::DIFFICULTIES;
        $destinations = Destination::active()->ordered()->get();

        return view('frontend.treks.index', compact('treks', 'difficulties', 'destinations'));
    }

    /**
     * Show single trek detail page.
     */
    public function show(Trek $trek)
    {
        abort_if(! $trek->is_active, 404);

        $trek->load('destination');
        $related = Trek::active()
            ->where('id', '!=', $trek->id)
            ->when($trek->destination_id, fn($q) => $q->where('destination_id', $trek->destination_id))
            ->ordered()
            ->take(3)
            ->get();

        return view('frontend.treks.show', compact('trek', 'related'));
    }
}
