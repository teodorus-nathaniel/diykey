<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->q;
        $category = $request->category;
        $categories = Category::all();

        $user = Auth::user();

        $category_obj = Category::where('name', $category)->first();
        $product_query = Product::where('name', 'like', '%'.$search.'%');
        if($category_obj) 
            $products = $product_query->where('category_id', $category_obj->id)->paginate(20);
        else
            $products = $product_query->paginate(20);

        $carts = $user == null ? [] : $user->carts;
        $favourites = $user == null ? [] : $user->favourites;

        $items = $products->items();
        $in_cart = array_fill(0, count($items), 0);
        $favourited = array_fill(0, count($items), 0);
        $i = 0;
        foreach ($items as $item) {
            $found = null;
            foreach ($carts as $cart) {
                if($item->name == $cart->product->name) {
                    $found = $cart;
                }
            }

            $found_fav = null;
            foreach ($favourites as $favourite) {
                if($item->name == $favourite->product->name) {
                    $found = $cart;
                }
            }
            $in_cart[$i] = $found == null ? 0 : $found->quantity;
            $favourited[$i] = $found_fav != null;
            $i++;
        }

        return view('home', [
            'categories' => $categories,
            'selected_category' => $category,
            'products' => $products,
            'in_cart' => $in_cart,
            'favourited' => $favourited,
            'search' => $search
        ]);
    }

    public function detail(Product $product) {
        $user = Auth::user();
        $cart = Cart::where('user_id', 'like', $user ? $user->id : '%')->where('product_id', $product->id)->first();

        return view('detail', [
            'product' => $product,
            'qty' => $cart == null ? 0 : $cart->quantity
        ]);
    }
}
