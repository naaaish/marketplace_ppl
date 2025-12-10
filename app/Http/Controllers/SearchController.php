<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $category = $request->input('category');
        
        // Clean price inputs - remove dots and convert to integer
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        if ($minPrice) {
            $minPrice = (int) str_replace('.', '', $minPrice);
        }
        if ($maxPrice) {
            $maxPrice = (int) str_replace('.', '', $maxPrice);
        }
        
        $sort = $request->input('sort', 'relevance'); // default sorting

        // Base query
        $products = Product::where('status', 'active');

        // Search by name or description
        if ($query) {
            $products->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            });
        }

        // Filter by category
        if ($category) {
            $products->where('category', $category);
        }

        // Filter by price range
        if ($minPrice) {
            $products->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $products->where('price', '<=', $maxPrice);
        }

        // Sorting
        switch ($sort) {
            case 'price_low':
                $products->orderBy('price', 'asc');
                break;
            case 'price_high':
                $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $products->orderBy('rating', 'desc');
                break;
            default: // relevance
                $products->orderBy('rating', 'desc')
                         ->orderBy('rating_count', 'desc');
        }

        // Paginate results
        $products = $products->paginate(20);

        // Get available categories for filter
        $categories = Product::where('status', 'active')
                            ->distinct()
                            ->pluck('category');

        return view('search-results', compact('products', 'query', 'categories', 'category', 'minPrice', 'maxPrice', 'sort'));
    }
}