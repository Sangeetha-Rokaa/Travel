<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::with('parent')->withCount('products')->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            match ($request->status) {
                'active' => $query->where('is_active', true),
                'inactive' => $query->where('is_active', false),
                default => null,
            };
        }

        if ($request->filled('parent')) {
            match ($request->parent) {
                'top' => $query->whereNull('parent_id'),
                'sub' => $query->whereNotNull('parent_id'),
                default => null,
            };
        }

        $categories = $query->paginate(15)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        $validated['slug'] = $this->resolveSlug($validated);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category): View
    {
        $category->load('parent', 'children')->loadCount('products');

        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        $categories = Category::where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $this->validateRequest($request, $category->id);

        $validated['slug'] = $this->resolveSlug($validated, $category);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        if (isset($validated['parent_id']) && (int) $validated['parent_id'] === $category->id) {
            return back()
                ->withInput()
                ->withErrors(['parent_id' => 'A category cannot be its own parent.']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted.');
    }

    private function validateRequest(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name'        => 'required|string|max:150',
            'slug'        => 'nullable|string|unique:categories,slug,' . $ignoreId,
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|integer|exists:categories,id',
            'image'       => 'nullable|image|max:3072',
            'is_active'   => 'boolean',
        ]);
    }

    private function resolveSlug(array $validated, ?Category $category = null): string
    {
        if (! empty($validated['slug'])) {
            return Str::slug($validated['slug']);
        }

        if ($category && $category->slug) {
            return $category->slug;
        }

        return Str::slug($validated['name']);
    }
}
