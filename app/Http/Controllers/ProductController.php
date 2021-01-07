<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    protected function validator(array $data, $required)
    {
        $required = $required ? 'required|' : '';
        return Validator::make($data, [
            'image' => $required.'image',
            'name' => $required.'min:5'.$required ? '|unique:products' : '',
            'price' => $required.'min:5000|numeric',
            'category' => $required,
            'description' => $required.'min:10'
        ]);
    }

    public function viewAdd() {
        $categories = Category::all();

        return view('add-product', [
            'categories' => $categories
        ]);
    }

    public function add(Request $request) {
        $this->validator($request->all(), true)->validate();

        $image = $request->file('image');
        $image_name = $request->name.'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);

        $image_path = 'images/'.$image_name;
        $product = new Product();
        $product->image = $image_path;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('products');
    }

    public function viewUpdate(Product $product) {
        $categories = Category::all();

        return view('update-product', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product) {
        $this->validator($request->all(), false)->validate();

        if($product == null) {
            return redirect('home');
        }

        $image = $request->file('image');
        if($image != null) {
            $image_name = $request->name.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $image_path = 'images/'.$image_name;
            $product->image = $image_path;
        }

        if(isset($request->name)) {
            $product->name = $request->name;
        }
        if(isset($request->price)) {
            $product->price = $request->price;
        }
        if(isset($request->category)) {
            $product->category_id = $request->category;
        }
        if(isset($request->category)) {
            $product->description = $request->description;
        }
        $product->save();

        return redirect()->route('products');
    }

}
