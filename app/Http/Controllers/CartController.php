<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::latest()->with('products')->where('user_id', Auth::user()->id)
            ->where('isActive', 1)->first();
        $cartItems = $carts->products;
        return view('user.cart', [
            'carts' => $carts,
            'cartItems' => $cartItems,
        ]);
    }

    public function update($key)
    {

        Cart::where('id', $key)->update(['isActive' => 0]);

        Cart::create([
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('home'))->with('purchased', 'Thank you, Product has been purchased successfully !');
    }

    public function store(Request  $request)
    {
        $cart = Cart::latest()->with('products')->where('user_id', Auth::user()->id)
            ->where('isActive', 1)->first();
        $quantity = $request->quantity;
        $productId = $request->product_id;

        $cart->products()->attach(
            $productId,
            [
                'quantity' => $quantity,
                'cart_id' => $cart->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect('/')->with('purchased', 'Product has been purchased!');
    }
}
