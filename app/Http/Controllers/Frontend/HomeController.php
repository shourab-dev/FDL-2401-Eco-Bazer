<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $products = Product::where('status', true)->latest()->take(30)->get();
        $categories = $products->pluck('category')->unique('id');
        return view('Frontend.index', compact('products', 'categories'));
    }

    function getCategoryProducts($slug)
    {
        $products = Product::whereHas('category', function ($q) use ($slug) {
            return $q->where('slug', $slug);
        })->paginate(20);


        return view('Frontend.category_archeive', compact('products'));
    }


    function singleProduct($slug)
    {
        $product = Product::with('category', 'brand')->where('slug', $slug)->where('status', true)->first();
        if ($product->gallery_images) {
            $galleries = json_decode($product->gallery_images);
            array_unshift($galleries, $product->featured_image);
            $product->gallery_images = $galleries;
        }
        $relatedProducts = Product::whereHas('category', function ($q) use ($product) {
            return $q->where('id', $product->category->id);
        })->where('id', '!=', $product->id)->take(8)->get();

        return view('Frontend.single-product', compact('product', 'relatedProducts'));
    }


    function searchProduct(Request $request)
    {
        $search = $request->search;

        if (!empty($search)) {
            $products = Product::whereLike('title', '%' . $search . '%')->where('status', true)->select('id', 'title', 'slug')->latest()->limit(30)->get();
            return response()->json($products, 200);
        }
    }


    function search(Request $request)
    {

        $search = $request->search;
        $products = null;
        if (!empty($search)) {
            $products = Product::whereLike('title', '%' . $search . '%')->where('status', true)->latest()->paginate(20);
        }
        return view('Frontend.search', compact('products'));
    }
}
