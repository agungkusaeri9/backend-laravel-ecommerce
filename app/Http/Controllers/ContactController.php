<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Store;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('user.pages.contact',[
            'title' => 'Contact Us',
            'store' => Store::first(),
            'cart_count' => Cart::where('user_id', auth()->id())->count()
        ]);
    }
}
