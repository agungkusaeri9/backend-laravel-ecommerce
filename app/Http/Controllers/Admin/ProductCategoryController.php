<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_categories = ProductCategory::orderBy('name','asc')->get();
        return view('admin.pages.product-category.index',[
            'title' => 'Data Kategori Produk',
            'product_categories' => $product_categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product-category.create',[
            'title' => 'Tambah Kategori Produk'
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
            'gambar' => ['required','image','mimes:jpg,jpeg,png'],
        ]);
        $gambar = $request->file('gambar')->store('product-category','public');
        ProductCategory::create([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name),
            'icon' => $gambar
        ]);

        return redirect()->route('admin.product-categories.index')->with('success','Kategori berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.pages.product-category.edit',[
            'title' => 'Edit Kategori Produk ' . $productCategory->name,
            'productCategory' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => ['required'],
            'gambar' => ['image','mimes:jpg,jpeg,png'],
        ]);
        if($request->hasFile('gambar')){
            Storage::disk('public')->delete($productCategory->icon);
            $gambar = $request->file('gambar')->store('product-category','public');
        }else{
            $gambar = $productCategory->icon;
        }
        $productCategory->update([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name),
            'icon' => $gambar
        ]);

        return redirect()->route('admin.product-categories.index')->with('success','Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        Storage::disk('public')->delete($productCategory->icon);
        return redirect()->route('admin.product-categories.index')->with('success','Kategori berhasil dihapus!');
    }
}
