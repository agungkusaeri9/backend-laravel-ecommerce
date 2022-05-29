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
            'today' => Transaction::whereDate('created_at',$today)->where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('transaction_total'),
            'total' => Transaction::where('transaction_status', 'SUCCESS')->orWhere('transaction_status', 'DELIVERY')->sum('transaction_total') - $shipping_costs
        ];

        // $trx[
        //     Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','01')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')
        // ]
        $pendapatan = [
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','01')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','02')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','03')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','04')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','05')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','06')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','07')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','08')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','09')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','10')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','11')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total')),
            intval(Transaction::whereyear('created_at',Carbon::now()->format('Y'))->whereMonth('created_at','12')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->sum('transaction_total'))
        ];

        return view('admin.pages.dashboard',[
            'title' => 'Dashboard',
            'users' => $users,
            'products' => $products,
            'transactions' => $transactions,
            'income' => $income,
            'pie' => $pie,
            'transaction_latest' => $transaction_latest,
            'shipping_costs' => $shipping_costs,
            'transaction_total' => $transaction_total,
            'pendapatan' => $pendapatan
        ]);
    }
}
