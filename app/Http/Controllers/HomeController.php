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
    public function __construct()
    {
        $this->store = Store::first();
    }
    public function index()
    {
        $latest = Product::with('category','gallery')->orderBy('created_at', 'desc')->limit(16)->get();
        $categories = ProductCategory::orderBy('name','asc')->get();
        $banner = Product::with('category','gallery')->inRandomOrder()->limit(5)->get();
        $teraliris = Product::with('category','gallery')->inRandomOrder()->limit(5)->get();
        return view('user.pages.home',[
            'title' => 'Selamat datang di Toko Kami',
            'products_latest' => $latest,
            'categories' => $categories,
            'product_banner' => $banner,
            'product_terlaris' => $teraliris,
            'store' => $this->store,
            'cart_count' => Cart::where('user_id', auth()->id())->count()
        ]);
    }

    public function getPayment($name)
    {
        $payment = Payment::where('name', $name)->first();

        return response()->json($payment);
    }

}
