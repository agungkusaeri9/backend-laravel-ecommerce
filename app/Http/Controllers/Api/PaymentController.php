<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $items = Payment::orderBy('name','ASC')->get();
        if($items)
        {
            return ResponseFormatter::success($items,'Data Metode Pembayaran berhasil diambil.',200);
        }else{
            return ResponseFormatter::error(null,'Data Metode Pembayaran tidak ada.');
        }
    }
}
