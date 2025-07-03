<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function checkout()
    {
        $carts = Cart::with('product:id,title,qty,price,selling_price,featured_image')->where('ip', request()->ip())->orWhere('user_id', auth('customer')->user()->id ?? 0)->get();
        
        return view('Frontend.checkout', compact('carts'));
    }
}
