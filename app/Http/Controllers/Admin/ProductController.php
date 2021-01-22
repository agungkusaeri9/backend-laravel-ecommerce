<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        return view('admin.pages.product.index',[
            'title' => 'Data Produk',
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories = ProductCategory::orderBy('name','asc')->get();
        return view('admin.pages.product.create',[
            'title' => 'Tambah Produk',
            'categories' => $product_categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'product_category' => ['required'],
            'desc' => ['required','min:10'],
            'price' => ['required','numeric'],
            'qty' => ['required','numeric'],
        ]);
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.pages.product.show',[
            'title' => 'Detail Produk ' . $product->name,
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_categories = ProductCategory::orderBy('name','asc')->get();
        return view('admin.pages.product.edit',[
            'title' => 'Edit Produk ' . $product->name,
            'categories' => $product_categories,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required'],
            'product_category' => ['required'],
            'desc' => ['required','min:10'],
            'price' => ['required','numeric'],
            'qty' => ['required','numeric'],
        ]);
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Produk berhasil diubah!');
    }
}
