<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductDiscoveryController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->string('q'));
        $category = $request->string('category')->toString();
        $location = $request->string('location')->toString();
        $availability = $request->string('availability')->toString();
        $min = $request->filled('min') ? (float) $request->input('min') : ($request->filled('min_price') ? (float) $request->input('min_price') : null);
        $max = $request->filled('max') ? (float) $request->input('max') : ($request->filled('max_price') ? (float) $request->input('max_price') : null);
        $sort = $request->string('sort', 'relevance')->toString();

        $products = Product::query()
            ->when($query, fn($q) => $q->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%")
                  ->orWhere('type', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%")
                  ->orWhereJsonContains('tags', $query);
            }))
            ->when($category, fn($q) => $q->where('category', $category))
            ->when($location, fn($q) => $q->where('location', $location))
            ->when($availability === 'available', fn($q) => $q->where('stock', '>', 0))
            ->when($availability === 'out_of_stock', fn($q) => $q->where('stock', '=', 0))
            ->when($min !== null, fn($q) => $q->where('price', '>=', $min))
            ->when($max !== null, fn($q) => $q->where('price', '<=', $max));

        match ($sort) {
            'price_low' => $products->orderBy('price'),
            'price_high' => $products->orderByDesc('price'),
            'rating' => $products->orderByDesc('rating'),
            'newest' => $products->latest(),
            default => $products->orderByDesc('is_featured')->orderByDesc('rating'),
        };

        $result = $products->paginate(12)->withQueryString();

        $related = Product::query()
            ->when($category, fn($q) => $q->where('category', $category))
            ->when(!$category && $query, fn($q) => $q->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")->orWhere('type', 'like', "%{$query}%")->orWhereJsonContains('tags', $query);
            }))
            ->whereNotIn('id', $result->pluck('id'))
            ->orderByDesc('rating')->limit(4)->get();

        if ($related->isEmpty()) $related = Product::where('is_featured', true)->limit(4)->get();

        return Inertia::render('Discovery/Index', [
            'products' => $result,
            'relatedProducts' => $related,
            'categories' => Product::query()->select('category')->distinct()->orderBy('category')->pluck('category'),
            'locations' => Product::query()->select('location')->distinct()->orderBy('location')->pluck('location'),
            'filters' => compact('query', 'category', 'location', 'availability', 'min', 'max', 'sort'),
        ]);
    }

    public function show(Product $product)
    {
        $related = Product::where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category', $product->category)->orWhere('type', $product->type);
            })->orderByDesc('rating')->limit(4)->get();

        return Inertia::render('Discovery/Show', compact('product', 'related'));
    }
}
