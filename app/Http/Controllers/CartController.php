<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function view() {
        $user = Auth::user();
        $carts = $user->carts;
        $subtotals = [];
        foreach ($carts as $cart) {
            $subtotals[] = $cart->quantity * $cart->product->price;
        }

        return view('carts', [
            'carts' => $carts,
            'subtotals' => $subtotals
        ]);
    }

    public function update(Request $request) {
        $newQty = $request->qty;
        $cart_id = $request->cart_id;

        $cart = Cart::find($cart_id);
        $cart->quantity = $newQty;
        if($newQty > 0) {
            $cart->save();
        } else {
            $cart->delete();
        }
        return back();
    }

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
        $cart->save();

        return redirect(route('products'));
    }
}
