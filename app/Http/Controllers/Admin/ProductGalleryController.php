<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productGalleries = ProductGallery::orderBy('product_id','desc')->get();
        return view('admin.pages.product-gallery.index',[
            'title' => 'Galeri Produk',
            'productGalleries' => $productGalleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('name','asc')->get();
        return view('admin.pages.product-gallery.create',[
            'title' => 'Galeri Produk',
            'products' => $products
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
            'product_id' => ['required'],
            'photo' => ['required','image','mimes:jpg,jpeg,png']
        ]);
        $photo = $request->file('photo')->store('product');
        ProductGallery::create([
            'product_id' => $request->product_id,
            'photo' => $photo,
            'is_default' => $request->is_default
        ]);

        return redirect()->route('admin.product-galleries.index')->with('success','Foto Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGallery $productGallery)
    {
        $products = Product::orderBy('name','asc')->get();
        return view('admin.pages.product-gallery.edit',[
            'title' => 'Galeri Produk',
            'products' => $products,
            'productGallery' => $productGallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGallery $productGallery)
    {
        $request->validate([
            'product_id' => ['required'],
            'photo' => ['image','mimes:jpg,jpeg,png']
        ]);
        if($request->hasFile('photo')){
            unlink('storage/' . $productGallery->photo);
            $photo = $request->file('photo')->store('product');
        }else{
            $photo = $productGallery->photo;
        }
        $productGallery->update([
            'product_id' => $request->product_id,
            'photo' => $photo,
            'is_default' => $request->is_default
        ]);

        return redirect()->route('admin.product-galleries.index')->with('success','Foto Produk berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGallery $productGallery)
    {
        $productGallery->delete();
        return redirect()->route('admin.product-galleries.index')->with('success','Foto Produk berhasil dihapus!');
    }
}
