<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_id = request('product');
        if($product_id){
            $productGalleries = ProductGallery::where('product_id',$product_id)->get();
        }else{
            $productGalleries = ProductGallery::orderBy('product_id','desc')->get();
        }
        $products = Product::orderBy('name','ASC')->get();
        return view('admin.pages.product-gallery.index',[
            'title' => 'Galeri Produk',
            'productGalleries' => $productGalleries,
            'products' => $products,
            'product_id' => $product_id
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
            'photo' => ['required']
        ]);
        $photo = request()->file('photo');
        foreach($photo as $ph)
        {
            $name = $ph->store('product','public');
            $gallery = new ProductGallery;
            $gallery->product_id = request('product_id');
            $gallery->photo = $name;
            $gallery->is_default = 0;
            $gallery->save();
        }

        return redirect()->back()->with('success','Foto Produk berhasil ditambahkan!');
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
            Storage::disk('public')->delete($productGallery->photo);
            $photo = $request->file('photo')->store('product');
        }else{
            $photo = $productGallery->photo;
        }
        $productGallery->update([
            'product_id' => $productGallery->product_id,
            'photo' => $photo,
            'is_default' => $request->is_default
        ]);

        return redirect()->route('admin.product-galleries.index')->with('success','Foto Produk berhasil diupdate!');
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
        return redirect()->back()->with('success','Foto Produk berhasil dihapus!');
    }

    public function setActive($product_id,$id)
    {
        ProductGallery::where('product_id',$product_id)->update([
            'is_default' => 0
        ]);

        ProductGallery::where('id',$id)->update([
            'is_default' => 1
        ]);

        return redirect()->back()->with('success','Foto berhasil di set sebagai aktif');
    }
}
