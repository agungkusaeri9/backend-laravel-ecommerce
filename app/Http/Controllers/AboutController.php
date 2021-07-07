<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Store;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('user.pages.about',[
            'title' => 'About Us',
            'store' => Store::first(),
            'cart_count' => Cart::where('user_id', auth()->id())->count()
        ]);
    }
}
