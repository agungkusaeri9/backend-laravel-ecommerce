<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        $limit =  request('limit') ?? 10;
        $type = request('type');
        $category = request('category');

        try {
            $prod = Product::with('category', 'gallery');
            if ($type) {
                if ($type === 'best') {
                    $prod->orderBy('sold', 'DESC');
                }
            }
            if ($category) {
                $prod->whereHas('category', function ($cat) use ($category) {
                    $cat->where('slug', $category);
                });
            }
            $products = $prod->paginate($limit);
            // Menyusun pagination data
            $pagination = [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ];

            // Mengembalikan response dengan data dan pagination
            return ResponseFormatter::success(ProductResource::collection($products), "Products Found.", 200, $pagination);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, 'Error Invalid.');
        }
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'gallery'])->where('slug', $slug)->first();
        if (!$product) {
            return ResponseFormatter::error(NULL, 'Produk tidak ada.');
        }

        return ResponseFormatter::success($product, 'Produk ada.');
    }

    public function search()
    {
        $q = request('q');
        if ($q) {
            $products = Product::with('category', 'gallery')->where('name', 'like', '%' . $q . '%')->latest()->get();
        } else {
            $products = Product::with('category', 'gallery')->latest()->get();
        }

        if ($products->count() < 1) {
            return ResponseFormatter::error(NULL, 'Produk tidak ada.', 403);
        }

        return ResponseFormatter::success($products, 'Produk berhasil diambil.');
    }
}
