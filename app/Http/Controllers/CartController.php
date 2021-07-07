<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Courier;
use App\Payment;
use App\Product;
use App\Province;
use App\Store;
use App\Transaction;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    public $store;
    public function __construct(Store $store)
    {
        $this->store = Store::first();
    }

    public function index()
    {
        $carts = Cart::with('product.gallery')->where('user_id', auth()->id())->get();
        $provinces = Province::all();
        $cities = City::all();
        $transaction_latest = Transaction::orderBy('id','DESC')->limit(1)->first();
        if($transaction_latest){
            $trx = 'TRX' . str_pad($transaction_latest->id + 1,5,"0", STR_PAD_LEFT);
        }else{
            $trx = 'TRX' . str_pad(1,5,"0", STR_PAD_LEFT);
        }
        $couriers = Courier::all();
        $payments = Payment::orderBy('name','ASC')->get();
        return view('user.pages.cart.index',[
            'title' => 'Keranjang anda',
            'carts' => $carts,
            'store' => $this->store,
            'provinces' => $provinces,
            'cities' => $cities,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'trx' => $trx,
            'payments' => $payments,
            'couriers' => $couriers
        ]);
    }

    public function store()
    {
        $product = Product::findOrFail(request('product_id'));
        if($product->qty == 0){
            return redirect()->back()->with('failed', 'Out Of Stock');
        }elseif($product->qty < request('amount'))
        {
            return redirect()->back()->with('failed', 'Quantity is too much compared to product stock');
        }
        if(request('amount') && request('notes')){
            $amount = request('amount');
            $notes = request('notes');
        }else{
            $amount = 1;
            $notes = 'random';
        }
        $price = $amount * request('price');
        auth()->user()->carts()->create([
            'product_id' => request('product_id'),
            'amount' => $amount,
            'price' => $price,
            'notes' => $notes
        ]);
        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
