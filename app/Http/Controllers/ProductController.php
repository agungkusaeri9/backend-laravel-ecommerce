<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $store;
    public function __construct(Store $store)
    {
        $this->store = Store::first();
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $related = Product::where('product_category', $product->product_category)->limit(4)->get();
        return view('user.pages.product.show',[
            'title' => $product->name,
            'product' => $product,
            'store' => $this->store,
            'product_related' => $related,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
        ]);
    }
}
