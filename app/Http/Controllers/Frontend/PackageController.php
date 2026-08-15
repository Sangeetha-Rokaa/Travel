<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * List all packages with optional type filter.
     */
    public function index(Request $request)
    {
        $query = Package::active()->ordered();

        // Filter by type when the dropdown is used
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $packages = $query->get();

        // All distinct types for the filter dropdown
        $types = Package::active()
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        // Hero: first featured, else first active
        $hero = Package::active()->where('is_featured', true)->ordered()->first()
            ?? Package::active()->ordered()->first();

        return view('frontend.packages.index', compact('packages', 'types', 'hero'));
    }

    public function show(string $slug)
    {
        $package = Package::active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.packages.show', compact('package'));
    }
}
