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
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->paginate(10);

        if ($transactions->count() > 0) {
            return ResponseFormatter::success($transactions, 'Transaksi berhasil diambil.');
        } else {
            return ResponseFormatter::error(NULL, "Transaksi Kosong.", 403);
        }
    }

    public function show($uuid)
    {
        $user = auth()->user();
        $transactions = Transaction::with('details.product')->where('user_id', $user->id)->where('uuid',  $uuid)->first();
        if ($transactions) {
            return ResponseFormatter::success($transactions, 'Detail Transaksi berhasil diambil.');
        } else {
            return ResponseFormatter::error(NULL, "Transaksi tidak ditemukan.", 403);
        }
    }
}
