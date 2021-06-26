<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Payment;
use App\Product;
use App\ProductCategory;
use App\Store;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $store;
    public function __construct(Store $store)
    {
        $this->store = Store::first();
    }
    public function index(ProductCategory $category)
    {
        $latest = Product::with('category','gallery')->orderBy('created_at', 'desc')->limit(9)->get();
        $categories = ProductCategory::orderBy('name','asc')->limit(6)->get();
        $banner = Product::with('category','gallery')->inRandomOrder()->limit(5)->get();
        $teraliris = Product::with('category','gallery')->inRandomOrder()->limit(5)->get();
        return view('user.pages.index',[
            'title' => 'Selamat datang di Toko Kami',
            'products_latest' => $latest,
            'categories' => $categories,
            'product_banner' => $banner,
            'product_terlaris' => $teraliris,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count()
        ]);
    }

    public function getPayment($id)
    {
        $payment = Payment::where('id', $id)->first();

        return response()->json($payment);
    }
}
