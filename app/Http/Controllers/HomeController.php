<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductGallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ProductCategory $category)
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        $categories = ProductCategory::orderBy('name','asc')->get();
        return view('user.pages.product.index',[
            'title' => 'Selamat datang di Toko Kami',
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
