<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionController extends Controller
{
    public function get()
    {
        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();

        $transactions = Transaction::where('user_id',$user->id)->latest()->get();

        if($transactions->count() > 0)
        {
           return ResponseFormatter::success($transactions,'Transaksi berhasil diambil.');
        }else{
            return ResponseFormatter::error(NULL,"Transaksi Kosong.",403);
        }
    }

    public function show($id)
    {
        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();

        $transactions = Transaction::with('details.product')->where('user_id',$user->id)->where('id',$id)->first();

        if($transactions)
        {
           return ResponseFormatter::success($transactions,'Detail Transaksi berhasil diambil.');
        }else{
            return ResponseFormatter::error(NULL,"Transaksi tidak ditemukan.",403);
        }
    }
}
