<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trek;
use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class TrekController extends Controller
{
    public function index(): View
    {
        $treks = Trek::ordered()->with('destination')->paginate(15);
        return view('admin.treks.index', compact('treks'));
    }

    public function create(): View
    {
        $destinations = Destination::active()->ordered()->get();
        $difficulties = Trek::DIFFICULTIES;
        return view('admin.treks.create', compact('destinations', 'difficulties'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('treks', 'public');
        }

        // Convert textarea newlines to JSON arrays
        foreach (['highlights', 'included', 'excluded', 'required_gear'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = $this->textToArray($validated[$field]);
            }
        }

        Trek::create($validated);

        return redirect()->route('admin.treks.index')
            ->with('success', 'Trek created successfully.');
    }

    public function edit(Trek $trek): View
    {
        $destinations = Destination::active()->ordered()->pluck('name', 'id');
        $difficulties = Trek::DIFFICULTIES;
        return view('admin.treks.edit', compact('trek', 'destinations', 'difficulties'));
    }

    public function update(Request $request, Trek $trek): RedirectResponse
    {
        $validated = $this->validateRequest($request, $trek->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('treks', 'public');
        }

        foreach (['highlights', 'included', 'excluded', 'required_gear'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = $this->textToArray($validated[$field]);
            }
        }

        $trek->update($validated);

        return redirect()->route('admin.treks.index')
            ->with('success', 'Trek updated successfully.');
    }

    public function destroy(Trek $trek): RedirectResponse
    {
        $trek->delete();
        return redirect()->route('admin.treks.index')
            ->with('success', 'Trek deleted.');
    }

    private function validateRequest(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'destination_id'    => 'nullable|exists:destinations,id',
            'name'              => 'required|string|max:200',
            'slug'              => 'nullable|string|unique:treks,slug,' . $ignoreId,
            'short_description' => 'required|string|max:500',
            'description'       => 'required|string',
            'difficulty'        => 'required|in:' . implode(',', Trek::DIFFICULTIES),
            'duration_days'     => 'required|integer|min:1',
            'max_altitude'      => 'nullable|string|max:50',
            'start_point'       => 'required|string|max:150',
            'end_point'         => 'required|string|max:150',
            'best_season'       => 'nullable|string|max:100',
            'price_usd'         => 'nullable|numeric|min:0',
            'group_size_min'    => 'integer|min:1',
            'group_size_max'    => 'integer|min:1',
            'highlights'        => 'nullable|string',
            'itinerary'         => 'nullable|string',
            'included'          => 'nullable|string',
            'excluded'          => 'nullable|string',
            'required_gear'     => 'nullable|string',
            'featured_image'    => 'nullable|image|max:3072',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'sort_order'        => 'integer|min:0',
        ]);
    }

    /** Convert newline-separated text to a JSON array */
    private function textToArray(string $text): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }
    public function show(Trek $trek): View
    {
        return view('admin.treks.show', compact('trek'));
    }
    public function removeImage(Request $request, Trek $trek)
    {
        try {
            // Validate request
            $request->validate([
                'image_type' => 'required|in:featured'
            ]);

            // Get the current featured image path
            $imagePath = $trek->featured_image;

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                // Delete the file from storage
                Storage::disk('public')->delete($imagePath);
            }

            // Update database
            $trek->update(['featured_image' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Featured image removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove a specific gallery image from trek
     */
    public function removeGalleryImage(Request $request, Trek $trek)
    {
        try {
            // Validate request
            $request->validate([
                'image_index' => 'required|integer|min:0'
            ]);

            $galleryImages = $trek->gallery_images ?? [];
            $imageIndex = $request->image_index;

            // Check if index exists
            if (!isset($galleryImages[$imageIndex])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found at specified index'
                ], 404);
            }

            // Get the image path
            $imagePath = $galleryImages[$imageIndex];

            // Delete the file from storage
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Remove from array
            unset($galleryImages[$imageIndex]);

            // Reindex array to maintain sequential keys
            $galleryImages = array_values($galleryImages);

            // Update database
            $trek->update(['gallery_images' => $galleryImages]);

            return response()->json([
                'success' => true,
                'message' => 'Gallery image removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Alternative: Remove featured image with trek ID parameter
     */
    public function removeFeaturedImage($id)
    {
        try {
            $trek = Trek::findOrFail($id);

            // Get the current featured image path
            $imagePath = $trek->featured_image;

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                // Delete the file from storage
                Storage::disk('public')->delete($imagePath);
            }

            // Update database
            $trek->update(['featured_image' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Featured image removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove image: ' . $e->getMessage()
            ], 500);
        }
    }
}
