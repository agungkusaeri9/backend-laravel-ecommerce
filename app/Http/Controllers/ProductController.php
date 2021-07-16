<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductCategory;
use App\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $store;
    public function __construct(Store $store)
    {
        $this->store = Store::first();
    }

    public function index($slug = NULL)
    {
        if($slug !== NULL)
        {
            $category = ProductCategory::where('slug', $slug)->first();
            if(!$category){abort(404);}
            $products = Product::with('category','gallery')->where('product_category', $category->id)->latest()->simplePaginate(12);
            $title = $category->name;
        }else{
            $category = NULL;
            $products = Product::with('category','gallery')->latest()->simplePaginate(12);
            $title = 'Semua Produk';
        }
        return view('user.pages.product.index',[
            'title' => $title,
            'products' => $products,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'category' => $category
        ]);
    }

    public function search()
    {
        $category = NULL;
        $products = Product::with('category','gallery')->orWhere('name', 'like', '%' . request('name') . '%')->paginate(15);
        $title = 'Semua Produk';
        return view('user.pages.product.index',[
            'title' => $title,
            'products' => $products,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'category' => $category
        ]);
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
