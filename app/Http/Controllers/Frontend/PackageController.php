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

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('max_price')) {
            $query->where('price_usd', '<=', $request->max_price);
        }

        $packages = $query->paginate(12)->withQueryString();
        $types    = Package::TYPES;

        return view('frontend.packages.index', compact('packages', 'types'));
    }

    /**
     * Show single package detail page.
     */
    public function show(Package $package)
    {
        abort_if(! $package->is_active, 404);

        $packages = Package::active()
            ->where('id', '!=', $package->id)
            ->where('type', $package->type)
            ->ordered()
            ->take(3)
            ->get();

        return view('frontend.packages.show', compact('package', 'packages'));
    }
}
