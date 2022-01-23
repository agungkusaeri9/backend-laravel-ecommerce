<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('name','asc')->get();
        return view('admin.pages.payment.index',[
            'title' => 'Data Metode Pembayaran',
            'payments' => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.payment.create',[
            'title' => 'Tambah Metode Pembayaran',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'number' => ['required','numeric'],
            'desc' => ['required'],
            'icon' => ['image','mimes:jpg,png,jpeg']
        ]);
        $data = $request->all();
        if(request()->file('icon'))
        {
            $data['icon'] = request()->file('icon')->store('payment','public');
        }
        Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success','Metode Pembayaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('admin.pages.payment.edit',[
            'title' => 'Edit Metode Pembayaran ' . $payment->name,
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'name' => ['required'],
            'number' => ['required','numeric'],
            'desc' => ['required'],
            'icon' => ['image','mimes:jpg,jpeg,png']
        ]);
        $data = $request->all();
        if(request()->file('icon'))
        {
            Storage::disk('public')->delete($payment->icon);
            $data['icon'] = request()->file('icon')->store('payment','public');
        }else{
            $data['icon'] = $payment->icon;
        }
        $payment->update($data);

        return redirect()->route('admin.payments.index')->with('success','Metode Pembayaran berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        Storage::disk('public')->delete($payment->icon);
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success','Metode Pembayaran berhasil dihapus!');
    }
}
