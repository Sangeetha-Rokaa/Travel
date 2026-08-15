<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('client_photo')) {
            $validated['client_photo'] = $request->file('client_photo')
                ->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial added.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('client_photo')) {
            $validated['client_photo'] = $request->file('client_photo')
                ->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted.');
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'client_name'    => 'required|string|max:100',
            'client_country' => 'required|string|max:100',
            'client_photo'   => 'nullable|image|max:2048',
            'trek_or_package' => 'nullable|string|max:200',
            'rating'         => 'required|integer|min:1|max:5',
            'review'         => 'required|string|max:2000',
            'travel_date'    => 'nullable|date',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
        ]);
    }
    public function show(Testimonial $testimonial): View
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }
}
