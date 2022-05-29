<?php

namespace App\Http\Controllers\Api;

use App\Courier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $items = Courier::where('status',1)->orderBy('name','ASC')->get();
        if($items)
        {
            return ResponseFormatter::success($items,'Data Kurir berhasil diambil.',200);
        }else{
            return ResponseFormatter::error(null,'Data Kurir tidak ada.');
        }
    }
}
