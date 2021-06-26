<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $products = Product::count();
        $transactions = Transaction::count();
        $income = Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total');
        $pie = [
            'success' => Transaction::where('transaction_status', 'SUCCESS')->count(),
            'delivery' => Transaction::where('transaction_status', 'DELIVERY')->count(),
            'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
        ];
        $transaction_latest = Transaction::orderBy('id','desc')->take(5)->get();
        return view('admin.pages.dashboard',[
            'title' => 'Dashboard',
            'users' => $users,
            'products' => $products,
            'transactions' => $transactions,
            'income' => $income,
            'pie' => $pie,
            'transaction_latest' => $transaction_latest
        ]);
    }
}
