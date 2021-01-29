<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::first();
        if(!$store){
            return view('admin.pages.store.create',[
                'title' => 'Buat Toko'
            ]);
        }else{
            return view('admin.pages.store.index',[
                'title' => 'Profile Toko',
                'store' => $store
            ]);
        }
        
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
        $request->validate([
            'name' => ['required'],
            'desc' => ['required'],
            'address' => ['required'],
            'photo' => ['image','mimes:jpg.jpeg,png'],
        ]);
        $data = $request->all();
        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('store/');
        }else{
            $data['photo'] = NULL;
        }
        Store::create($data);

        return redirect()->route('admin.store.index')->with('success','Toko berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'desc' => ['required'],
            'address' => ['required'],
            'photo' => ['image','mimes:jpg.jpeg,png'],
        ]);
        $store = Store::first();

        $data = $request->all();
        if($request->hasFile('photo')){
            if($store->photo !== NULL){
                unlink('storage/' . $store->photo);
            }
            $data['photo'] = $request->file('photo')->store('store/');
        }else{
            $data['photo'] = NULL;
        }
        $store->update($data);

        return redirect()->route('admin.store.index')->with('success','Profile Toko berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
