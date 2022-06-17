<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductCategory;
use App\ProductRating;
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
        $product_lainnya = Product::inRandomOrder()->limit(8)->get();
        return view('user.pages.product.index',[
            'title' => $title,
            'products' => $products,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'category' => $category,
            'product_lainnya' => $product_lainnya
        ]);
    }

    public function category($slug)
    {
        $category = ProductCategory::where('slug',$slug)->firstOrFail();
        $products = Product::where('product_category',$category->id)->paginate(16);
        $product_lainnya = Product::inRandomOrder()->limit(8)->get();
        return view('user.pages.product.index',[
            'title' => 'Produk ' . $category->name,
            'products' => $products,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'category' => $category,
            'product_lainnya' => $product_lainnya
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

    public function getRating()
    {
        $product_id = request('product_id');
        $productRating = ProductRating::with('user')->where('product_id',$product_id)->latest()->get();
        $productRating->map(function($data){
            $data['created'] = $data->created_at->translatedFormat('d/m/Y');
            $data['user_avatar'] = $data->user->avatar();
        });
        if($productRating)
        {
            $data = [
                'code' => 200,
                'status' => true,
                'message' => 'Produk ada',
                'data' => $productRating
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => false,
                'message' => 'Produk tidak ada',
                'data' => NULL
            ];
        }

        return response()->json($data);
    }

    public function show($slug)
    {
        $product = Product::with('ratings')->where('slug', $slug)->first();
        $related = Product::where('product_category', $product->product_category)->limit(12)->get();
        return view('user.pages.product.show',[
            'title' => $product->name,
            'product' => $product,
            'store' => $this->store,
            'product_related' => $related,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
        ]);
    }
}
