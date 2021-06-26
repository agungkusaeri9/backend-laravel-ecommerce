<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use App\Shipment;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('details.product.category')->orderBy('id','desc')->get();
        return view('admin.pages.transaction.index',[
            'title' => 'Data Transaksi',
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('admin.pages.transaction.show',[
            'title' => 'Detail Transaksi',
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $payments = Payment::all();
        $shipments = Shipment::all();
        return view('admin.pages.transaction.edit',[
            'title' => 'Edit Transaksi ' . $transaction->uuid,
            'transaction' => $transaction,
            'payments' => $payments,
            'shipments' => $shipments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'shipment_id' => ['required'],
            'payment_id' => ['required'],
        ]);

        $data = $request->all();

        $transaction->update($data);

        return redirect()->route('admin.transactions.index')->with('success','Transaksi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success','Transaksi berhasil dihapus!');
    }

    public function set($id)
    {
        request()->validate([
            'status' => ['required','in:SUCCESS,PENDING,DELIVERY,FAILED']
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = request('status');
        $transaction->save();

        return redirect()->back()->with('success','Status berhasil diupdate');
    }
}
