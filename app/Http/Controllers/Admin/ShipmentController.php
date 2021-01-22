<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::orderBy('name','asc')->get();
        return view('admin.pages.shipment.index',[
            'title' => 'Data Jasa Pengantar',
            'shipments' => $shipments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.shipment.create',[
            'title' => 'Tambah Jasa Pengantar'
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
            'name' => ['required']
        ]);

        Shipment::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.shipments.index')->with('success','Jasa Pengantar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        return view('admin.pages.shipment.edit',[
            'title' => 'Edit Jasa Pengantar ' . $shipment->name,
            'shipment' => $shipment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $shipment->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.shipments.index')->with('success','Jasa Pengantar berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('admin.shipments.index')->with('success','Jasa Pengantar berhasil dihapus!');
    }
}
