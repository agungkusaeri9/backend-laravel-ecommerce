<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category(ProductCategory $category)
    {
        $products = Product::orderBy('created_at', 'desc')->where('product_category', $category->id)->paginate(12);
        $categories = ProductCategory::orderBy('name','asc')->get();
        return view('user.pages.product.index',[
            'title' => 'Selamat datang di Toko Kami',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show(Product $product)
    {
        return view('user.pages.product.show',[
            'title' => 'Detail Product ' . $product->name,
            'product' => $product,
        ]);
    }
}
