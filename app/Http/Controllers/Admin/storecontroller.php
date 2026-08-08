<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->when($request->filled('category'), fn ($q) => $q->whereHas(
                'category',
                fn ($cq) => $cq->where('slug', $request->category)
            ))
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('store.index', compact('products', 'categories'));
    }
}