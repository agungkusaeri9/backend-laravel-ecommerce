<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function get()
    {
        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();

        $cart = Cart::with(['product.gallery','product.category'])->where('user_id',$user->id)->latest()->get();

        if($cart->count() > 0)
        {
           return ResponseFormatter::success($cart,'Keranjang berhasil diambil.');
        }else{
            return ResponseFormatter::error(NULL,"Keranjang Kosong.",403);
        }
    }

    public function addToCart()
    {
        $validator = Validator::make(request()->all(),[
            'product_id' => ['required']
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();
        $product = Product::find(request('product_id'));
        if($product->qty == 0){
            return ResponseFormatter::error(NULL,"Stok produk habis.",403);
        }elseif($product->qty < request('amount'))
        {
            return ResponseFormatter::error(NULL,"Jumlah Pesanan tidak boleh melebihi stok yang ada.",400);
        }
        if(request('amount')){
            $amount = request('amount');
        }else{
            $amount = 1;
        }
        if(request('notes')){
            $notes = request('notes');
        }else{
            $notes = 'random';
        }
        $cart = Cart::where('user_id',$user->id)->where('product_id',$product->id)->first();
        if($cart)
        {
            if(request('amount') < 1)
            {
                $amount2 = 1;
            }
            $amount = $cart->amount + $amount2;
            $price = $amount * $product->price;
            $cart->update([
                'amount' => $amount,
                'price' => $price
            ]);
        }else{
            $price = $amount * $product->price;
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => request('product_id'),
                'amount' => $amount,
                'price' => $price,
                'notes' => $notes
            ]);
        }
        return ResponseFormatter::success($cart,'Produk berhasil ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();
        $cart = Cart::where('user_id',$user->id)->where('id',$id);
        if($cart->count() > 0)
        {
            $cart->delete();
            return ResponseFormatter::success(NULL,'Produk berhasil dihapus dari keranjang.');
        }else{
            return ResponseFormatter::error(NULL,'Produk tidak ada di keranjang.');
        }
    }
}
