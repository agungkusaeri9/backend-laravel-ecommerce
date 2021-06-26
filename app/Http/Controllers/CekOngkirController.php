<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Store;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CekOngkirController extends Controller
{
    public function getCity($id)
    {
        $cities = City::where('province_id', $id)->pluck('city_name','city_id');

        return response()->json($cities);
    }

    public function cekongkir()
    {
        $carts = Cart::with('product.gallery')->where('user_id', auth()->id())->get();
        $weight = 0;
        foreach($carts as $cart)
        {
            $amount = $cart->amount;
            $weight = $weight + ($amount * $cart->product->weight);
        }

        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => 376,
            'destination'   => request('city_destination'),
            'weight'        => $weight,
            'courier'       => 'jne', 
        ])->get();
        return response()->json($ongkir);
    }
}
