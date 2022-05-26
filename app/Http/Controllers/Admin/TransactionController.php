<?php

namespace App\Http\Controllers\Admin;

use App\Courier;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Shipment;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = request('status');
        $date  = request('date');
        if($status && $status != NULL)
        {
            // cek jika ada date
            if($date)
            {
                $transactions = Transaction::with('details.product.category')->where('transaction_status',$status)->whereDate('created_at', '=',$date)->orderBy('id','desc')->get();
            }else{
                $transactions = Transaction::with('details.product.category')->where('transaction_status',$status)->orderBy('id','desc')->get();
                $date = NULL;
            }
            
        }else{
            if($date)
            {
                $transactions = Transaction::with('details.product.category')->whereDate('created_at', '=',$date)->orderBy('id','desc')->get();
            }else{
                $transactions = Transaction::with('details.product.category')->orderBy('id','desc')->get();
                $date = NULL;
            }
            $status = NULL;
        }
        return view('admin.pages.transaction.index',[
            'title' => 'Data Transaksi',
            'transactions' => $transactions,
            'status' => $status,
            'date' => $date
        ]);
    }

    public function download($id)
    {
        $item = Transaction::findOrFail($id);
        $mimes = Str::after($item->proof_of_payment, '.');
        $filePath = public_path('storage/') . $item->proof_of_payment;
    	$headers = ['Content-Type:' . $mimes];
    	$fileName = 'bukti-pembayaran' . '-' . $item->uuid . '.' . $mimes;

        if(!file_exists($filePath)){
            return redirect()->back()->with('gagal','Downloading Failed.');
        }
        return response()->download($filePath, $fileName, $headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {   
        $price_total = 0;
        foreach($transaction->details as $details){
            $product_price = $details->product->price;
            $product_amount = $details->amount;
            $price_total = $price_total + ($product_price * $product_amount);
        }
        return view('admin.pages.transaction.show',[
            'title' => 'Detail Transaksi',
            'transaction' => $transaction,
            'price_total' => $price_total
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
        $couriers = Courier::all();
        return view('admin.pages.transaction.edit',[
            'title' => 'Edit Transaksi ' . $transaction->uuid,
            'transaction' => $transaction,
            'payments' => $payments,
            'couriers' => $couriers
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
        $transaction->update([
            'receipt_number' => request('receipt_number')
        ]);

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
        Storage::disk('public')->delete($transaction->proof_of_payment);
        return redirect()->route('admin.transactions.index')->with('success','Transaction has been deleted!');
    }

    public function set($id)
    {
        request()->validate([
            'status' => ['required','in:SUCCESS,PENDING,DELIVERY,FAILED']
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = request('status');
        $transaction->save();


        // kembalikan qty ketika transaksi gagal
        if(request('status') === 'FAILED')
        {
            foreach($transaction->details as $detail)
            {
                $detail->product->increment('qty',$detail->amount);
                $detail->product->decrement('sold',$detail->amount);
            }
        }else if(request('status') === 'SUCCESS' || request('status') === 'DELIVERY')
        {
            foreach($transaction->details as $detail)
            {
                $detail->product->increment('sold',$detail->amount);
                $detail->product->decrement('qty',$detail->amount);
            }
        }

        $transaction->save();

        return redirect()->back()->with('success','Status berhasil diupdate');
    }
}
