<?php

namespace App\Http\Controllers;

use App\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add(Request $request) {
        $prod_id = $request->productId;
        $user_id = Auth::user()->id;
        
        $favourite = Favourite::where('user_id', $user_id)->where('product_id', $prod_id)->first();
        if($favourite == null) {
            $fav = new Favourite();
            $fav->product_id = $prod_id;
            $fav->user_id = $user_id;
            $fav->save();
        } else {
            $favourite->delete();
        }

        return response()->json(['status' => 'success']);
    }

    public function view() {
        $user = Auth::user();

        $carts = $user == null ? [] : $user->carts;
        $favourites = $user == null ? [] : $user->favourites;

        $favouriteItems = $user->favourites;
        $in_cart = array_fill(0, count($favouriteItems), 0);
        $favourited = array_fill(0, count($favouriteItems), 0);
        $i = 0;
        foreach ($favouriteItems as $fav) {
            $item = $fav->product;
            $found = null;
            foreach ($carts as $cart) {
                if($item->id == $cart->product_id) {
                    $found = $cart;
                }
            }

            $found_fav = null;
            foreach ($favourites as $favourite) {
                if($item->id == $favourite->product_id) {
                    $found_fav = $favourite;
                }
            }
            $in_cart[$i] = $found == null ? 0 : $found->quantity;
            $favourited[$i] = $found_fav != null;
            $i++;
        }

        return view('favourites', [
            'favouriteItems' => $favouriteItems,
            'in_cart' => $in_cart,
            'favourited' => $favourited,
        ]);

    }
}
