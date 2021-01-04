<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request) {
        $this->validate($request, [
            'qty' => 'numeric|min:1'
        ]);

        $user = Auth::user();

        $product = Product::find($request->product);
        if($product == null)    return back();

        $cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();
        if($cart == null) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
        }
        $cart->quantity = $request->qty;

        return redirect(route('products'));
    }
}
