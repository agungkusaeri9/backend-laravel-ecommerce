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
        $transactions = Transaction::with('details.product.category')->orderBy('id','desc')->get();
        return view('admin.pages.transaction.index',[
            'title' => 'Data Transaksi',
            'transactions' => $transactions
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
        $request->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'courier' => ['required'],
            'payment' => ['required'],
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

        return redirect()->back()->with('success','Status berhasil diupdate');
    }
}
