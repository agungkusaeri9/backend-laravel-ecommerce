<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\Admin\NewTransaction;
use App\Notification as AppNotification;
use App\Notifications\Admin\NewCheckout;
use App\Product;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
Use Illuminate\Support\Str;

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
        $transaction = auth()->user()->transactions()->create([
            'uuid' => Str::uuid(),
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'address' => request('address'),
            'transaction_total' => request('transaction_total'),
            'transaction_status' => 'PENDING',
            'courier' => request('courier'),
            'shipping_cost' => request('shipping_cost'),
            'payment_id' => request('payment')
        ]);

        foreach($carts as $cart){
            $transaction->details()->create([
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
                'notes' => $cart->notes
            ]);
            $cart->product->decrement('qty', $cart->amount);
        }

        // $transaction->notify(new NewCheckout);
        auth()->user()->carts()->delete();

        AppNotification::create([
            'user_id' => auth()->id(),
            'name' => 'checkout'
        ]);

        // notifikasi email ke admin
        $admin = User::first();
        Mail::to($admin->email)->send(new NewTransaction($transaction));


        return redirect()->route('transactions.success')->with('transaction_uuid', $transaction->uuid);
    }
}
