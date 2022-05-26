<?php

namespace App\Http\Controllers\Admin;

use App\Courier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Courier::orderBy('name','asc')->get();
        return view('admin.pages.courier.index',[
            'title' => 'Data Kurir',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.courier.create',[
            'title' => 'Tambah Kurir',
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
            'code' => ['required'],
            'status' => ['required'],
        ]);
        $data = $request->all();
        Courier::create($data);

        return redirect()->route('admin.couriers.index')->with('success','Kurir berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $item = Courier::findOrFail($id);
        return view('admin.pages.courier.edit',[
            'title' => 'Edit Kurir ' . $item->name,
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'code' => ['required'],
            'status' => ['required'],
        ]);
        $item = Courier::findOrFail($id);
        $data = $request->all();

        $item->update($data);

        return redirect()->route('admin.couriers.index')->with('success','Kurir berhasil diubah!');
    }


    public function destroy($id)
    {
        $item = Courier::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.couriers.index')->with('success','Kurir berhasil dihapus!');
    }
}
