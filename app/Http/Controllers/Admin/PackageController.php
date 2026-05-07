<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        $query = Package::ordered()->withCount('bookings');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Package type filter
        if ($request->filled('package_type')) {
            $query->where('package_type', $request->package_type);
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status == 'active') {
                $query->where('is_active', true);
            } elseif ($request->status == 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status == 'featured') {
                $query->where('is_featured', true);
            }
        }

        $packages = $query->paginate(15);

        return view('admin.packages.index', compact('packages'));
    }

    public function create(): View
    {
        $types = Package::TYPES;
        return view('admin.packages.create', compact('types'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('packages', 'public');
        }

        foreach (['highlights', 'included', 'excluded'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = $this->textToArray($validated[$field]);
            }
        }

        if (! empty($validated['destinations_covered'])) {
            $validated['destinations_covered'] = $this->textToArray($validated['destinations_covered']);
        }

        Package::create($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package created successfully.');
    }

    public function edit(Package $package): View
    {
        $types = Package::TYPES;
        return view('admin.packages.edit', compact('package', 'types'));
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $this->validateRequest($request, $package->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('packages', 'public');
        }

        foreach (['highlights', 'included', 'excluded'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = $this->textToArray($validated[$field]);
            }
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();
        return redirect()->route('admin.packages.index')
            ->with('success', 'Package deleted.');
    }

    private function validateRequest(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name'                 => 'required|string|max:200',
            'slug'                 => 'nullable|string|unique:packages,slug,' . $ignoreId,
            'type'                 => 'required|in:' . implode(',', array_keys(Package::TYPES)),
            'short_description'    => 'required|string|max:500',
            'description'          => 'required|string',
            'duration_days'        => 'required|integer|min:1',
            'price_usd'            => 'required|numeric|min:0',
            'price_usd_discounted' => 'nullable|numeric|min:0',
            'best_season'          => 'nullable|string|max:100',
            'group_size_max'       => 'integer|min:1',
            'destinations_covered' => 'nullable|string',
            'highlights'           => 'nullable|string',
            'included'             => 'nullable|string',
            'excluded'             => 'nullable|string',
            'featured_image'       => 'nullable|image|max:3072',
            'is_featured'          => 'boolean',
            'is_active'            => 'boolean',
            'sort_order'           => 'integer|min:0',
        ]);
    }

    private function textToArray(string $text): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }
}
