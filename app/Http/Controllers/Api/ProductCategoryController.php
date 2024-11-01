<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function getAll()
    {
        $items = ProductCategory::orderBy('name', 'ASC')->get();
        if (count($items)) {
            return ResponseFormatter::success($items, 'Product Category Found!');
        } else {
            return ResponseFormatter::error(null, "Product Category Not Found!");
        }
    }
}
