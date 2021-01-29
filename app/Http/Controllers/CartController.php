<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('user.pages.cart.index',[
            'title' => 'Keranjang Anda',
            'carts' => $carts
        ]);
    }
    public function store(Product $product, Request $request)
    {
        $request->validate([
            'inf' => ['required']
        ]);
        if($request->product_total <= $product->product_total){
            return redirect()->back()->with('error','Jumlah melebihi stok!');
        }elseif($product->qty < 1){
            return redirect()->back()->with('error','Stok tidak tersedia');
        }

        $product->decrement('qty',$request->product_total);

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'product_total' => $request->product_total,
            'inf' => $request->inf,
            'price_total' => $request->product_total * $product->price
        ]);

        return redirect()->route('cart.index')->with('success','Produk ditambahkan ke dalam keranjang!');
    }
    public function destroy(Cart $cart)
    {
        
        $cart->product->increment('qty', $cart->product_total);
        $cart->delete();
        return redirect()->route('cart.index')->with('success','Produk dihapus dari keranjang!');
    }
}
