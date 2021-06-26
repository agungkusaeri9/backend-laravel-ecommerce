<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Payment;
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
        $payments = Payment::orderBy('name','ASC')->get();
        return view('user.pages.cart.index',[
            'title' => 'Keranjang anda',
            'carts' => $carts,
            'store' => $this->store,
            'provinces' => $provinces,
            'cities' => $cities,
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'trx' => $trx,
            'payments' => $payments
        ]);
    }

    public function store()
    {
        request()->validate([
            'product_id' => ['required','numeric'],
            'amount' => ['required','numeric'],
            'price' => ['required'],
            'notes' => ['required']
        ]);

        $price = request('amount') * request('price');

        auth()->user()->carts()->create([
            'product_id' => request('product_id'),
            'amount' => request('amount'),
            'price' => $price,
            'notes' => request('notes')
        ]);

        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
