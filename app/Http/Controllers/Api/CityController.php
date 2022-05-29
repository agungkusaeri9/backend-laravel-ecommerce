<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getByProvince($province_id)
    {
        $items = City::orderBy('city_name','ASC')->where('province_id',$province_id)->get();
        if($items)
        {
            return ResponseFormatter::success($items,'Data Kota berhasil diambil.',200);
        }else{
            return ResponseFormatter::error(null,'Data Kota tidak ada.');
        }
    }
}
