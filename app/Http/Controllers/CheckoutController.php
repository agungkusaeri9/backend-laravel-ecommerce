<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Notifications\Admin\NewCheckout;
use App\Product;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

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
            'shipping_cost' => ['required'],
            'courier' => ['required'],
        ]);

        $carts = Cart::where('user_id', auth()->id())->get();
        $transaction_latest = Transaction::orderBy('id','DESC')->limit(1)->first();
        if($transaction_latest){
            $trx = Carbon::now()->translatedFormat('Y') . Carbon::now()->translatedFormat('m') . Carbon::now()->translatedFormat('d') . str_pad($transaction_latest->id + 1,3,"0", STR_PAD_LEFT);
        }else{
            $trx = Carbon::now()->translatedFormat('Y') . Carbon::now()->translatedFormat('m') . Carbon::now()->translatedFormat('d') . str_pad(1,3,"0", STR_PAD_LEFT);
        }
        $transaction = auth()->user()->transactions()->create([
            'uuid' => $trx,
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'address' => request('address'),
            'transaction_total' => request('transaction_total'),
            'transaction_status' => 'PENDING',
            'courier' => request('courier'),
            'shipping_cost' => request('shipping_cost'),
            'payment' => request('payment')
        ]);

        foreach($carts as $cart){
            $transaction->details()->create([
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
                'notes' => $cart->notes
            ]);
            $cart->product->decrement('qty', $cart->amount);
        }

        $transaction->notify(new NewCheckout);

        auth()->user()->carts()->delete();

        return redirect()->route('transactions.success')->with('transaction_uuid', $transaction->uuid);
    }
}
