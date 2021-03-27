<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Payment;
use App\Shipment;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at','desc')->where('user_id', auth()->id())->get();
        return view('user.pages.transaction.index',[
            'title' => 'Riwayat Transaksi',
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request, Cart $cart)
    {
        request()->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],

        ]);

        $transaction = Transaction::create([
            'uuid' => Str::random(5),
            'user_id' => $cart->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'transaction_total' => $cart->sum('price_total'),
            'transaction_status' => 5,
            'shipment_id' => $request->shipment_id,
            'payment_id' => $request->payment_id,
        ]);

        $carts = Cart::where('user_id', auth()->id())->get();

        foreach($carts as $cart){
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'product_total' => $cart->product_total,
                'price_total' => $cart->price_total,
                'inf' => $cart->inf
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('home')->with('success','Transaksi berhasil dibuat, Silahkan Bayar terlebih dahulu');
    }
    public function checkout(Cart $cart)
    {
        $payments = Payment::orderBy('name','asc')->get();
        $shipments = Shipment::orderBy('name','asc')->get();
        return view('user.pages.transaction.checkout',[
            'title' => 'Isi form pembeli',
            'cart' => $cart,
            'payments' => $payments,
            'shipments' => $shipments
        ]);
    }

    public function confirmation(Transaction $transaction)
    {
        return view('user.pages.transaction.confirmation',[
            'title' => 'Konfirmasi Pembayaran',
            'transaction' => $transaction
        ]);
    }
}
