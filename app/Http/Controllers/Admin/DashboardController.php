<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->count();
        $products = Product::count();
        $transactions = Transaction::count();
        $income = Transaction::where('transaction_status', 1)->orWhere('transaction_status', 2)->orWhere('transaction_status', 3)->orWhere('transaction_status', 1)->sum('transaction_total');
        return view('admin.pages.dashboard',[
            'title' => 'Dashboard',
            'users' => $users,
            'products' => $products,
            'transactions' => $transactions,
            'income' => $income
        ]);
    }
}
