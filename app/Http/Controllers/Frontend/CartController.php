<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        if (!Product::where('id', $id)->exists()) {
            return response()->json(['status' => 'error', 'msg' => 'Product not found'], 401);
        }
        if (!$this->isExists($id)) {
            //* Create
            $cart = new Cart();
            $cart->ip = auth()->check() ? null : request()->ip();
            $cart->user_id = auth()->user()->id ?? null;
            $cart->product_id = $id;
            $cart->qty = 1;
            $cart->save();
        } else {
            //* Update
            $this->qtyUpdate($id);
        }
        return response()->json(['status' => 'success', 'msg' => 'Product has been added!']);
    }

    function summary()
    {

        $cart =  Cart::with('product:id,slug,title,price,selling_price,featured_image')->where(function ($q) {
            return $q->where('ip', request()->ip())->orWhere('user_id', auth()?->user()?->id);
        })->get();

        $products = $cart->pluck('product');
        $total = 0;
        foreach ($products as $product) {
            $total += (!$product->selling_price ?  $product->price : $product->selling_price) * $cart->where('product_id', $product->id)->first()->qty;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cart summary',
            'cart' => $cart,
            'products' => $products,
            'total' => $total
        ]);
    }

    public function cart() {}

    private function isExists($id = null)
    {

        $ipAddress  = request()->ip() ?? null;
        return Cart::where(function ($q) use ($ipAddress) {
            return $q->where('ip', $ipAddress)->orWhere('user_id', auth('customer')?->user()?->id);
        })->where('product_id', $id)->exists();
    }


    function qtyUpdate($id = null, $operator = 'increment', $qty = 1)
    {
        if (!Product::where('id', $id)->exists()) {
            return response()->json(['status' => 'error', 'msg' => 'Product not found'], 401);
        }
        $query =  Cart::query()->where(function ($q) {
            return $q->where('ip', request()->ip())->orWhere('user_id', auth()?->user()?->id);
        })->where('product_id', $id);

        if ($operator == 'increment') {
            $query->increment('qty', $qty);
        } else if ($operator == 'decrement') {
            $query->decrement('qty', $qty);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Invalid operator'], 401);
        }
    }

    public function cartUpdate(Request $request) {}

    public function remove(Request $request) {}
}
