<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Notifications\Admin\ProofUpload;
use App\Payment;
use App\Store;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
        return view('user.pages.transaction.index',[
            'title' => 'Pesanan Saya',
            'store' => Store::first(),
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'transactions' => $transactions
        ]);
    }

    public function show($uuid)
    {
        $transaction = auth()->user()->transactions->where('uuid', $uuid)->first();
        if(!$transaction){ abort(404); }
        $price_total = 0;
        foreach($transaction->details as $details){
            $product_price = $details->product->price;
            $product_amount = $details->amount;
            $price_total = $price_total + ($product_price * $product_amount);
        }
        return view('user.pages.transaction.show',[
            'title' => 'Detail transaksi ' . Str::lower($transaction->uuid),
            'store' => Store::first(),
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
            'transaction' => $transaction,
            'price_total' => $price_total
        ]);
    }

    public function proofDelete()
    {
        $transaction_id = request('transaction_id');
        $transaction = Transaction::findOrFail($transaction_id);
        Storage::disk('public')->delete($transaction->proof_of_payment);
        $transaction->proof_of_payment = NULL;
        $transaction->save();
        return redirect()->back()->with('success', 'Bukti Pembayaran berhasil dihapus.');
    }

    public function upload_proof()
    {
        request()->validate([
            'uuid' => ['required'],
            'image' => ['required','image','mimes:jpg,jpeg,png']
        ]);

        $image = request()->file('image');
        $nameOrigin = Str::snake(auth()->user()->username) . '_' . Str::lower(request('uuid')) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('transaction',$nameOrigin);
        $name = 'transaction/' . $nameOrigin;

        $transaction = Transaction::where('uuid', request('uuid'))->first();
        $transaction->proof_of_payment = $name;
        $transaction->save();

        // $transaction->notify(new ProofUpload);

        return redirect()->back()->with('success', 'Bukti Pembayaran berhasil diupload.');
    }

    public function getInvoice($uuid)
    {
        $item = Transaction::where('uuid',$uuid)->firstOrFail();
        $title = 'Invoice ' . $item->uuid;
        $store = Store::first();
        return view('user.pages.transaction.invoice',compact('item','title','store'));
    }
}
