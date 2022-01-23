<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportTransactionExport implements FromView
{
    public function __construct($date)
    {
        $this->date = $date;
    }

    public function view(): View
    {
        $transactions = Transaction::whereDate('');
        return view('admin.pages.report.transaction.export', [
            'transactions' => Transaction::all()
        ]);
    }
}
