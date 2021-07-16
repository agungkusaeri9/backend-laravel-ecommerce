<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $products = Product::count();
        $transactions = Transaction::count();
        $shipping_costs = Transaction::where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('shipping_cost');
        $income = 
        $transaction_total = Transaction::where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('transaction_total');
        $pie = [
            'success' => Transaction::where('transaction_status', 'SUCCESS')->count(),
            'delivery' => Transaction::where('transaction_status', 'DELIVERY')->count(),
            'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
        ];
        $transaction_latest = Transaction::orderBy('id','desc')->take(5)->get();
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $income = [
            'today' => DB::table('transactions')->whereDate('created_at',$today)->where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('transaction_total'),
            'yesterday' => DB::table('transactions')->whereDate('created_at',$yesterday)->where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('transaction_total'),
            'total' => Transaction::where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('transaction_total') - $shipping_costs
        ];
        // dd($today);
        return view('admin.pages.dashboard',[
            'title' => 'Dashboard',
            'users' => $users,
            'products' => $products,
            'transactions' => $transactions,
            'income' => $income,
            'pie' => $pie,
            'transaction_latest' => $transaction_latest,
            'shipping_costs' => $shipping_costs,
            'transaction_total' => $transaction_total
        ]);
    }
}
