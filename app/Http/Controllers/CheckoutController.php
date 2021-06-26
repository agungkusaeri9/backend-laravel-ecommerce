<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required'],
            'ongkir' => ['required'],
        ]);

        $carts = Cart::where('user_id', auth()->id())->get();
        $transaction_latest = Transaction::orderBy('id','DESC')->limit(1)->first();
        if($transaction_latest){
            $trx = 'TRX' . str_pad($transaction_latest->id + 1,5,"0", STR_PAD_LEFT);
        }else{
            $trx = 'TRX' . str_pad(1,5,"0", STR_PAD_LEFT);
        }
        $transaction = auth()->user()->transactions()->create([
            'uuid' => $trx,
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'address' => request('address'),
            'transaction_total' => request('transaction_total'),
            'transaction_status' => 'PENDING',
            'shipment_id' => 1,
            'payment_id' => request('payment_id')
        ]);

        foreach($carts as $cart){
            $transaction->details()->create([
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
                'notes' => $cart->notes
            ]);
        }

        auth()->user()->carts()->delete();

        return redirect()->route('transactions.success')->with('success', 'Silakan tunggu update terbaru dari kami via email yang sudah Anda daftarkan sebelumnya.');
    }
}
