<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

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
        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();

        $validator = Validator::make(request()->all(),[
            'name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required'],
            'payment_id' => ['required'],
            'courier' => ['required'],
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $carts = Cart::where('user_id', $user->id)->get();
        $transaction_total = Cart::where('user_id',$user->id)->sum('price');
        if($transaction_total < 1)
        {
            return ResponseFormatter::error(NULL,'Tidak ada produk dikeranjang.');
        }
        $transaction = auth()->user()->transactions()->create([
            'uuid' => Str::uuid(),
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'address' => request('address'),
            'transaction_total' => $transaction_total,
            'transaction_status' => 'PENDING',
            'courier' => request('courier'),
            'shipping_cost' => 0,
            'payment_id' => request('payment_id')
        ]);

        foreach($carts as $cart){
            $transaction->details()->create([
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
                'notes' => $cart->notes
            ]);
            $cart->product->decrement('qty', $cart->amount);
        }

        if($transaction)
        {
            return ResponseFormatter::success($transaction,'Anda berhasil melakukan checkout.');
        }else{
            return ResponseFormatter::error(NULL,'Checkout gagal.');
        }
    }
}
