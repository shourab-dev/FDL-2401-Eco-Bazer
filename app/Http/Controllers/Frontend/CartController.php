<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'title'    => $product->title,
                'price'    => $product->price,
                'quantity' => 1,
                'image'    => $product->featured_image,
            ];
        }

        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        $cart = session('cart', []);
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
        return view('Frontend.cart', compact('cart', 'total'));
    }

    public function cartUpdate(Request $request)
    {
        $id   = $request->Product_id;
        $qty  = max(1, (int)$request->quantity);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            session(['cart' => $cart]);
        }

        // recalc total
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
        $view  = view('Frontend.cart.cart-total', compact('total'))->render();

        return response()->json([
            'success'          => true,
            'cart_total_html'  => $view,
        ]);
    }

    public function remove(Request $request)
    {
        $id   = $request->id;
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        // recalc total & count
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);

        $view = view('Frontend.cart.cart-total', compact('total'))->render();

        return response()->json([
            'success'          => true,
            'count'            => count($cart),
            'cart_total_html'  => $view,
        ]);
    }
}
