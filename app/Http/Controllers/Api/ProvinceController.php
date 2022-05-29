<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function all()
    {
        $items = Province::orderBy('province_name','ASC')->get();
        if($items)
        {
            return ResponseFormatter::success($items,'Data Provinsi berhasil diambil.',200);
        }else{
            return ResponseFormatter::error(null,'Data Provinsi tidak ada.');
        }

    }
}
