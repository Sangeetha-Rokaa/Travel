<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::ordered()->withCount('treks');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        if ($request->filled('status')) {
            match ($request->status) {
                'active' => $query->where('is_active', true),
                'inactive' => $query->where('is_active', false),
                'featured' => $query->where('is_featured', true),
                default => null,
            };
        }

        $destinations = $query->paginate(15);

        return view('admin.destinations.index', compact('destinations'));
    }
    public function create(): View
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('destinations', 'public');
        }

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }
    public function edit(Destination $destination): View
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validated = $this->validateRequest($request, $destination->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('destinations', 'public');
        }

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        $destination->delete();

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination deleted.');
    }

    private function validateRequest(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name'              => 'required|string|max:150',
            'slug'              => 'nullable|string|unique:destinations,slug,' . $ignoreId,
            'short_description' => 'required|string|max:500',
            'description'       => 'required|string',
            'location'          => 'required|string|max:200',
            'region'            => 'nullable|string|max:100',
            'altitude'          => 'nullable|string|max:50',
            'best_season'       => 'nullable|string|max:100',
            'featured_image'    => 'nullable|image|max:3072',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'sort_order'        => 'integer|min:0',
        ]);
    }
    public function show(Destination $destination): View
    {
        return view('admin.destinations.show', compact('destination'));
    }
}
