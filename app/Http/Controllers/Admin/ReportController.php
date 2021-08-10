<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
    public function transaction($month = NULL,$date = NULL)
    {
        $date = request('date');
        $month = request('month');
        $currentYear = Carbon::now()->translatedFormat('Y');
        if($date){
            $transactions = Transaction::with('details','user')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->whereDate('created_at', '=', $date)->orderBy('created_at','DESC')->get();
        }else{
            if($month){
                $transactions = Transaction::with('details','user')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->whereYear('created_at',$currentYear)->whereMonth('created_at',$month)->orderBy('created_at','DESC')->get();
            }elseif($month === '' ||  !$month){
                $transactions = Transaction::with('details')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->orderBy('created_at','DESC')->get();
            }
        }
        $months = [
            ["no" => '01',"nama" => 'Januari'],
            ["no" => '02',"nama" => 'Februari'],
            ["no" => '03',"nama" => 'Maret'],
            ["no" => '04',"nama" => 'April'],
            ["no" => '05',"nama" => 'Mei'],
            ["no" => '06',"nama" => 'Juni'],
            ["no" => '07',"nama" => 'Juli'],
            ["no" => '08',"nama" => 'Agustus'],
            ["no" => '09',"nama" => 'September'],
            ["no" => '10',"nama" => 'Oktober'],
            ["no" => '11',"nama" => 'November'],
            ["no" => '12',"nama" => 'Desember'],
        ];
        return view('admin.pages.report.transaction.index',[
            'title' => 'Laporan Transaksi',
            'transactions' => $transactions,
            'months' => $months,
            'date' => $date,
            'month' => $month
        ]);
    }

    public function transactionPrint()
    {
        $date = request('date');
        $month = request('month');
        $currentYear = Carbon::now()->translatedFormat('Y');
        if(request('date')){
            $transactions = Transaction::with('details','user')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->whereDate('created_at',$date)->get();
            $date = Carbon::parse($date);
        }else{
            if($month){
                $transactions = Transaction::with('details','user')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->whereYear('created_at',$currentYear)->whereMonth('created_at',$month)->orderBy('created_at','DESC')->get();
            }else{
                $transactions = Transaction::with('details','user')->whereIn('transaction_status',['SUCCESS','DELIVERY'])->orderBy('created_at','DESC')->get();
            }
        }
        $count_total = $transactions->sum('transaction_total');
        $months = [
            ["no" => '01',"nama" => 'Januari'],
            ["no" => '02',"nama" => 'Februari'],
            ["no" => '03',"nama" => 'Maret'],
            ["no" => '04',"nama" => 'April'],
            ["no" => '05',"nama" => 'Mei'],
            ["no" => '06',"nama" => 'Juni'],
            ["no" => '07',"nama" => 'Juli'],
            ["no" => '08',"nama" => 'Agustus'],
            ["no" => '09',"nama" => 'September'],
            ["no" => '10',"nama" => 'Oktober'],
            ["no" => '11',"nama" => 'November'],
            ["no" => '12',"nama" => 'Desember'],
        ];
        foreach($months as $item){
            if($month === $item['no']){
                $month = $item['nama'];
            }
        }
        $pdf = PDF::loadView('admin.pages.report.transaction.print', [
            'transactions' => $transactions,
            'count_total' => $count_total,
            'date' => $date,
            'month' => $month
        ]);
        return $pdf->stream('Laporan Transaksi' . '.pdf');
    }
}
