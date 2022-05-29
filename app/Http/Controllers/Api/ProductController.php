<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        $products = Product::with('category','gallery')->latest()->get();
        if(!$products)
        {
            return ResponseFormatter::error(NULL,'Produk gagal diambil.');
        }

        return ResponseFormatter::success($products,'Produk berhasil diambil.');
    }

    public function show($slug)
    {
        $product = Product::with(['category','gallery'])->where('slug',$slug)->first();
        if(!$product)
        {
            return ResponseFormatter::error(NULL,'Produk tidak ada.');
        }

        return ResponseFormatter::success($product,'Produk ada.');
    }

    public function search()
    {
        $q = request('q');
        if($q)
        {
            $products = Product::with('category','gallery')->where('name','like','%' . $q . '%')->latest()->get();
        }else{
            $products = Product::with('category','gallery')->latest()->get();
        }

        if($products->count() < 1)
        {
            return ResponseFormatter::error(NULL,'Produk tidak ada.',403);
        }

        return ResponseFormatter::success($products,'Produk berhasil diambil.');
    }
}
