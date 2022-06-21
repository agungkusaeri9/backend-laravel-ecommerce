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
            'product_lainnya' => $product_lainnya,
            'q' => NULL
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
            'product_lainnya' => $product_lainnya,
            'q' => NULL
        ]);
    }

    public function search()
    {
        $category = NULL;
        $products = Product::with('category','gallery')->where('name', 'like', '%' . request('q') . '%')->paginate(15);
        $title = 'Produk ' . request('q');
        $product_lainnya = Product::inRandomOrder()->limit(8)->get();
        return view('user.pages.product.index',[
            'title' => $title,
            'products' => $products,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'category' => $category,
            'product_lainnya' => $product_lainnya,
            'q' => request('q')
        ]);
    }

    public function getRating()
    {
        $product_id = request('product_id');
        $productRating = ProductRating::with('user')->where('product_id',$product_id)->latest()->get();
        $productRating->map(function($data)  use ($product_id){
            $data['created'] = $data->created_at->translatedFormat('d/m/Y');
            $data['user_avatar'] = $data->user->avatar();
            $data['total_value'] = $data->where('product_id',$product_id)->sum('value');
            $data['total_user'] = $data->where('product_id',$product_id)->count();
            $data['total'] = number_format(($data['total_value']/$data['total_user']),1,',','');
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

    public function ratingStore()
    {
        request()->validate([
            'product_id' => ['required'],
            'value' => ['required','numeric']
        ]);

        $rating = ProductRating::where('user_id',auth()->id())->where('product_id',request('product_id'))->first();
        if($rating)
        {
            return redirect()->back()->with('error','Anda sudah memberikan rating untuk produk ini.');
        }
        ProductRating::create([
            'user_id' => auth()->id(),
            'comment' => request('comment'),
            'product_id' => request('product_id'),
            'value' => request('value')
        ]);

        return redirect()->back()->with('success','Anda berhasil memberikan rating untuk produk ini.');
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
